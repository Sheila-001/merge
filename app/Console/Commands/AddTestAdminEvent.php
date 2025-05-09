<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class AddTestAdminEvent extends Command
{
    protected $signature = 'add:test-admin-event';
    protected $description = 'Add a test admin-created event for dashboard testing';

    public function handle()
    {
        $event = new Event();
        $event->title = 'Test Admin Event';
        $event->description = 'This is a test event.';
        $event->start_date = Carbon::now()->addDays(2);
        $event->end_date = Carbon::now()->addDays(2)->addHours(2);
        $event->location = 'Test Location';
        $event->status = 'active';
        $event->created_by = 1;
        $event->is_admin_posted = true;
        $event->save();

        $this->info('Test admin event created!');
    }
} 