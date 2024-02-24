<?php

namespace Modules\Orders\src\Repositories;


use App\Models\Orders;

use App\Repositories\BaseRepository;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;


class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface

{

  public function getModel()
  {
    return Order::class;
  }
}
