

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Create Button -->
    <div class="mb-6">
        <a href="<?php echo e(route('admin.urgent-funds.create')); ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span>Create New Campaign</span>
        </a>
    </div>

    <!-- Urgent Campaigns Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Urgent Campaigns</h2>
            <span class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">Priority</span>
        </div>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $urgentCampaigns ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <?php if($campaign->is_urgent): ?>
                                <span class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2 inline-block">Urgent</span>
                            <?php endif; ?>
                            <h3 class="text-lg font-bold text-gray-900"><?php echo e($campaign->title); ?></h3>
                            <p class="text-gray-600 text-sm mt-1"><?php echo e(Str::limit($campaign->description, 150)); ?></p>

                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4 mb-2">
                                <?php
                                    $progress = ($campaign->funds_raised / $campaign->goal_amount) * 100;
                                ?>
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: <?php echo e(min($progress, 100)); ?>%"></div>
                            </div>

                            <div class="flex justify-between text-gray-600 text-sm mb-4">
                                <span>Raised: ₱<?php echo e(number_format($campaign->funds_raised, 2)); ?></span>
                                <span>Goal: ₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 text-xs flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <?php echo e(now()->diffInDays($campaign->created_at->addDays(30))); ?> days remaining
                                </span>
                                <div class="flex space-x-2">
                                    <a href="<?php echo e(route('admin.urgent-funds.edit', $campaign->id)); ?>"
                                       class="text-yellow-600 hover:text-yellow-900 text-sm font-medium">
                                        <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5l10.305-10.305z"></path></svg>
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('admin.urgent-funds.destroy', $campaign->id)); ?>"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m14 0H5m2 0V5a2 2 0 012-2h6a2 2 0 012 2v2m-4 0h.01M12 13l-3 3m3-3l3 3"></path></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0h-3m2 0l-3 3m4-3v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2m4 14h.01M12 13l-3 3m3-3l3 3"></path></svg>
                    <p class="mt-1 text-sm text-gray-500">No urgent campaigns at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- All Campaigns Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">All Campaigns</h2>
            <span class="bg-blue-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">Total: <?php echo e($allCampaigns->count()); ?></span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Goal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raised</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $allCampaigns ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <?php if($campaign->is_urgent): ?>
                                            <span class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full mr-2">Urgent</span>
                                        <?php endif; ?>
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($campaign->title); ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(Str::limit($campaign->description, 50)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱<?php echo e(number_format($campaign->funds_raised, 2)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 w-36">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <?php
                                            $progress = ($campaign->goal_amount > 0) ? min(round(($campaign->funds_raised / $campaign->goal_amount) * 100), 100) : 0;
                                        ?>
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: <?php echo e($progress); ?>%"></div>
                                    </div>
                                    <small class="text-gray-500"><?php echo e(number_format($progress, 1)); ?>%</small>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($campaign->is_urgent): ?>
                                        <span class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">Urgent</span>
                                    <?php else: ?>
                                        <span class="bg-gray-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">Normal</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="<?php echo e(route('admin.urgent-funds.edit', $campaign->id)); ?>"
                                           class="text-yellow-600 hover:text-yellow-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5l10.305-10.305z"></path></svg>
                                            Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.urgent-funds.destroy', $campaign->id)); ?>"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m14 0H5m2 0V5a2 2 0 012-2h6a2 2 0 012 2v2m-4 0h.01M12 13l-3 3m3-3l3 3"></path></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0h-3m2 0l-3 3m4-3v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2m4 14h.01M12 13l-3 3m3-3l3 3"></path></svg>
                                    <p class="mt-1 text-sm text-gray-500">No campaigns found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab\resources\views/admin/donation/urgent-fund/index.blade.php ENDPATH**/ ?>