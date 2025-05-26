<x-app-layout>
<div class="p-8 bg-[#f3f6fb] min-h-screen">
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Donation </h1>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600">Admin</span>
            <div class="bg-blue-200 text-blue-700 rounded-full px-3 py-1 font-semibold">AD</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow flex flex-col">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-gray-700">Monetary Donations</span>
                <span class="bg-blue-100 text-blue-600 p-2 rounded-full">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <span class="mt-4 text-2xl font-bold">0</span>
            <span class="text-xs text-green-500 mt-1">↑12% from last month</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow flex flex-col">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-gray-700">Non-Monetary Items</span>
                <span class="bg-purple-100 text-purple-600 p-2 rounded-full">
                    <i class="fas fa-box"></i>
                </span>
            </div>
            <span class="mt-4 text-2xl font-bold">0</span>
            <span class="text-xs text-green-500 mt-1">↑8% from last month</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow flex flex-col">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-gray-700">Campaign</span>
                <span class="bg-orange-100 text-orange-600 p-2 rounded-full">
                    <i class="fas fa-bullhorn"></i>
                </span>
            </div>
            <span class="mt-4 text-2xl font-bold">0</span>
            <span class="text-xs text-green-500 mt-1">↑10% from last month</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow flex flex-col">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-gray-700">Total Donors</span>
                <span class="bg-green-100 text-green-600 p-2 rounded-full">
                    <i class="fas fa-users"></i>
                </span>
            </div>
            <span class="mt-4 text-2xl font-bold">0</span>
            <span class="text-xs text-green-500 mt-1">↑13% from last month</span>
        </div>
    </div>

    <!-- Recent Donations Table -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-lg">Recent Donations</h2>
            <div class="flex items-center space-x-2">
                <input type="text" placeholder="Search donors..." class="border rounded px-3 py-1 text-sm">
                <button class="bg-blue-600 text-white px-4 py-1 rounded">Filter</button>
            </div>
        </div>
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 text-left">Donor</th>
                    <th class="py-2 text-left">Type</th>
                    <th class="py-2 text-left">Amount</th>
                    <th class="py-2 text-left">Status</th>
                    <th class="py-2 text-left">Date</th>
                    <th class="py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-2 flex items-center space-x-2">
                        <img src="https://randomuser.me/api/portraits/women/1.jpg" class="w-8 h-8 rounded-full" alt="Sarah Johnson">
                        <span>
                            <div class="font-semibold">Sarah Johnson</div>
                            <div class="text-xs text-gray-500">sarah@example.com</div>
                        </span>
                    </td>
                    <td class="py-2">Monetary</td>
                    <td class="py-2 font-bold">₱1,200</td>
                    <td class="py-2"><span class="bg-green-100 text-green-600 px-2 py-1 rounded">Completed</span></td>
                    <td class="py-2">Jan 15, 2025</td>
                    <td class="py-2">...</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 flex items-center space-x-2">
                        <img src="https://randomuser.me/api/portraits/men/2.jpg" class="w-8 h-8 rounded-full" alt="Michael Chen">
                        <span>
                            <div class="font-semibold">Michael Chen</div>
                            <div class="text-xs text-gray-500">michael@example.com</div>
                        </span>
                    </td>
                    <td class="py-2">Non-Monetary</td>
                    <td class="py-2 font-bold">Books (50)</td>
                    <td class="py-2"><span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Pending</span></td>
                    <td class="py-2">Jan 14, 2025</td>
                    <td class="py-2">...</td>
                </tr>
                <tr>
                    <td class="py-2 flex items-center space-x-2">
                        <img src="https://randomuser.me/api/portraits/women/3.jpg" class="w-8 h-8 rounded-full" alt="Emma Wilson">
                        <span>
                            <div class="font-semibold">Emma Wilson</div>
                            <div class="text-xs text-gray-500">emma@example.com</div>
                        </span>
                    </td>
                    <td class="py-2">Monetary</td>
                    <td class="py-2 font-bold">₱500</td>
                    <td class="py-2"><span class="bg-green-100 text-green-600 px-2 py-1 rounded">Completed</span></td>
                    <td class="py-2">Jan 13, 2025</td>
                    <td class="py-2">...</td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4">
            <span class="text-xs text-gray-500">Showing 1 to 3 of 50 entries</span>
            <div class="flex space-x-1">
                <button class="px-2 py-1 rounded bg-gray-200 text-gray-600">1</button>
                <button class="px-2 py-1 rounded bg-white border border-gray-300">2</button>
                <button class="px-2 py-1 rounded bg-white border border-gray-300">3</button>
                <button class="px-2 py-1 rounded bg-white border border-gray-300">Next</button>
            </div>
        </div>
    </div>

    <!-- Drop-Off Confirmation -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-bold text-lg mb-2">Drop-Off Confirmation</h2>
        <p class="text-gray-500 mb-4">Manage and track non-monetary donations</p>
        <div class="bg-blue-50 p-4 rounded-xl mb-2">
            <h3 class="font-semibold mb-1">Pending Drop-offs</h3>
            <div class="space-y-2">
                <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow mb-2">
                    <div class="flex items-center space-x-2">
                        <span class="bg-blue-100 p-2 rounded"><i class="fas fa-box"></i></span>
                        <span>Children's Books (25 units)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-gray-400">Expected: Jan 15, 2025</span>
                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Pending</span>
                        <button class="bg-green-100 text-green-600 px-2 py-1 rounded">Received</button>
                    </div>
                </div>
                <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow">
                    <div class="flex items-center space-x-2">
                        <span class="bg-blue-100 p-2 rounded"><i class="fas fa-box"></i></span>
                        <span>Yellow Pad (15 pieces)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-gray-400">Expected: Jan 18, 2025</span>
                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Pending</span>
                        <button class="bg-green-100 text-green-600 px-2 py-1 rounded">Received</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>