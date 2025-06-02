

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Reports Dashboard</h1>
        <div class="flex space-x-2">
            <button type="button" class="px-4 py-2 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            <a href="<?php echo e(route('admin.reports.export')); ?>" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 text-sm">
                <i class="fas fa-file-excel mr-1"></i> Export to Excel
            </a>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Total Donations Card -->
        <div class="bg-blue-600 text-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-bold uppercase mb-1">Total Donations</div>
                    <div class="text-2xl font-bold">$<?php echo e(number_format($totalDonations, 2)); ?></div>
                </div>
                <i class="fas fa-dollar-sign fa-2x text-blue-300"></i>
            </div>
        </div>

        <!-- Active Campaigns Card -->
        <div class="bg-green-600 text-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-bold uppercase mb-1">Active Campaigns</div>
                    <div class="text-2xl font-bold"><?php echo e($activeCampaigns); ?></div>
                </div>
                <i class="fas fa-check fa-2x text-green-300"></i>
            </div>
        </div>

        <!-- Total Donors Card -->
        <div class="bg-teal-500 text-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-bold uppercase mb-1">Total Donors
                    </div>
                    <div class="text-2xl font-bold"><?php echo e($totalDonors); ?></div>
                </div>
                <i class="fas fa-users fa-2x text-teal-300"></i>
            </div>
        </div>

        <!-- Pending Donations Card -->
        <div class="bg-yellow-500 text-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-bold uppercase mb-1">Pending Donations</div>
                    <div class="text-2xl font-bold"><?php echo e($pendingDonations); ?></div>
                </div>
                <i class="fas fa-comments fa-2x text-yellow-300"></i>
            </div>
        </div>
    </div>

    <!-- Campaign Performance -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-gray-800">Campaign Performance</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Donations</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $campaignPerformance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($campaign->name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($campaign->status); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(\Carbon\Carbon::parse($campaign->start_date)->format('M d, Y')); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(\Carbon\Carbon::parse($campaign->end_date)->format('M d, Y')); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(number_format($campaign->total_donations, 2)); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Donations -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-gray-800">Recent Donations</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $recentDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($donation->donor_name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($donation->campaign ? $donation->campaign->name : 'N/A'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(\Carbon\Carbon::parse($donation->created_at)->format('M d, Y')); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($donation->status); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($donation->type); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\new\collab\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>