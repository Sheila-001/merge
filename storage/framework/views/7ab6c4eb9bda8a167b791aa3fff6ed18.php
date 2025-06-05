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
    <div class="flex">
        <!-- Sidebar (reuse from your other pages) -->
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4 flex items-center space-x-2">
                <img src="<?php echo e(asset('image/logohauzhayag.jpg')); ?>" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">Dashboard</a>
                <a href="/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Jobs</a>
                <a href="/admin/jobs/create" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors font-bold">Add Job</a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">Logout</a>
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Job Listing</h1>
            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('admin.jobs.store')); ?>" method="POST" class="bg-white rounded-lg shadow-md p-8 max-w-xl mx-auto">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?php echo e(old('title')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?php echo e(old('company_name')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Role <span class="text-red-500">*</span></label>
                    <input type="text" name="role" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?php echo e(old('role')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" required><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Qualifications <span class="text-red-500">*</span></label>
                    <textarea name="qualifications" class="w-full border border-gray-300 rounded px-3 py-2" rows="3" required><?php echo e(old('qualifications')); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Employment Type</label>
                    <select name="employment_type" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Select Type</option>
                        <option value="Full-time" <?php echo e(old('employment_type') == 'Full-time' ? 'selected' : ''); ?>>Full-time</option>
                        <option value="Part-time" <?php echo e(old('employment_type') == 'Part-time' ? 'selected' : ''); ?>>Part-time</option>
                        <option value="Contract" <?php echo e(old('employment_type') == 'Contract' ? 'selected' : ''); ?>>Contract</option>
                        <option value="Temporary" <?php echo e(old('employment_type') == 'Temporary' ? 'selected' : ''); ?>>Temporary</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Location</label>
                    <input type="text" name="location" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo e(old('location')); ?>">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Minimum Salary</label>
                        <input type="number" name="salary_min" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo e(old('salary_min')); ?>" min="0" step="0.01">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Maximum Salary</label>
                        <input type="number" name="salary_max" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo e(old('salary_max')); ?>" min="0" step="0.01">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contact Person <span class="text-red-500">*</span></label>
                    <input type="text" name="contact_person" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?php echo e(old('contact_person')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contact Email <span class="text-red-500">*</span></label>
                    <input type="email" name="contact_email" class="w-full border border-gray-300 rounded px-3 py-2" required value="<?php echo e(old('contact_email')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contact Phone</label>
                    <input type="tel" name="contact_phone" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo e(old('contact_phone')); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Expiry Date</label>
                    <input type="date" name="expires_at" class="w-full border border-gray-300 rounded px-3 py-2" value="<?php echo e(old('expires_at')); ?>">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-secondary text-white px-6 py-2 rounded hover:bg-secondary/80 transition">Add Job</button>
                </div>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?> <?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\jobs\create.blade.php ENDPATH**/ ?>