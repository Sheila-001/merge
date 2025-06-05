<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        <?php echo e($slot); ?>

    </div>
</body>
</html><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\components\guest-layout.blade.php ENDPATH**/ ?>