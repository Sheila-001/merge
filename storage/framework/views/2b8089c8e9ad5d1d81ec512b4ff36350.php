<!-- Donation Sidebar -->
<div class="card">
    <div class="card-body">
        <h6 class="text-muted mb-3">Donation Management</h6>
        <div class="list-group list-group-flush">
            <a href="<?php echo e(route('admin.donations.index')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('admin.donations.index') ? 'active' : ''); ?>">
                <i class="fas fa-list me-2"></i> All Donations
            </a>
            <a href="<?php echo e(route('admin.donations.create')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('admin.donations.create') ? 'active' : ''); ?>">
                <i class="fas fa-plus me-2"></i> Add New
            </a>
            <a href="<?php echo e(route('admin.donations.dropoffs')); ?>" class="list-group-item list-group-item-action <?php echo e(request()->routeIs('admin.donations.dropoffs') ? 'active' : ''); ?>">
                <i class="fas fa-box me-2"></i> Pending Drop-offs
            </a>
        </div>
    </div>
</div>

<?php if(isset($showStats) && $showStats): ?>
<div class="card mt-4">
    <div class="card-body">
        <h6 class="text-muted mb-3">Quick Stats</h6>
        <div class="d-flex align-items-center mb-3">
            <div class="flex-shrink-0">
                <i class="fas fa-dollar-sign text-primary"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">Monetary</h6>
                <small class="text-muted">Total: ₱<?php echo e(number_format($monetaryTotal ?? 0, 2)); ?></small>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-box text-success"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">Non-Monetary</h6>
                <small class="text-muted">Total: <?php echo e($nonMonetaryCount ?? 0); ?> items</small>
            </div>
        </div>
    </div>
</div>
<?php endif; ?> <?php /**PATH C:\collab\resources\views/admin/donation/components/sidebar.blade.php ENDPATH**/ ?>