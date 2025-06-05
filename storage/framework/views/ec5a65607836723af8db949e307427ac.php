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

<div class="container-fluid px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold mb-0">Campaign Dashboard</h1>
            <p class="text-gray-600">Overview of your campaign performance</p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>New Campaign
            </a>
            <a href="<?php echo e(route('admin.campaigns.index')); ?>" class="border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-600 hover:text-white transition">
                <i class="fas fa-list mr-2"></i>Manage Campaigns
            </a>
        </div>
    </div>

    <!-- Campaign Statistics -->
    <div class="grid grid-cols-1 md::grid-cols-4 gap-4 mb-4">
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-blue-100 p-3">
                                <i class="fas fa-bullhorn text-blue-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Active Campaigns</h6>
                            <h4 class="text-xl font-semibold mb-0"><?php echo e($campaigns->where('is_active', true)->count()); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-green-100 p-3">
                                <i class="fas fa-hand-holding-heart text-green-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Donations</h6>
                            <h4 class="text-xl font-semibold mb-0"><?php echo e($recentDonations->count()); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-cyan-100 p-3">
                                <i class="fas fa-chart-line text-cyan-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Raised</h6>
                            <h4 class="text-xl font-semibold mb-0">₱<?php echo e(number_format($campaigns->sum('donations_sum_amount'), 2)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-yellow-100 p-3">
                                <i class="fas fa-users text-yellow-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Donors</h6>
                            <h4 class="text-xl font-semibold mb-0"><?php echo e($recentDonations->unique('donor_email')->count()); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Campaigns -->
    <h5 class="text-lg font-semibold mb-4">Active Campaigns</h5>
    <div class="grid grid-cols-1 md::grid-cols-3 gap-4 mb-4">
        <?php $__currentLoopData = $campaigns->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="p-4 flex-grow">
                    <div class="flex justify-between items-center mb-3">
                        <h5 class="text-lg font-semibold mb-0"><?php echo e($campaign->title); ?></h5>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-<?php echo e($campaign->is_active ? 'green' : 'yellow'); ?>-500 text-white">
                            <?php echo e($campaign->is_active ? 'Active' : 'Paused'); ?>

                        </span>
                    </div>
                    <p class="text-gray-600 text-sm mb-3"><?php echo e(Str::limit($campaign->description, 100)); ?></p>
                    <div class="mb-3">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-gray-600 text-sm">Progress</span>
                            <span class="text-gray-600 text-sm"><?php echo e(round(($campaign->donations_sum_amount / $campaign->goal_amount) * 100)); ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full"
                                 style="width: <?php echo e(($campaign->donations_sum_amount / $campaign->goal_amount) * 100); ?>%">
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-gray-600 text-sm">₱<?php echo e(number_format($campaign->donations_sum_amount, 2)); ?></span>
                            <span class="text-gray-600 text-sm">₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="<?php echo e(route('admin.campaigns.show', $campaign)); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Recent Donations -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b flex justify-between items-center">
            <h5 class="text-lg font-semibold mb-0">Recent Donations</h5>
            <a href="<?php echo e(route('admin.donations.index')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View All
            </a>
        </div>
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $recentDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-500"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($donation->donor_name); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo e($donation->donor_email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($donation->campaign ? $donation->campaign->title : 'N/A'); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">₱<?php echo e(number_format($donation->amount, 2)); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo e($donation->created_at->format('M d, Y')); ?></div>
                                <div class="text-sm text-gray-500"><?php echo e($donation->created_at->format('h:i A')); ?></div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?php echo e($donation->status === 'completed' ? 'green' : 'yellow'); ?>-100 text-<?php echo e($donation->status === 'completed' ? 'green' : 'yellow'); ?>-800">
                                    <?php echo e(ucfirst($donation->status)); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No recent donations found
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
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
<?php endif; ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\campaigns\dashboard.blade.php ENDPATH**/ ?>