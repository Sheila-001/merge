

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Campaign Dashboard</h1>
            <p class="text-muted">Overview of your campaign performance</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Campaign
            </a>
            <a href="<?php echo e(route('admin.campaigns.index')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-list me-2"></i>Manage Campaigns
            </a>
        </div>
    </div>

    <!-- Active Campaigns -->
    <h5 class="mb-4">Active Campaigns</h5>
    <div class="row g-4 mb-4">
        <?php $__currentLoopData = $campaigns->where('status', 'Ongoing'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0"><?php echo e($campaign->title); ?></h5>
                        <span class="badge bg-<?php echo e($campaign->status === 'Ongoing' ? 'success' : ($campaign->status === 'Paused' ? 'warning' : 'secondary')); ?>">
                            <?php echo e($campaign->status); ?>

                        </span>
                    </div>
                    <p class="text-muted small mb-3"><?php echo e(Str::limit($campaign->description, 100)); ?></p>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted small">Progress</span>
                            <span class="text-muted small"><?php echo e(round(($campaign->current_amount / $campaign->goal_amount) * 100)); ?>%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success"
                                 role="progressbar"
                                 style="width: <?php echo e(($campaign->current_amount / $campaign->goal_amount) * 100); ?>%">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span class="text-muted small">₱<?php echo e(number_format($campaign->current_amount, 2)); ?></span>
                            <span class="text-muted small">₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo e(route('admin.campaigns.show', $campaign)); ?>" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Recent Donations -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Recent Donations</h5>
            <a href="<?php echo e(route('admin.donations.index')); ?>" class="btn btn-sm btn-outline-primary">
                View All
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Donor</th>
                            <th>Campaign</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-secondary-subtle me-2 d-flex align-items-center justify-content-center"
                                         style="width: 32px; height: 32px;">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium"><?php echo e($donation->donor_name); ?></div>
                                        <div class="small text-muted"><?php echo e($donation->donor_email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($donation->campaign->title); ?></td>
                            <td>₱<?php echo e(number_format($donation->amount, 2)); ?></td>
                            <td>
                                <div><?php echo e($donation->created_at->format('M d, Y')); ?></div>
                                <div class="small text-muted"><?php echo e($donation->created_at->format('h:i A')); ?></div>
                            </td>
                            <td class="pe-4">
                                <span class="badge bg-<?php echo e($donation->status === 'completed' ? 'success' : 'warning'); ?>">
                                    <?php echo e(ucfirst($donation->status)); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\collab\resources\views/admin/campaigns/dashboard.blade.php ENDPATH**/ ?>