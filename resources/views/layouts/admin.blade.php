<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}"
                     alt="Hauz Hayag Logo"
                     class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Dashboard</a>
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">User Management</a>
                <a href="{{ route('events.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Events</a>
                <a href="{{ route('admin.applications.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Applicants</a>
                <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Volunteers</a>
                <a href="{{ route('jobs.admin.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Jobs</a>

                {{-- Donations parent link --}}
                <a href="#" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors" onclick="toggleDonationsSubmenu(event)">Donations</a>

                {{-- Donations submenu --}}
                <div id="donationsSubmenu" style="display: block;">
                    <a href="{{ route('admin.urgent-funds.create') }}" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ Urgent Funds
                    </a>
                    <a href="{{ route('admin.campaigns.index') }}" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ Campaigns
                    </a>
                    <a href="{{ route('admin.calendar.index') }}" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ Calendar
                    </a>
                    <a href="{{ route('admin.campaigns.index') }}" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ Reports
                    </a>
                </div>

                {{-- You can add other admin links here --}}

                <div class="mt-auto pt-20">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 ml-64 overflow-y-auto h-screen p-6">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
    <script>
    function toggleDonationsSubmenu(event) {
        event.preventDefault(); // Prevent default link behavior
        var submenu = document.getElementById('donationsSubmenu');
        if (submenu.style.display === 'none') {
            submenu.style.display = 'block';
        } else {
            submenu.style.display = 'none';
        }
    }
    </script>
</body>
</html>
