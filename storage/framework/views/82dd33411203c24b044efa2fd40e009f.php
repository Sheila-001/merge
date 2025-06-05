<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="flex flex-col items-center">
                <img class="mx-auto h-16 w-auto rounded-lg shadow-md" src="<?php echo e(asset('image/logohauzhayag.jpg')); ?>" alt="Hauz Hayag Logo">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create New User</h2>
                <p class="mt-2 text-center text-sm text-gray-600">Fill in the details to add a new user</p>
            </div>
            <div class="bg-white py-8 px-6 shadow rounded-lg">
                <form action="<?php echo e(route('users.store')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="student" <?php echo e(old('role') === 'student' ? 'selected' : ''); ?>>Student</option>
                                <option value="volunteer" <?php echo e(old('role') === 'volunteer' ? 'selected' : ''); ?>>Volunteer</option>
                                <option value="admin" <?php echo e(old('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                            </select>
                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="active" <?php echo e(old('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div>
                        <label for="class_year" class="block text-sm font-medium text-gray-700">Class Year</label>
                        <select name="class_year" id="class_year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="">Select Class Year</option>
                            <option value="2025" <?php echo e(old('class_year') === '2025' ? 'selected' : ''); ?>>Class of 2025</option>
                            <option value="2026" <?php echo e(old('class_year') === '2026' ? 'selected' : ''); ?>>Class of 2026</option>
                        </select>
                        <?php $__errorArgs = ['class_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="flex justify-between items-center pt-4">
                        <a href="<?php echo e(route('users.index')); ?>" class="text-primary hover:underline">Cancel</a>
                        <button type="submit" class="ml-3 px-6 py-2 bg-primary text-primary rounded-md font-semibold hover:bg-secondary transition">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Assuming this is the only form on the page

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token
            },
            body: formData
        })
        .then(response => {
            // Check if the response is OK or a redirect
            if (response.ok || response.redirected) { // response.redirected checks for 302 redirects
                 // Redirect to the volunteer index page on success or if redirected by the server
                 window.location.href = response.url; // Use response.url to follow the redirect
            } else {
                 // Handle errors (e.g., validation errors, server errors)
                 response.json().then(data => {
                     console.error('Error:', data);
                     // Display the error message from the server response
                     const errorMessage = data.message || 'An unknown error occurred.';
                     alert('Error creating user: ' + errorMessage);

                     // If there are specific validation errors, you could display them next to the form fields
                     // Example (assuming your server returns errors in data.errors):
                     // if (data.errors) {
                     //     for (const field in data.errors) {
                     //         const errorMessages = data.errors[field].join(', ');
                     //         // Find the input field and display the error next to it
                     //         const inputElement = document.getElementById(field);
                     //         if (inputElement) {
                     //             // You'll need to add an element to display the error, e.g., a span with a specific class
                     //             let errorElement = inputElement.nextElementSibling;
                     //             if (!errorElement || !errorElement.classList.contains('text-red-600')) {
                     //                  errorElement = document.createElement('p');
                     //                  errorElement.classList.add('mt-1', 'text-sm', 'text-red-600');
                     //                  inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
                     //             }
                     //             errorElement.textContent = errorMessages;
                     //         }
                     //     }
                     // }
                 }).catch(error => {
                     console.error('Error parsing JSON:', error);
                     alert('An unexpected error occurred while processing the error response.');
                 });
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Network error occurred. Please check your connection.');
        });
    });
});
</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\users\create.blade.php ENDPATH**/ ?>