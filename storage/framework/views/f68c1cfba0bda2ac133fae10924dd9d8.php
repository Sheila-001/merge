<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="font-sans antialciased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-2">
                <img src="<?php echo e(asset('image/logohauzhayag.jpg')); ?>"
                     alt="Hauz Hayag Logo"
                     class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Dashboard</a>
                <a href="<?php echo e(route('admin.events.index')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Events</a>
                <a href="<?php echo e(route('admin.students.index')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Applicants</a>
                <a href="<?php echo e(route('admin.volunteers.index')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Volunteers</a>
                <a href="<?php echo e(route('jobs.index')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Jobs</a>
                
                
                <a href="#" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors" onclick="toggleDonationsSubmenu(event)">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 6c1.657 0 3 .895 3 2s-1.343 2-3 2m0 0c-1.657 0-3 .895-3 2s1.343 2 3 2"/>
                    </svg>
                    <span>Donations</span>
                    <svg class="w-4 h-4 ml-auto transform transition-transform" id="donationsArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>

                
                <div id="donationsSubmenu" class="pl-4 hidden">
                    <a href="<?php echo e(route('admin.donations.index')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        All Donations
                    </a>
                    <a href="<?php echo e(route('admin.donations.create')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Donation
                    </a>
                    <a href="<?php echo e(route('admin.donations.dropoffs')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Drop-offs
                    </a>
                    <a href="<?php echo e(route('admin.urgent-funds.index')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Urgent Funds
                    </a>
                    <a href="<?php echo e(route('admin.campaigns.dashboard')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        </svg>
                        Campaigns
                    </a>
                    <a href="<?php echo e(route('admin.calendar.index')); ?>" class="flex items-center px-4 py-2 hover:bg-[#2C5F6E] transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Calendar
                    </a>
                </div>

                <div class="mt-auto pt-20">
                    <a href="<?php echo e(route('logout')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">Logout</a>
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 ml-64 overflow-y-auto h-screen p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="bg-white rounded-xl shadow p-6">
                    ...
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    ...
                </div>
            </div>
            <?php echo e($slot); ?>

        </div>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
    function toggleDonationsSubmenu(event) {
        event.preventDefault();
        const submenu = document.getElementById('donationsSubmenu');
        const arrow = document.getElementById('donationsArrow');
        
        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    // Optional: Keep urgentFundsSubmenu toggle if still needed elsewhere, otherwise remove
    // function toggleUrgentFunds() {
    //     var submenu = document.getElementById('urgentFundsSubmenu');
    //     if (submenu.style.display === 'none') {
    //         submenu.style.display = 'block';
    //     } else {
    //         submenu.style.display = 'none';
    //     }
    // }
    </script>
</body>
</html><?php /**PATH C:\collab\resources\views/components/app-layout.blade.php ENDPATH**/ ?>