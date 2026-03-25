# Low Fuel Notification Implementation TODO

## Approved Plan Steps:

1. ✅ **Plan approved by user**
2. ✅ Created migration `2025_01_15_100000_add_notified_at_to_pumps_table.php`
3. ✅ Created `app/Console/Commands/CheckLowStock.php` (fixed)
4. ✅ Updated `LowStockNotification.php` (add database channel)
5. ✅ Updated `Pump.php` model (fillable + casts)
6. ✅ Created `app/Console/Kernel.php` (schedule hourly)
7. Add NotificationController with mark-read routes/UI
4. Update `LowStockNotification.php` to include 'database' channel
5. Create/edit `app/Console/Kernel.php` to schedule command hourly
6. Update `Pump.php` model with `$casts['notified_at'] = 'datetime';`
7. Add NotificationController with mark-read routes/UI
8. Update DashboardController for unread count
9. Update views: layouts/app.blade.php (bell), admin/dashboard.blade.php (list)
10. **Run `php artisan migrate`**
11. **Test: `php artisan queue:work`, simulate low stock**
12. **Setup server cron: `schedule:run`**

**Next step: 8. DashboardController unread count**
5. Create/edit `app/Console/Kernel.php` to schedule command hourly
6. Update `Pump.php` model with `$casts['notified_at'] = 'datetime';`
7. Add NotificationController with mark-read routes/UI
8. Update DashboardController for unread count
9. Update views: layouts/app.blade.php (bell), admin/dashboard.blade.php (list)
10. **Run `php artisan migrate`**
11. **Test: `php artisan queue:work`, simulate low stock**
12. **Setup server cron: `schedule:run`**

**Next step: 2. Migration**

