<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Orders\src\Models\Order;

class UpdateSubscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-subscription-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update subscription status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Lấy tất cả đơn hàng đã hết hạn
        Order::where('expiry_date', '<=', Carbon::now())
            ->update(['status' => false]);
        $this->info('Success update subscription status');
    }
}
