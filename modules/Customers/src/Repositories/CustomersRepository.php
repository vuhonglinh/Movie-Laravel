<?php

namespace Modules\Customers\src\Repositories;


use App\Models\Customers;

use App\Repositories\BaseRepository;
use Modules\Customers\src\Models\Customer;
use Modules\Customers\src\Repositories\CustomersRepositoryInterface;


class CustomersRepository extends BaseRepository implements CustomersRepositoryInterface

{

  public function getModel()
  {
    return Customer::class;
  }

  public function getAllCustomers()
  {
    return $this->model->select(['id', 'name', 'email', 'password', 'created_at'])->latest()->get();
  }
}
