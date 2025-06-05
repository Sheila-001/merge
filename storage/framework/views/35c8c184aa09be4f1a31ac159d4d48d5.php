

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <!-- Header with Dynamic Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">
                <?php if(request('type') === 'monetary'): ?>
                    Monetary Donations
                <?php elseif(request('type') === 'non_monetary'): ?>
                    Non-Monetary Donations
                <?php elseif(request('status') === 'completed'): ?>
                    Completed Donations
                <?php elseif(request('status') === 'pending'): ?>
                    Pending Donations
                <?php else: ?>
                    All Donations
                <?php endif; ?>
            </h1>
            <p class="text-muted mb-0">
                <?php if(request('type') === 'monetary'): ?>
                    List of all monetary donations
                <?php elseif(request('type') === 'non_monetary'): ?>
                    List of all non-monetary donations
                <?php elseif(request('status') === 'completed'): ?>
                    List of all completed donations
                <?php elseif(request('status') === 'pending'): ?>
                    List of all pending donations
                <?php else: ?>
                    Comprehensive list of all donations
                <?php endif; ?>
            </p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.donations.index')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="donation-card mb-4">
        <div class="card-body">
            <form id="searchForm" action="<?php echo e(route('admin.donations.all')); ?>" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" 
                               placeholder="Search by donor name, email..." 
                               name="search" value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="type">
                        <option value="">All Types</option>
                        <option value="monetary" <?php echo e(request('type') === 'monetary' ? 'selected' : ''); ?>>Monetary</option>
                        <option value="non_monetary" <?php echo e(request('type') === 'non_monetary' ? 'selected' : ''); ?>>Non-Monetary</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        <option value="completed" <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>>Completed</option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="campaign_id">
                        <option value="">All Campaigns</option>
                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" <?php echo e(request('campaign_id') == $id ? 'selected' : ''); ?>>
                                <?php echo e($title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-filter me-2"></i> Apply Filters
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="resetFilters">
                        <i class="fas fa-undo"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="donation-card">
        <div class="donation-table-container">
            <table class="donation-table">
                <thead>
                    <tr>
                        <th>Donor</th>
                        <th>Type</th>
                        <th>Amount/Item</th>
                        <th>Campaign</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <img src="<?php echo e(asset('images/default-avatar.png')); ?>" 
                                         class="rounded-circle" alt="Avatar">
                                </div>
                                <div>
                                    <div class="fw-medium"><?php echo e($donation->donor_name); ?></div>
                                    <div class="small text-muted"><?php echo e($donation->donor_email); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($donation->type === 'monetary' ? 'primary' : 'warning'); ?>">
                                <?php echo e(ucfirst($donation->type)); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($donation->type === 'monetary'): ?>
                                <div class="fw-medium">₱<?php echo e(number_format($donation->amount, 2)); ?></div>
                                <div class="small text-muted"><?php echo e(ucfirst($donation->payment_method)); ?></div>
                            <?php else: ?>
                                <div class="fw-medium"><?php echo e($donation->item_description); ?></div>
                                <div class="small text-muted"><?php echo e($donation->quantity); ?> units</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($donation->campaign): ?>
                                <span class="badge bg-info"><?php echo e($donation->campaign->title); ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($donation->status_color); ?>">
                                <?php echo e(ucfirst($donation->status)); ?>

                            </span>
                        </td>
                        <td>
                            <div class="fw-medium"><?php echo e($donation->created_at->format('M d, Y')); ?></div>
                            <div class="small text-muted"><?php echo e($donation->created_at->format('h:i A')); ?></div>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.donations.show', $donation)); ?>">
                                            <i class="fas fa-eye me-2"></i> View Details
                                        </a>
                                    </li>
                                    <?php if($donation->type === 'non-monetary' && $donation->status === 'pending'): ?>
                                    <li>
                                        <form action="<?php echo e(route('admin.donations.update-status', $donation)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-check me-2"></i> Mark as Received
                                            </button>
                                        </form>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">No donations found</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($donations->hasPages()): ?>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing <?php echo e($donations->firstItem()); ?> to <?php echo e($donations->lastItem()); ?> 
                    of <?php echo e($donations->total()); ?> donations
                </div>
                <?php echo e($donations->appends(request()->except('page'))->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/donations.js')); ?>"></script>
<script>
    // Reset filters functionality
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.querySelectorAll('#searchForm input, #searchForm select').forEach(element => {
            element.value = '';
        });
        document.getElementById('searchForm').dispatchEvent(new Event('submit'));
    });
</script>
<?php $__env->stopPush(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\donation\all.blade.php ENDPATH**/ ?>