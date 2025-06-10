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
     <?php $__env->slot('title', null, []); ?> 
        Reports
     <?php $__env->endSlot(); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container-fluid px-4">
    <h1 class="h3 mb-4">Reports</h1>

    <!-- Top Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Monetary Donations</div>
                        <div class="text-xl font-semibold text-gray-800">₱ <?php echo e(number_format($monetaryDonationsTotal, 2)); ?></div>
                    </div>
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Non-Monetary</div>
                        <div class="text-xl font-semibold text-gray-800"><?php echo e($nonMonetaryDonationsCount); ?></div>
                    </div>
                    <i class="fas fa-box-open fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Campaigns</div>
                        <div class="text-xl font-semibold text-gray-800"><?php echo e($campaignsCount); ?></div>
                    </div>
                    <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Donors</div>
                        <div class="text-xl font-semibold text-gray-800"><?php echo e($donorsCount); ?></div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts/Graphs Placeholder -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h6 class="text-lg font-semibold mb-4">Monthly Donations</h6>
            
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="monthlyDonationsChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h6 class="text-lg font-semibold mb-4">Monthly Trends</h6>
            
            <div class="chart-area">
                
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h6 class="text-lg font-semibold mb-0">Recent Activity</h6>
            
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount/Items</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $recentDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($donation->created_at->format('M d, Y H:i')); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(ucfirst($donation->type)); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php if($donation->type === 'monetary'): ?>
                                ₱<?php echo e(number_format($donation->amount, 2)); ?>

                            <?php else: ?>
                                <?php echo e($donation->item_details); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?php echo e($donation->status === 'completed' ? 'green' : ($donation->status === 'pending' ? 'yellow' : 'gray')); ?>-100 text-<?php echo e($donation->status === 'completed' ? 'green' : ($donation->status === 'pending' ? 'yellow' : 'gray')); ?>-800">
                                <?php echo e(ucfirst($donation->status)); ?>

                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const monthlyLabels = <?php echo json_encode($monthlyLabels, 15, 512) ?>; // Use data from controller
    const monthlyData = <?php echo json_encode($monthlyData, 15, 512) ?>;     // Use data from controller

    const ctx = document.getElementById('monthlyDonationsChart').getContext('2d');
    const monthlyDonationsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Donations',
                data: monthlyData,
                backgroundColor: 'orange',
                borderColor: 'darkorange',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 7000,
                    ticks: {
                        stepSize: 1000
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    });

    const monthlyTrendsChartCtx = document.querySelector('.chart-area').appendChild(document.createElement('canvas')).getContext('2d');
    const monthlyTrendsChart = new Chart(monthlyTrendsChartCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Donations',
                data: monthlyData,
                backgroundColor: 'orange',
                borderColor: 'darkorange',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 90,
                    ticks: {
                        stepSize: 10
                    },
                    title: {
                        display: true,
                        text: 'PHP'
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD',  minimumFractionDigits: 0, maximumFractionDigits: 0  }).format(context.raw * 1000);
                            return label;
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 5,
                    backgroundColor: 'orange',
                    borderColor: 'darkorange'
                }
            }
        }
    });
</script>


<form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>





 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?> <?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views/admin/donation/reports.blade.php ENDPATH**/ ?>