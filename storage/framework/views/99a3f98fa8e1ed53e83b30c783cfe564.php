

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->is_admin): ?>
                    <a href="<?php echo e(route('admin.jobs.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Job Management
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('jobs.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Listings
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo e(route('jobs.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Listings
                </a>
            <?php endif; ?>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700">
                <h2 class="text-2xl font-bold text-white mb-2"><?php echo e($job->title); ?></h2>
                <p class="text-lg text-white/90 font-semibold"><?php echo e($job->company_name ?? 'Not Specified'); ?></p>
            </div>

            <!-- Job Details -->
            <div class="p-6 space-y-8">
                <!-- Quick Info Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="text-sm text-blue-600 font-medium mb-1">Role</div>
                        <div class="text-gray-900 font-semibold"><?php echo e($job->role); ?></div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="text-sm text-green-600 font-medium mb-1">Employment Type</div>
                        <div class="text-gray-900 font-semibold"><?php echo e($job->employment_type ?? 'N/A'); ?></div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <div class="text-sm text-yellow-600 font-medium mb-1">Location</div>
                        <div class="text-gray-900 font-semibold"><?php echo e($job->location ?? 'N/A'); ?></div>
                    </div>
                </div>

                <!-- Salary Information -->
                <?php if($job->salary_min || $job->salary_max): ?>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-600 font-medium mb-1">Salary Range</div>
                        <div class="text-gray-900 font-semibold">
                            <?php if($job->salary_min && $job->salary_max): ?>
                                $<?php echo e(is_numeric($job->salary_min) ? number_format((float)$job->salary_min, 2) : 'N/A'); ?> - $<?php echo e(is_numeric($job->salary_max) ? number_format((float)$job->salary_max, 2) : 'N/A'); ?>

                            <?php elseif($job->salary_min): ?>
                                From $<?php echo e(is_numeric($job->salary_min) ? number_format((float)$job->salary_min, 2) : 'N/A'); ?>

                            <?php else: ?>
                                Up to $<?php echo e(is_numeric($job->salary_max) ? number_format((float)$job->salary_max, 2) : 'N/A'); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Job Description -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Job Description</h3>
                    <div class="prose max-w-none">
                        <?php echo nl2br(e($job->description)); ?>

                    </div>
                </div>

                <!-- Qualifications -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Qualifications</h3>
                    <div class="prose max-w-none">
                        <?php echo nl2br(e($job->qualifications)); ?>

                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-600 font-medium mb-1">Contact Person</div>
                            <div class="text-gray-900 font-semibold"><?php echo e($job->contact_person); ?></div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-600 font-medium mb-1">Email</div>
                            <div class="text-gray-900 font-semibold"><?php echo e($job->contact_email); ?></div>
                        </div>
                        <?php if($job->contact_phone): ?>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-600 font-medium mb-1">Phone</div>
                                <div class="text-gray-900 font-semibold"><?php echo e($job->contact_phone); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t">
                    <div>
                        <span>Posted <?php echo e($job->created_at->diffForHumans()); ?></span>
                        <?php if($job->expires_at): ?>
                            <span class="mx-2">•</span>
                            <span>Expires <?php echo e($job->expires_at->format('M d, Y')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($job->expires_at && $job->expires_at < now()): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Expired
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\jobs\show.blade.php ENDPATH**/ ?>