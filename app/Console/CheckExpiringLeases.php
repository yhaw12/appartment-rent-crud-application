<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tennants;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Log;

class CheckExpiringLeases extends Command
{
    protected $signature = 'leases:check-expiring';
    protected $description = 'Check for expiring leases and send notifications';

    public function handle()
    {
        Log::info('Starting to check for expiring leases');

        $tenants = Tennants::all();
        Log::info('Found ' . $tenants->count() . ' tenants');

        $notificationController = new NotificationController();

        foreach ($tenants as $tenant) {
            Log::info("Checking lease for tenant: {$tenant->tenant_name}");
            try {
                $notificationController->scheduleNotifications($tenant);
            } catch (\Exception $e) {
                Log::error("Error processing tenant {$tenant->tenant_name}: " . $e->getMessage());
            }
        }

        Log::info('Finished checking for expiring leases');

        $this->info('Expiring leases have been checked and notifications scheduled if necessary.');
    }
}