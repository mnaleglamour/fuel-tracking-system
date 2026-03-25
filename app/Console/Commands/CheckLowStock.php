<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pump;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckLowStock extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'lowstock:check';

    /**
     * The console command description.
     */
    protected $description = 'Check all pumps for low stock and send notifications to admins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $lowStockPumps = Pump::whereNotNull('low_stock_threshold')
            ->whereColumn('stock', '<=', 'low_stock_threshold')
            ->where(function ($query) use ($today) {
                $query->whereNull('notified_at')
                      ->orWhere('notified_at', '<', $today->startOfDay());
            })
            ->get();

        if ($lowStockPumps->isEmpty()) {
            $this->info('No low stock pumps found.');
            return 0;
        }

        $admins = User::where('role', 'admin')->get();

        foreach ($lowStockPumps as $pump) {
            foreach ($admins as $admin) {
                $notification = new LowStockNotification(
                    $pump,
                    0, // no attempted sale
                    $pump->stock
                );

                $admin->notify($notification);

                // SMS if phone available
                if ($admin->phone) {
                    $notification->sendSms($admin->phone);
                }
            }

            // Mark as notified today
            $pump->update(['notified_at' => $today]);
        }

        $this->info("Sent notifications for {$lowStockPumps->count()} low stock pumps.");

        return 0;
    }
}

