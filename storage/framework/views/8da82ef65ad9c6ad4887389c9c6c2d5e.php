<?php use Illuminate\Support\Facades\Storage; ?>
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
    <div class="p-8 bg-[#f3f6fb] min-h-screen">
        <!-- Donation Management Header -->
        <div class="bg-white rounded-xl shadow p-6 mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Donation Management</h1>
            <div class="flex items-center space-x-2">
                <span class="text-gray-600">Admin</span>
                <div class="bg-blue-200 text-blue-700 rounded-full px-3 py-1 font-semibold">AD</div>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Monetary Donations</span>
                <span class="text-3xl font-bold mt-2"><?php echo e(number_format($monetaryTotal ?? $monetaryDonations ?? 0)); ?></span>
                <span class="text-sm mt-1 text-green-600"><?php echo e(number_format($monetaryChange ?? 0, 1)); ?>% from last month</span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-blue-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Non-Monetary Items</span>
                <span class="text-3xl font-bold mt-2"><?php echo e(number_format($nonMonetaryCount ?? $nonMonetaryItems ?? 0)); ?></span>
                <span class="text-sm mt-1 text-green-600"><?php echo e(number_format($nonMonetaryChange ?? 0, 1)); ?>% from last month</span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-purple-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Campaign</span>
                <span class="text-3xl font-bold mt-2"><?php echo e(number_format($campaignTotal ?? 0)); ?></span>
                <span class="text-sm mt-1 text-green-600"><?php echo e(number_format($campaignChange ?? 0, 1)); ?>% from last month</span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-orange-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Total Donors</span>
                <span class="text-3xl font-bold mt-2"><?php echo e(number_format($donorCount ?? $totalDonors ?? 0)); ?></span>
                <span class="text-sm mt-1 text-green-600"><?php echo e(number_format($donorChange ?? 0, 1)); ?>% from last month</span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-green-100"></span>
            </div>
        </div>

        <!-- Recent Donations Table -->
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-lg">Recent Donations</h2>
                <div class="flex items-center space-x-2">
                    <a href="<?php echo e(route('admin.donations.all-donors')); ?>" class="bg-blue-600 text-white px-4 py-1 rounded">Show all Donors</a>
                </div>
            </div>
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Donor</th>
                        <th class="py-2 text-left">Type</th>
                        <th class="py-2 text-left">Amount</th>
                        <th class="py-2 text-left">Status</th>
                        <th class="py-2 text-left">Date</th>
                        <th class="py-2 text-left">Proof</th>
                        <th class="py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="py-2 flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($donation->donor_name)); ?>&background=random" class="w-8 h-8 rounded-full" alt="<?php echo e($donation->donor_name); ?>">
                            <span>
                                <div class="font-semibold"><?php echo e($donation->donor_name); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($donation->donor_email); ?></div>
                            </span>
                        </td>
                        <td class="py-2"><?php echo e(ucfirst($donation->type)); ?></td>
                        <td class="py-2 font-bold">
                            <?php if($donation->type === 'monetary'): ?>
                                ₱<?php echo e(number_format($donation->amount, 2)); ?>

                            <?php else: ?>
                                <?php echo e($donation->item_name); ?> 
                            <?php endif; ?>
                        </td>
                        <td class="py-2">
                            <span class="bg-<?php echo e($donation->status === 'completed' ? 'green' : 'yellow'); ?>-100 text-<?php echo e($donation->status === 'completed' ? 'green' : 'yellow'); ?>-600 px-2 py-1 rounded">
                                <?php echo e(ucfirst($donation->status)); ?>

                            </span>
                        </td>
                        <td class="py-2"><?php echo e($donation->created_at->format('M d, Y')); ?></td>
                        <td class="py-2">
                            <?php if($donation->proof_path): ?>
                                <img src="<?php echo e(Storage::url($donation->proof_path)); ?>" alt="Donation Proof" class="w-10 h-10 object-cover rounded">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td class="py-2">
                            <div class="flex space-x-2">
                                 <a href="<?php echo e(route('admin.donations.show', $donation)); ?>" class="text-green-800 bg-green-100 px-2 py-1 rounded hover:bg-green-200"><i class="fas fa-eye"></i> View</a>
                                 <form action="<?php echo e(route('admin.donations.destroy', $donation->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this donation?');">
                                     <?php echo csrf_field(); ?>
                                     <?php echo method_field('DELETE'); ?>
                                     <button type="submit" class="text-red-800 bg-red-100 px-2 py-1 rounded hover:bg-red-200"><i class="fas fa-trash"></i> Delete</button>
                                 </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
             <div class="flex justify-between items-center mt-4">
                 <span class="text-xs text-gray-500">Showing <?php echo e($donations->firstItem()); ?> to <?php echo e($donations->lastItem()); ?> of <?php echo e($donations->total()); ?> entries</span>
                 <div class="flex space-x-1">
                     <?php echo e($donations->links()); ?>

                 </div>
             </div>
        </div>

        <!-- Drop-Off Confirmation -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-lg mb-2">Drop-Off Confirmation</h2>
            <p class="text-gray-500 mb-4">Manage and track non-monetary donations</p>
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $pendingDropoffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dropoff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Donor Name: <span class="font-semibold text-gray-800"><?php echo e($dropoff->donor_name); ?></span></p>
                            <p class="text-sm text-gray-600">Donor Email: <span class="font-semibold text-gray-800"><?php echo e($dropoff->donor_email); ?></span></p>
                            <p class="text-sm text-gray-600">Donor Phone: <span class="font-semibold text-gray-800"><?php echo e($dropoff->donor_phone ?? 'N/A'); ?></span></p>
                            <p class="text-sm text-gray-600">Category: <span class="font-semibold text-gray-800"><?php echo e($dropoff->category ?? 'N/A'); ?></span></p>
                            <p class="text-sm text-gray-600">Condition: <span class="font-semibold text-gray-800"><?php echo e($dropoff->condition ?? 'N/A'); ?></span></p>
                        </div>
                        <div>
                            <?php if(!empty($dropoff->item_name)): ?>
                                <p class="text-sm text-gray-600">Item: <span class="font-semibold text-gray-800"><?php echo e($dropoff->item_name); ?></span></p>
                            <?php endif; ?>
                            <p class="text-sm text-gray-600">Quantity: <span class="font-semibold text-gray-800"><?php echo e($dropoff->quantity ?? 'N/A'); ?></span></p>
                            <p class="text-sm text-gray-600">Expected Date: <span class="font-semibold text-gray-800"><?php echo e($dropoff->expected_date?->format('M d, Y') ?? 'N/A'); ?></span></p>
                            <p class="text-sm text-gray-600">Status: <span class="badge bg-warning"><?php echo e(ucfirst($dropoff->status)); ?></span></p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('admin.donations.show', $dropoff)); ?>" class="bg-blue-600 text-white px-3 py-1 rounded text-xs font-semibold hover:bg-blue-700">Review</a>
                        <form action="<?php echo e(route('admin.donations.update-status', $dropoff->id)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-xs font-semibold hover:bg-green-600">Confirmed</button>
                        </form>
                        <form action="<?php echo e(route('admin.donations.update-status', $dropoff->id)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs font-semibold hover:bg-red-600">Reject</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-600">No pending drop-offs at this time.</p>
                <?php endif; ?>
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
<?php endif; ?>

