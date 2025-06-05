<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Calendar of Activities - Hauz Hayag</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy.css' rel='stylesheet' />
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
            position: relative;
        }
        .day-cell.has-event {
            cursor: pointer;
            background-color: rgba(183, 228, 250, 0.3);
        }
        .day-cell.has-event:hover {
            background-color: rgba(183, 228, 250, 0.6);
        }
        .event-dot {
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            border-radius: 50%;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
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
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            overflow-y: auto;
        }
        .modal-content {
            position: relative;
            background-color: #333;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            z-index: 1100;
        }
        
        /* FullCalendar Custom Styles */
        .fc {
            font-family: 'Poppins', sans-serif;
        }
        .fc .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
        }
        .fc .fc-button-primary {
            background-color: #0A90A4;
            border-color: #0A90A4;
        }
        .fc .fc-button-primary:hover {
            background-color: #087d8f;
            border-color: #087d8f;
        }
        .fc .fc-button-primary:disabled {
            background-color: #0A90A4;
            border-color: #0A90A4;
        }
        .fc-event {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .fc-event:hover {
            transform: scale(1.02);
        }
        
        /* Category Legend */
        .category-legend {
            margin-top: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .legend-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }
        .legend-items {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .legend-color {
            width: 1rem;
            height: 1rem;
            border-radius: 9999px;
        }
        
        /* Updated Tooltip Styles */
        .tippy-box {
            background-color: white;
            color: #1a1a1a;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
        }
        .tippy-content {
            padding: 0; /* Remove padding from tippy content */
        }
        .event-tooltip {
            min-width: 250px;
        }
        .event-tooltip-header {
            padding: 12px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        .event-tooltip-title {
            font-weight: 600;
            font-size: 14px;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .event-tooltip-body {
            padding: 12px;
            background: white;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .event-tooltip-detail {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 6px;
        }
        .event-tooltip-detail i {
            width: 16px;
            color: #6b7280;
        }
        .event-tooltip-detail:last-child {
            margin-bottom: 0;
        }
        .event-divider {
            margin: 8px 0;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body class="bg-[#B7E4FA] min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Campaign Cards Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-center text-black mb-8">Choose a Campaign to Support</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feeding Program Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-transform duration-200 hover:-translate-y-1">
                    <div class="relative h-56">
                        <img src="<?php echo e(asset('images/campaigns/feeding-program.jpg')); ?>"
                             alt="Children receiving meals"
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                             onerror="this.onerror=null; this.src='<?php echo e(asset('images/default.jpg')); ?>'">
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
                        <img src="<?php echo e(url('images/campaigns/outreach-program.jpg')); ?>"
                             alt="Community outreach activities"
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                             onerror="this.onerror=null; this.src='<?php echo e(url('images/default.jpg')); ?>'">
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
                        <img src="<?php echo e(asset('images/campaigns/rice-distribution.jpg')); ?>"
                             alt="Rice distribution to community"
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                             onerror="this.onerror=null; this.src='<?php echo e(asset('images/default.jpg')); ?>'">
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
                <?php
                    $months = [
                        'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL',
                        'MAY', 'JUNE', 'JULY', 'AUGUST',
                        'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
                    ];
                    $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                ?>

                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="month-calendar">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4"><?php echo e($month); ?></h3>
                        <div class="days-grid mb-2">
                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="day-header"><?php echo e($day); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="days-grid">
                            <?php
                                $firstDay = new DateTime("2025-" . ($index + 1) . "-01");
                                $daysInMonth = (int)$firstDay->format('t');
                                $firstDayOfWeek = (int)$firstDay->format('w');
                                $currentMonth = $index + 1;

                                // Add empty cells for days before the first day of the month
                                for($i = 0; $i < $firstDayOfWeek; $i++) {
                                    echo '<div class="day-cell text-gray-300"></div>';
                                }

                                // Add cells for each day of the month
                                for($day = 1; $day <= $daysInMonth; $day++) {
                                    $date = sprintf("2025-%02d-%02d", $currentMonth, $day);
                                    $dayEvents = collect($campaigns)->filter(function($campaign) use ($date) {
                                        $eventStart = \Carbon\Carbon::parse($campaign['start']);
                                        $eventEnd = \Carbon\Carbon::parse($campaign['end']);
                                        $currentDate = \Carbon\Carbon::parse($date);
                                        return $currentDate->between($eventStart, $eventEnd);
                                    })->values();

                                    $hasEvents = $dayEvents->count() > 0;
                                    $cellClasses = 'day-cell ' . ($hasEvents ? 'has-event' : '');
                                    
                                    echo "<div class='$cellClasses' data-date='$date'>";
                                    echo $day;
                                    
                                    if ($hasEvents) {
                                        $firstEvent = $dayEvents->first();
                                        echo "<div class='event-dot' style='background-color: {$firstEvent['categoryColor']}'></div>";
                                        
                                        // Create tooltip content with category color
                                        $tooltipContent = "";
                                        foreach($dayEvents as $index => $event) {
                                            if ($index > 0) {
                                                $tooltipContent .= "<div class='event-divider'></div>";
                                            }
                                            $tooltipContent .= "
                                                <div class='event-tooltip'>
                                                    <div class='event-tooltip-header' style='background-color: {$event['categoryColor']}'>
                                                        <div class='event-tooltip-title'>{$event['title']}</div>
                                                    </div>
                                                    <div class='event-tooltip-body'>
                                                        <div class='event-tooltip-detail'>
                                                            <i class='fas fa-tag'></i>
                                                            {$event['category']}
                                                        </div>
                                                        <div class='event-tooltip-detail'>
                                                            <i class='fas fa-calendar'></i>
                                                            " . \Carbon\Carbon::parse($event['start'])->format('M d') . " - " . 
                                                            \Carbon\Carbon::parse($event['end'])->format('M d, Y') . "
                                                        </div>
                                                        <div class='event-tooltip-detail'>
                                                            <i class='fas fa-info-circle'></i>
                                                            Status: {$event['status']}
                                                        </div>";
                                            
                                            if ($event['pledged']) {
                                                $tooltipContent .= "
                                                    <div class='event-tooltip-detail'>
                                                        <i class='fas fa-hand-holding-heart'></i>
                                                        Pledged: {$event['pledged']}
                                                    </div>";
                                            }
                                            
                                            $tooltipContent .= "</div></div>";
                                        }
                                        
                                        echo "<div class='hidden tooltip-content'>$tooltipContent</div>";
                                    }
                                    
                                    echo "</div>";
                                }

                                // Add empty cells for remaining days
                                $remainingCells = (7 - (($firstDayOfWeek + $daysInMonth) % 7)) % 7;
                                for($i = 0; $i < $remainingCells; $i++) {
                                    echo '<div class="day-cell text-gray-300"></div>';
                                }
                            ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Legend -->
            <div class="mt-8 p-4 bg-white rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-4">Event Status Legend</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-[#34D399]"></div>
                        <span class="text-sm">Scheduled</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-[#FBBF24]"></div>
                        <span class="text-sm">Pending</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-[#6366F1]"></div>
                        <span class="text-sm">Done</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-[#EF4444]"></div>
                        <span class="text-sm">Cancelled</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
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
    </div>

    <!-- Modals -->
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

    <div id="campaignDetailsModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-[1000]">
        <div class="relative top-10 mx-auto p-8 border w-full max-w-md shadow-lg rounded-xl bg-gray-800 text-gray-200 z-[1100]">
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
                <a href="<?php echo e(route('monetary_donation')); ?>" class="block w-full bg-[#0A90A4] text-white text-center py-3 rounded-lg hover:bg-[#098a9d] transition-colors font-medium">
                    Donate Now
                </a>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy.umd.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips for all cells with events
            document.querySelectorAll('.has-event').forEach(cell => {
                const tooltipContent = cell.querySelector('.tooltip-content').innerHTML;
                tippy(cell, {
                    content: tooltipContent,
                    allowHTML: true,
                    placement: 'top',
                    interactive: true,
                    theme: 'light',
                    animation: 'shift-away',
                    arrow: true,
                    maxWidth: 350,
                    appendTo: document.body
                });
            });
        });
    </script>
</body>
</html><?php /**PATH C:\collab\resources\views/donation/usercalendar.blade.php ENDPATH**/ ?>