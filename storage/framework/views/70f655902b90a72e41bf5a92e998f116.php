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
    <div class="max-w-7xl mx-auto py-8">
        <!-- Header Row: Title and User Badge -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold">Dashboard Overview</h1>
            <div class="flex items-center gap-2">
                <span class="text-gray-500">Admin</span>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-bold">AD</span>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Total Users</span>
                <span class="text-3xl font-bold mt-2"><?php echo e($totalUsers ?? 0); ?></span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-blue-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Pending Applicants</span>
                <span class="text-3xl font-bold mt-2"><?php echo e($pendingApplicants ?? 0); ?></span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-yellow-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Active Students</span>
                <span class="text-3xl font-bold mt-2"><?php echo e($activeStudents ?? 0); ?></span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-green-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Active Events</span>
                <span class="text-3xl font-bold mt-2"><?php echo e($activeEvents ?? 0); ?></span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-purple-100"></span>
            </div>
        </div>

        <!-- Recent Events and Recent Activity Sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Events -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Recent Events</h2>
                    <a href="#" class="text-blue-600 hover:underline">View all</a>
                </div>
                <?php if($recentEvents->count() > 0): ?>
                    <ul class="space-y-4">
                        <?php $__currentLoopData = $recentEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="border-b pb-2 last:border-b-0 last:pb-0">
                                <p class="font-semibold"><?php echo e($event->title); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($event->start_date->format('M d, Y H:i A')); ?> - <?php echo e($event->end_date->format('M d, Y H:i A')); ?></p>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">No recent events found.</p>
                <?php endif; ?>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-lg mb-4">Recent Activity</h2>
                <p class="text-gray-500">No recent activity to display.</p>
                
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
<?php endif; ?><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>