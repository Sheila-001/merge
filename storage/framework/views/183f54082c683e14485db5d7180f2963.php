<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Student Login</h2>
        <?php if($errors->any()): ?>
            <div class="mb-4 text-red-600 text-sm">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(url('/student/login')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required autofocus class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-[#1B4B5A] text-white rounded-md font-semibold hover:bg-[#25697e] transition">Login</button>
        </form>
        <div class="mt-6 text-center">
            <a href="/login" class="text-primary hover:underline">Back to Main Login</a>
        </div>
    </div>
</body>
</html> <?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\auth\student-login.blade.php ENDPATH**/ ?>