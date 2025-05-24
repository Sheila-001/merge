<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Calendar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .calendar-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
      }
      .month-calendar {
        background: white;
        border-radius: 8px;
        padding: 16px;
      }
      .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
      }
      .day-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: 1px solid #eee;
      }
      .day-header {
        font-weight: 500;
        color: #666;
        padding: 8px 0;
        text-align: center;
        font-size: 12px;
      }
      .campaign-card {
        transition: transform 0.2s;
      }
      .campaign-card:hover {
        transform: translateY(-4px);
      }
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 1);
        z-index: 50;
      }
      .modal-content {
        position: relative;
        background-color: #333;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
      }
    </style>
  </head>
  <body class="bg-[#B7E4FA] min-h-screen">

    <!-- Modal -->
    <div id="campaignModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
        <p id="modalDescription" class="text-gray-600 mb-4"></p>
        <div class="flex justify-between items-center mb-4">
          <div>
            <span class="text-gray-500 text-sm">Target Amount</span>
            <p id="modalTarget" class="text-lg font-semibold"></p>
          </div>
          <div>
            <span class="text-gray-500 text-sm">Status</span>
            <p id="modalStatus" class="text-sm font-medium"></p>
          </div>
        </div>
        <div class="flex justify-between gap-4">
          <button onclick="closeModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">Close</button>
          <button onclick="editEvent()" class="flex-1 bg-[#0A90A4] hover:bg-[#0A90A4] text-white px-4 py-2 rounded-lg transition-colors">Edit Event</button>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeEditModal()">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit Event</h2>
        <form id="editEventForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="editTitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0A90A4] focus:ring-[#0A90A4]">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Event Type</label>
            <select id="editType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0A90A4] focus:ring-[#0A90A4]">
              <option value="registration">Registration</option>
              <option value="distribution">Distribution</option>
              <option value="feeding">Feeding</option>
              <option value="outreach">Outreach</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="editDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0A90A4] focus:ring-[#0A90A4]">
          </div>
          <div class="flex justify-end gap-4">
            <button type="button" onclick="cancelEvent()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">Cancel Event</button>
            <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">Close</button>
            <button type="submit" class="bg-[#0A90A4] hover:bg-[#0A90A4] text-white px-4 py-2 rounded-lg transition-colors">Save Changes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
      <div class="modal-content">
        <span class="absolute top-4 right-4 cursor-pointer" onclick="closeConfirmModal()">&times;</span>
        <h2 class="text-xl font-bold mb-4">Confirm Cancellation</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to cancel this event? This action cannot be undone.</p>
        <div class="flex justify-end gap-4">
          <button onclick="closeConfirmModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">No, Keep Event</button>
          <button onclick="confirmCancelEvent()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">Yes, Cancel Event</button>
        </div>
      </div>
    </div>

    <!-- Join Campaign Details Modal (New) -->
    <div id="campaignDetailsModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden">
        <div class="relative top-10 mx-auto p-8 border w-full max-w-md shadow-lg rounded-xl bg-gray-800 text-gray-200">
            <span class="absolute top-4 right-4 cursor-pointer text-gray-400 hover:text-gray-100" onclick="closeCampaignDetailsModal()">&times;</span>
            <div id="modalCampaignContent">
                <!-- Campaign details will be loaded here by JavaScript -->
                <h3 id="modalCampaignTitle" class="text-2xl font-bold text-center text-white mb-4"></h3>
                <p id="modalCampaignFrequency" class="text-gray-300 text-sm mb-4"></p>
                
                <!-- Progress Bar Placeholder -->
                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-300 mb-1">
                        <span>Campaign Progress</span>
                        <span id="modalCampaignPercentage"></span>
                    </div>
                    <div class="h-2 bg-blue-200 rounded-full overflow-hidden">
                        <div id="modalCampaignProgressBar" class="h-full bg-[#0A90A4] rounded-full" style="width: 0;"></div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-300 mt-1">
                        <span id="modalCampaignRaised"></span>
                        <span id="modalCampaignGoal"></span>
                    </div>
                </div>

                <!-- Impact Section Placeholder -->
                <div class="bg-gray-700 text-gray-200 p-4 rounded-lg mb-6">
                    <p class="text-sm font-semibold text-gray-200 mb-2">Impact</p>
                    <p id="modalCampaignImpact" class="text-sm text-gray-300"></p>
                </div>

                <!-- Donate Now Button -->
                <a href="{{ route('monetary_donation') }}" class="block w-full bg-[#0A90A4] text-white text-center py-3 rounded-lg hover:bg-[#098a9d] transition-colors font-medium">
                    Donate Now
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
      <!-- Campaign Cards Section -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-center text-black mb-8">Choose a Campaign to Support</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Feeding Program Card -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-transform duration-200 hover:-translate-y-1">
            <div class="relative h-56">
                <img src="{{ asset('images/campaigns/feeding-program.jpg') }}"
                     alt="Children receiving meals"
                     class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                     onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Feeding Program
                    </span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Ongoing
                    </span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm mb-4">Help provide meals for children in need. Every Sunday we serve nutritious meals to families.</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-500 text-sm">Target</span>
                        <p class="text-[#0A90A4] font-semibold">₱500,000</p>
                    </div>
                    <button onclick="openCampaignDetailsModal({ title: 'Feeding Program - Ongoing', frequency: 'Every Sunday', raised: '₱120,000', goal: '₱300,000', percentage: 40, impact: 'Your donation provides daily nutritious meals to children and families in need, helping build a stronger community.' })" class="bg-[#0A90A4] hover:bg-[#0A90A4] text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md">
                        Join Campaign
                    </button>
                </div>
            </div>
          </div>

          <!-- Outreach Program Card -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-transform duration-200 hover:-translate-y-1">
            <div class="relative h-56">
                <img src="{{ url('images/campaigns/outreach-program.jpg') }}"
                     alt="Community outreach activities"
                     class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                     onerror="this.onerror=null; this.src='{{ url('images/default.jpg') }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Outreach Program
                    </span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Ongoing
                    </span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm mb-4">Support community programs including medical missions at a barangay or barangays.</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-500 text-sm">Target</span>
                        <p class="text-[#0A90A4] font-semibold">₱300,000</p>
                    </div>
                    <button onclick="openCampaignDetailsModal({ title: 'Outreach Program - Ongoing', frequency: 'Monthly', raised: '₱120,000', goal: '₱300,000', percentage: 40, impact: 'Your support gives hope and essential resources.' })" class="bg-[#0A90A4] hover:bg-[#0A90A4] text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md">
                        Join Campaign
                    </button>
                </div>
            </div>
          </div>

          <!-- Rice Distribution Card -->
          <div class="campaign-card bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg">
            <div class="relative h-56">
                <img src="{{ asset('images/campaigns/rice-distribution.jpg') }}"
                     alt="Rice distribution to community"
                     class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                     onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Rice Distribution
                    </span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="bg-[#0A90A4] text-white px-4 py-1.5 rounded-full text-sm font-medium shadow-md">
                        Ongoing
                    </span>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm mb-4">Help distribute rice sacks to struggling families monthly.</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-500 text-sm">Target</span>
                        <p class="text-[#0A90A4] font-semibold">₱200,000</p>
                    </div>
                    <button onclick="openCampaignDetailsModal({ title: 'Rice Distribution - Ongoing', frequency: 'Monthly', raised: '₱120,000', goal: '₱300,000', percentage: 40, impact: 'One donation ensures a family has food security.' })" class="bg-[#0A90A4] hover:bg-[#0A90A4] text-white px-6 py-2 rounded-lg transition-colors text-sm font-medium shadow-sm hover:shadow-md mt-6">
                        Join Campaign
                    </button>
                </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Calendar Section -->
      <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">CALENDAR OF ACTIVITIES 2025</h2>

        <!-- Calendar Grid -->
        <div class="calendar-grid">
          @php
            $months = [
              'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL',
              'MAY', 'JUNE', 'JULY', 'AUGUST',
              'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
            ];
            $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
          @endphp

          @foreach($months as $index => $month)
            <div class="month-calendar">
              <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $month }}</h3>
              <div class="days-grid mb-2">
                @foreach($days as $day)
                  <div class="day-header">{{ $day }}</div>
                @endforeach
              </div>
              <div class="days-grid">
                @php
                  $firstDay = new DateTime("2025-" . ($index + 1) . "-01");
                  $daysInMonth = (int)$firstDay->format('t');
                  $firstDayOfWeek = (int)$firstDay->format('w');

                  // Define events for each month
                  $events = [
                    '1' => [], // January
                    '2' => [], // February
                    '3' => [], // March
                    '4' => [], // April
                    '5' => [], // May
                    '6' => [], // June
                    '7' => [], // July
                    '8' => [], // August
                    '9' => [], // September
                    '10' => [], // October
                    '11' => [], // November
                    '12' => []  // December
                  ];

                  // Add empty cells for days before the first day of the month
                  for($i = 0; $i < $firstDayOfWeek; $i++) {
                    echo '<div class="day-cell text-gray-300"></div>';
                  }

                  // Add cells for each day of the month
                  for($day = 1; $day <= $daysInMonth; $day++) {
                    $isToday = false; // You can add logic to highlight today
                    $event = $events[$index + 1][$day] ?? null;

                    $classes = 'day-cell relative group cursor-pointer ' . ($isToday ? 'bg-[#B7E4FA] font-bold' : '');
                    if ($event) {
                      $classes .= ' bg-[#B7E4FA]';
                    }

                    $date = sprintf("2025-%02d-%02d", $index + 1, $day);
                    echo "<div class='$classes' onclick='showEventDetails(\"$date\")' data-date='$date'>";
                    echo $day;
                    if ($event) {
                      echo "<div class='absolute bottom-0 left-0 right-0 bg-[#0A90A4] text-white text-xs p-1 truncate hidden group-hover:block'>" .
                           $event['title'] . "</div>";
                    }
                    echo "</div>";
                  }

                  // Add empty cells for remaining days
                  $remainingCells = (7 - (($firstDayOfWeek + $daysInMonth) % 7)) % 7;
                  for($i = 0; $i < $remainingCells; $i++) {
                    echo '<div class="day-cell text-gray-300"></div>';
                  }
                @endphp
              </div>
            </div>
          @endforeach
        </div>

        <!-- Event Overlay -->
        <div class="mt-8">
          <div class="bg-[#B7E4FA] border-l-4 border-[#0A90A4] p-4 rounded-lg">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-[#0A90A4]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-[#0A90A4]">Open Jan 22 - Feb 28, 2025</h3>
                <p class="text-sm text-[#0A90A4] mt-1">Registration for outreach program volunteers</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="bg-[#e6f4ea] text-gray-800 py-10 px-6 mt-12 animate-fade-in">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
              <!-- About Section -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Hauz Hayag Scholarship</h2>
                <p class="text-sm leading-relaxed">
                  Supporting education through scholarship and nourishment. Hauz Hayag believes in empowering the youth for a brighter future.
                </p>
              </div>
         
              <!-- Quick Links -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Quick Links</h2>
                <ul class="space-y-2 text-sm">
                  <li><a href="#home" class="hover:underline">Home</a></li>
                  <li><a href="#scholarships" class="hover:underline">Programs</a></li>
                  <li><a href="#about-us" class="hover:underline">About Us</a></li>
                  <li><button class="hover:underline text-left" onclick="handleLoginClick()">Login</button></li>
                </ul>
              </div>
         
              <!-- Contact Info -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                <p class="text-sm">📍 Carlock Street, San Nicolas Proper, Cebu City, Philippines</p>
                <p class="text-sm">📧 hauzhayag143@gmail.com</p>
                <p class="text-sm">📞 (032) 384 6594</p>
                <p class="text-sm">🌐 hayag-project.com</p>
              </div>
            </div>
         
            <div class="border-t mt-10 pt-4 text-center text-sm text-gray-500">
              &copy; 2025 Hauz Hayag Scholarship. All rights reserved.
            </div>
          </footer>
    </main>

    <script>
      // Hide the modal initially
      document.getElementById('campaignDetailsModal').style.display = 'none';

      // Existing modal functions (if any)

      // Open the Campaign Details modal
      function openCampaignDetailsModal(campaignData) {
          document.getElementById('modalCampaignTitle').innerText = campaignData.title;
          document.getElementById('modalCampaignFrequency').innerText = campaignData.frequency;
          document.getElementById('modalCampaignRaised').innerText = campaignData.raised + ' raised';
          document.getElementById('modalCampaignGoal').innerText = 'Goal: ' + campaignData.goal;
          document.getElementById('modalCampaignProgressBar').style.width = campaignData.percentage + '%';
          document.getElementById('modalCampaignPercentage').innerText = campaignData.percentage + '%';
          document.getElementById('modalCampaignImpact').innerText = campaignData.impact;
          // Make the modal visible
          document.getElementById('campaignDetailsModal').style.display = 'block';
      }

      // Close the Campaign Details modal
      function closeCampaignDetailsModal() {
          // Hide the modal
          document.getElementById('campaignDetailsModal').style.display = 'none';
      }

      // Existing script logic (if any)

    </script>
  </body>
</html>