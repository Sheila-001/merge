

<?php $__env->startSection('title', 'Campaign Calendar'); ?>

<?php $__env->startPush('styles'); ?>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    /* Calendar Container Styles */
    .calendar-container {
        background: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .calendar-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.75rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    /* Button Styles */
    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .action-btn i {
        font-size: 0.875rem;
    }

    .action-btn.primary {
        background: #4361ee;
        border: none;
        color: white;
    }

    .action-btn.secondary {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #495057;
    }

    /* FullCalendar Customization */
    .fc {
        font-family: 'Poppins', sans-serif;
    }

    .fc .fc-toolbar {
        margin-bottom: 1.5rem;
    }

    .fc .fc-toolbar-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .fc .fc-button {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: none;
    }

    .fc .fc-button-primary {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #495057;
    }

    .fc .fc-button-primary:not(:disabled):hover {
        background: #e9ecef;
        border-color: #dee2e6;
        color: #212529;
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background: #4361ee;
        border-color: #4361ee;
        color: white;
    }

    /* Calendar Grid and Events */
    .fc .fc-daygrid-day {
        min-height: 100px;
    }

    .fc .fc-daygrid-day-frame {
        padding: 4px;
    }

    .fc .fc-daygrid-day-number {
        font-size: 0.875rem;
        color: #495057;
        padding: 4px 8px;
    }

    .fc .fc-event {
        border: none;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 0.75rem;
        margin-bottom: 2px;
        cursor: pointer;
    }

    /* Event Colors by Category */
    .fc .fc-event.feeding-program {
        background-color: #4361ee !important;
        border-left: 3px solid #3046c0;
    }

    .fc .fc-event.outreach-program {
        background-color: #2ecc71 !important;
        border-left: 3px solid #27ae60;
    }

    .fc .fc-event.rice-distribution {
        background-color: #9b59b6 !important;
        border-left: 3px solid #8e44ad;
    }

    /* Category Legend */
    .category-legend {
        margin-top: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .category-legend h6 {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #495057;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        margin-right: 1.5rem;
        font-size: 0.75rem;
        color: #6c757d;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        margin-right: 6px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Campaign Calendar</h1>
        <div class="flex space-x-4">
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                <i class="fas fa-tags mr-2"></i>Manage Categories
            </a>
            <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="px-4 py-2 bg-[#1B4B5A] text-white rounded-md hover:bg-[#2C5F6E] transition-colors">
                <i class="fas fa-plus mr-2"></i>Add New Campaign
            </a>
        </div>
    </div>

    <div id="calendar"></div>

    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Campaign Categories</h2>
        <div class="flex flex-wrap gap-4">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded bg-blue-500 mr-2"></div>
                <span class="text-sm text-gray-600">Feeding Programs</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded bg-green-500 mr-2"></div>
                <span class="text-sm text-gray-600">Outreach Programs</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded bg-purple-500 mr-2"></div>
                <span class="text-sm text-gray-600">Rice Distributions</span>
            </div>
        </div>
    </div>
</div>

<!-- Campaign Details Modal -->
<div id="campaignModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold" id="modalTitle"></h3>
            <button onclick="closeCampaignModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modalContent"></div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeCampaignModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                Close
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: <?php echo json_encode($campaigns, 15, 512) ?>,
        eventClick: function(info) {
            showCampaignModal(info.event);
        },
        eventClassNames: function(arg) {
            return [getCategoryClass(arg.event.extendedProps.category)];
        }
    });
    calendar.render();
});

function getCategoryClass(category) {
    const categoryMap = {
        'Feeding Program': 'bg-blue-500',
        'Outreach Program': 'bg-green-500',
        'Rice Distribution': 'bg-purple-500'
    };
    return categoryMap[category] || 'bg-gray-500';
}

function showCampaignModal(event) {
    const modal = document.getElementById('campaignModal');
    const title = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');

    title.textContent = event.title;
    content.innerHTML = `
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Category</p>
                <p class="font-medium">${event.extendedProps.category}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-medium">${event.start.toLocaleDateString()} - ${event.end.toLocaleDateString()}</p>
            </div>
            ${event.extendedProps.pledged ? `
                <div>
                    <p class="text-sm text-gray-500">Pledged Amount</p>
                    <p class="font-medium">${event.extendedProps.pledged}</p>
                </div>
            ` : ''}
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                    event.extendedProps.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                }">
                    ${event.extendedProps.status}
                </span>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeCampaignModal() {
    const modal = document.getElementById('campaignModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<?php $__env->stopPush(); ?> 
<?php echo $__env->make('components.app-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\collab\resources\views/admin/calendar/index.blade.php ENDPATH**/ ?>