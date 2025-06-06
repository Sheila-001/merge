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
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold">All Donations </h1>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600">Admin</span>
            <div class="bg-blue-200 text-blue-700 rounded-full px-3 py-1 font-semibold">AD</div>
        </div>
    </div>
    <!-- All Donations Table -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-lg">All Donations</h2>
            <div></div>
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
                             <a href="<?php echo e(route('admin.donations.edit', $donation)); ?>" class="text-green-600 hover:text-green-800"><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?> <?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views/admin/donation/all-donors.blade.php ENDPATH**/ ?>