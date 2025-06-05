

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Scholarship Applications</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($application->tracking_code); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($application->name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($application->course); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php echo e($application->status === 'approved' ? 'bg-green-100 text-green-800' : ''); ?>

                                <?php echo e($application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                <?php echo e($application->status === 'declined' ? 'bg-red-100 text-red-800' : ''); ?>">
                                <?php echo e(ucfirst($application->status)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <select 
                                class="status-select border rounded px-2 py-1"
                                data-application-id="<?php echo e($application->id); ?>"
                                onchange="updateStatus(this, '<?php echo e($application->id); ?>')"
                            >
                                <option value="pending" <?php echo e($application->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="approved" <?php echo e($application->status === 'approved' ? 'selected' : ''); ?>>Approve</option>
                                <option value="declined" <?php echo e($application->status === 'declined' ? 'selected' : ''); ?>>Decline</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function updateStatus(selectElement, applicationId) {
    const status = selectElement.value;
    fetch(`/admin/applications/${applicationId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        // Refresh the page or update the UI as needed
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status');
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\applications\index.blade.php ENDPATH**/ ?>