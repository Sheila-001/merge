

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Campaign Details</h1>
        <a href="<?php echo e(route('admin.campaigns.dashboard')); ?>" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Campaigns
        </a>
    </div>

    <div class="row">
        <!-- Campaign Image -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <?php if($campaign->image): ?>
                        <img src="<?php echo e(asset('storage/' . $campaign->image)); ?>"
                             alt="<?php echo e($campaign->title); ?>"
                             class="img-fluid rounded"
                             style="width: 100%; height: 400px; object-fit: cover;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light rounded"
                             style="height: 400px;">
                            <i class="fas fa-image text-secondary" style="font-size: 4rem;"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Campaign Info -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Title</h6>
                        <h4 class="mb-0"><?php echo e($campaign->title); ?></h4>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Description</h6>
                        <p class="mb-0"><?php echo e($campaign->description); ?></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Type</h6>
                        <p class="mb-0"><?php echo e($campaign->type); ?></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Status</h6>
                        <span class="badge rounded-pill <?php echo e(in_array($campaign->status, ['active', 'ongoing']) ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning'); ?>">
                            <?php echo e(ucfirst($campaign->status)); ?>

                        </span>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Funding Progress</h6>
                        <?php
                            $percentage = ($campaign->funds_raised / $campaign->goal_amount) * 100;
                            $percentage = min($percentage, 100);
                        ?>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo e($percentage); ?>%;"
                                 aria-valuenow="<?php echo e($percentage); ?>"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-1">Goal Amount</h6>
                                <h4 class="mb-0">₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></h4>
                            </div>
                            <div class="text-end">
                                <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-1">Funds Raised</h6>
                                <h4 class="mb-0">₱<?php echo e(number_format($campaign->funds_raised, 2)); ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-1">Start Date</h6>
                                <p class="mb-0"><?php echo e($campaign->start_date->format('M d, Y')); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-1">End Date</h6>
                                <p class="mb-0"><?php echo e($campaign->end_date->format('M d, Y')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .fs-12 {
        font-size: 12px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\campaigns\show.blade.php ENDPATH**/ ?>