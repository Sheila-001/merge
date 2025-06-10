<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="font-['Inter']">
    <div id="app">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo removed -->
                    </div>
                    <!-- Right Side Of Navbar -->
                    <div class="flex items-center">
                        <!-- Logout button removed -->
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
<<<<<<<< HEAD:storage/framework/views/4fd4498121895672e03635cafbf48af0.php
</html><?php /**PATH C:\collab\resources\views/layouts/app.blade.php ENDPATH**/ ?>
========
</html><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views/layouts/app.blade.php ENDPATH**/ ?>
>>>>>>>> 3ddc342fec4f1777ed9584710f29a41a97a5769f:storage/framework/views/729ffc4d4275828f9550146d7ee920d1.php
