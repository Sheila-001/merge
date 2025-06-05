

<?php $__env->startSection('title', 'Manage Campaigns'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manage Campaigns</h2>
        <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Campaign
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Type</th>
                            <th>Goal</th>
                            <th>Raised</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if($campaign->image): ?>
                                            <img src="<?php echo e(Storage::url($campaign->image)); ?>"
                                                 alt="<?php echo e($campaign->title); ?>"
                                                 class="rounded me-3"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-bullhorn text-secondary"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-0"><?php echo e($campaign->title); ?></h6>
                                            <small class="text-muted"><?php echo e(Str::limit($campaign->description, 50)); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo e(ucfirst($campaign->type)); ?></td>
                                <td>₱<?php echo e(number_format($campaign->goal_amount, 2)); ?></td>
                                <td>₱<?php echo e(number_format($campaign->funds_raised, 2)); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($campaign->status === 'active' ? 'success' : 'warning'); ?>">
                                        <?php echo e(ucfirst($campaign->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('admin.campaigns.show', $campaign)); ?>"
                                           class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.campaigns.edit', $campaign)); ?>"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteCampaignModal<?php echo e($campaign->id); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Campaign Modal -->
                                    <div class="modal fade" id="deleteCampaignModal<?php echo e($campaign->id); ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">Delete Campaign</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                                    <h4>Are you sure?</h4>
                                                    <p class="text-muted">Do you really want to delete this campaign? This process cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="<?php echo e(route('admin.campaigns.destroy', $campaign)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($campaigns->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\campaigns\index.blade.php ENDPATH**/ ?>