<!-- Proof Image Modal -->
<div id="proofModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 max-w-lg max-h-full overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h3 class="text-lg font-semibold">Donation Proof</h3>
            <button id="closeProofModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <img id="proofImage" src="" alt="Donation Proof" class="max-w-full h-auto">
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item i {
    width: 1.25rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Search donors..."]');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('table tbody tr').forEach(row => {
            const donorName = row.querySelector('td:first-child').textContent.toLowerCase();
            const donorEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = donorName.includes(searchTerm) || donorEmail.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter functionality
    document.querySelectorAll('[data-filter]').forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            const filterValue = this.dataset.filter;
            document.querySelectorAll('table tbody tr').forEach(row => {
                if (filterValue === 'all') {
                    row.style.display = '';
                    return;
                }
                const type = row.querySelector('td:nth-child(3) .badge').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(5) .badge').textContent.toLowerCase();
                row.style.display = (type === filterValue || status === filterValue) ? '' : 'none';
            });
        });
    });

    // Proof image modal functionality
    const proofModal = document.getElementById('proofModal');
    const proofImage = document.getElementById('proofImage');
    const closeProofModal = document.getElementById('closeProofModal');
    const viewProofLinks = document.querySelectorAll('.view-proof-link');

    viewProofLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const imageUrl = this.dataset.proofUrl;
            proofImage.src = imageUrl;
            proofModal.classList.remove('hidden');
        });
    });

    closeProofModal.addEventListener('click', function() {
        proofModal.classList.add('hidden');
        proofImage.src = ''; // Clear the image source when closing
    });

    // Close modal when clicking outside of the modal content
    proofModal.addEventListener('click', function(e) {
        if (e.target === proofModal) {
            proofModal.classList.add('hidden');
            proofImage.src = ''; // Clear the image source when closing
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views/admin/donation/index.blade.php ENDPATH**/ ?>