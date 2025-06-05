<x-app-layout>

    {{-- The content from the user calendar will go here --}}
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Calendar</h1>
            {{-- Changed button text and color to match image --}}
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow-md transition-colors">+ Add New Campaign</button>
        </div>

        {{-- Calendar content from usercalendar.blade.php starts here --}}

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-2 text-xl font-semibold text-gray-700">
                    <button class="text-gray-500 hover:text-gray-700">&lt;</button>
                    <span>March 2025</span>
                    <button class="text-gray-500 hover:text-gray-700">&gt;</button>
                </div>
                <div class="space-x-2">
                    {{-- Added active styling to Month button to match image --}}
                    <button class="px-4 py-2 text-sm rounded-md border border-gray-300 text-gray-700 bg-gray-200">Month</button>
                    <button class="px-4 py-2 text-sm rounded-md border border-gray-300 text-gray-700">Week</button>
                    <button class="px-4 py-2 text-sm rounded-md border border-gray-300 text-gray-700">Day</button>
                </div>
            </div>

            <div class="days-grid text-center text-xs text-gray-500 mb-2">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="days-grid">
                <!-- Placeholder for days from previous month -->
                <div class="day-cell text-gray-400">25</div>
                <div class="day-cell text-gray-400">26</div>
                <div class="day-cell text-gray-400">27</div>
                <div class="day-cell text-gray-400">28</div>
                <div class="day-cell text-gray-400">1</div>
                <div class="day-cell text-gray-400">2</div>
                <div class="day-cell text-gray-400">3</div>

                <!-- Days of the current month -->
                <div class="day-cell text-gray-700">4
                     <div class="text-xs mt-1 px-1 py-0.5 rounded bg-purple-200 text-purple-800">Rice Distribution<br>Pledged: 500kg</div>
                </div>
                <div class="day-cell text-gray-700">5</div>
                <div class="day-cell text-gray-700">6
                     <div class="text-xs mt-1 px-1 py-0.5 rounded bg-green-200 text-green-800">Outreach Program<br>Pledged: $1,800</div>
                </div>
                <div class="day-cell text-gray-700">7</div>
                <div class="day-cell text-gray-700">8</div>
                <div class="day-cell text-gray-700">9
                    <div class="text-xs mt-1 px-1 py-0.5 rounded bg-blue-200 text-blue-800">Feeding Program<br>Pledged: $2,500</div>
                </div>
                <div class="day-cell text-gray-700">10</div>
                <div class="day-cell text-gray-700">11</div>
                <div class="day-cell text-gray-700">12</div>
                <div class="day-cell text-gray-700">13</div>
                <div class="day-cell text-gray-700">14</div>
                <div class="day-cell text-gray-700">15</div>
                <div class="day-cell text-gray-700">16
                     <div class="text-xs mt-1 px-1 py-0.5 rounded bg-blue-200 text-blue-800">Feeding Program<br>Pledged: $3,200</div>
                </div>
                <div class="day-cell text-gray-700">17</div>
                <div class="day-cell text-gray-700">18
                     <div class="text-xs mt-1 px-1 py-0.5 rounded bg-purple-200 text-purple-800">Rice Distribution<br>Pledged: 750kg</div>
                </div>
                <div class="day-cell text-gray-700">19</div>
                <div class="day-cell text-gray-700">20</div>
                <div class="day-cell text-gray-700">21</div>
                <div class="day-cell text-gray-700">22</div>
                <div class="day-cell text-gray-700">23</div>
                <div class="day-cell text-gray-700">24</div>
                <div class="day-cell text-gray-700">25</div>
                <div class="day-cell text-gray-700">26</div>
                <div class="day-cell text-gray-700">27
                     <div class="text-xs mt-1 px-1 py-0.5 rounded bg-green-200 text-green-800">Outreach Program<br>Pledged: $2,100</div>
                </div>
                <div class="day-cell text-gray-700">28</div>
                <div class="day-cell text-gray-700">29</div>
                <div class="day-cell text-gray-700">30</div>
                <div class="day-cell text-gray-700">31</div>

            </div>
        </div>

        {{-- Event Categories section --}}
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Event Categories</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="block w-4 h-4 rounded-full bg-blue-600"></span>
                    <span>Feeding Programs</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="block w-4 h-4 rounded-full bg-green-600"></span>
                    <span>Outreach Programs</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="block w-4 h-4 rounded-full bg-purple-600"></span>
                    <span>Monthly Rice Distributions</span>
                </div>
                {{-- Add other categories as needed --}}
            </div>
        </div>

        {{-- Calendar content from usercalendar.blade.php ends here --}}

    </div>

</x-app-layout> 