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
                <a hredashboard" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Dashboard</a>
                <a href="/users" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">User Management</a>
                <a href="/events" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Events</a>
                <a href="/students" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Applicants</a>
                <a href="<?php echo e(route('admin.volunteers.index')); ?>" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Volunteers</a>
                <a href="/admin/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Jobs</a>
                
                
                <a href="#" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors" onclick="toggleDonationsSubmenu(event)">Donations</a>

                
                <div id="donationsSubmenu" style="display: none;">
                    <a href="<?php echo e(route('admin.urgent-funds.index')); ?>" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ Urgent Funds
                    </a>
                    <a href="<?php echo e(route('admin.campaigns.index')); ?>" class="flex items-center px-8 py-3 hover:bg-[#2C5F6E] transition-colors text-sm">
                        └ All Campaigns
                    </a>
                </div>

                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">Logout</a>
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
        event.preventDefault(); // Prevent default link behavior
        var submenu = document.getElementById('donationsSubmenu');
        if (submenu.style.display === 'none') {
            submenu.style.display = 'block';
        } else {
            submenu.style.display = 'none';
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