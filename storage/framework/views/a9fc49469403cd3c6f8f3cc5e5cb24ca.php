<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Code via Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Send Code via Email</h1>
        
        <?php if(session('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('send.code')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label for="recipient" class="block text-sm font-medium text-gray-700 mb-1">Recipient Email</label>
                <input type="email" name="recipient" id="recipient" value="<?php echo e(old('recipient')); ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <?php $__errorArgs = ['recipient'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <input type="text" name="subject" id="subject" value="<?php echo e(old('subject')); ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Code Language</label>
                <select name="language" id="language" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="plaintext" <?php echo e(old('language') == 'plaintext' ? 'selected' : ''); ?>>Plain Text</option>
                    <option value="php" <?php echo e(old('language') == 'php' ? 'selected' : ''); ?>>PHP</option>
                    <option value="javascript" <?php echo e(old('language') == 'javascript' ? 'selected' : ''); ?>>JavaScript</option>
                    <option value="html" <?php echo e(old('language') == 'html' ? 'selected' : ''); ?>>HTML</option>
                    <option value="css" <?php echo e(old('language') == 'css' ? 'selected' : ''); ?>>CSS</option>
                    <option value="python" <?php echo e(old('language') == 'python' ? 'selected' : ''); ?>>Python</option>
                    <option value="java" <?php echo e(old('language') == 'java' ? 'selected' : ''); ?>>Java</option>
                </select>
                <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code</label>
                <textarea name="code" id="code" rows="10" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 font-mono"><?php echo e(old('code')); ?></textarea>
                <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Send Code
                </button>
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\emails\form.blade.php ENDPATH**/ ?>