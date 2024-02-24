<?php

namespace Modules\Packages\src\Repositories;


use App\Models\Packages;

use App\Repositories\BaseRepository;
use Modules\Packages\src\Models\Package;
use Modules\Packages\src\Repositories\PackagesRepositoryInterface;


class PackagesRepository extends BaseRepository implements PackagesRepositoryInterface

{

  public function getModel()
  {
    return Package::class;
  }

  public function getAllPackages()
  {
    $users = auth('customer')->user();
    if ($users) {
      $orders = $users->orders->where('status', true);

        $arrayId = [];
        foreach ($orders as $order) {
          array_push($arrayId, $order->package_id);
        }
        return $this->model->select(['id', 'name', 'price', 'duration', 'powers'])->whereNotIn('id', $arrayId)->get();
      
    }
    return $this->model->select(['id', 'name', 'price', 'duration', 'powers'])->get();
  }
}
