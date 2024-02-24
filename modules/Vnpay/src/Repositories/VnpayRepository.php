<?php

namespace Modules\Vnpay\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Vnpay\src\Models\Vnpay;
use Modules\Vnpay\src\Repositories\VnpayRepositoryInterface;


class VnpayRepository extends BaseRepository implements VnpayRepositoryInterface

{

  public function getModel()
  {
    return Vnpay::class;
  }

  public function getAllVnpay()
  {
    return $this->model->select([
      'code',
      'amount',
      'bank_code',
      'card_type',
      'order_info',
      'tmn_code',
      'order_id',
    ])->latest();
  }
}
