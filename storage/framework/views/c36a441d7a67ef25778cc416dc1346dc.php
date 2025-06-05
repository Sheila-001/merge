

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-md mx-auto">
        <div class="flex flex-col items-center mb-6">
            <img src="<?php echo e(asset('image/logohauzhayag.jpg')); ?>" alt="Hauz Hayag Logo" class="h-16 w-16 rounded-lg shadow mb-2">
            <h2 class="text-2xl font-extrabold text-gray-900 text-center">Job Details</h2>
            <p class="text-gray-500 text-center">View the job information below</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Title</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->title); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Type</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->type); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->location); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->category); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e(ucfirst($job->status)); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Contact Email</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->contact_email); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Contact Phone</dt>
                    <dd class="text-lg text-gray-900 font-semibold"><?php echo e($job->contact_phone); ?></dd>
                </div>
            </dl>
            <div class="mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Description</h3>
                <div class="prose max-w-none text-gray-700"><?php echo nl2br(e($job->description)); ?></div>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Requirements</h3>
                <div class="prose max-w-none text-gray-700"><?php echo nl2br(e($job->requirements)); ?></div>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Benefits</h3>
                <div class="prose max-w-none text-gray-700"><?php echo nl2br(e($job->benefits)); ?></div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="<?php echo e(route('admin.jobs.index')); ?>" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-colors font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Job Listings
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\jobs\show.blade.php ENDPATH**/ ?>