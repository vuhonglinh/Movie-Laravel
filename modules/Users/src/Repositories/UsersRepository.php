<?php

namespace Modules\Users\src\Repositories;


use App\Models\Users;

use App\Repositories\BaseRepository;
use Modules\Users\src\Models\User;
use Modules\Users\src\Repositories\UsersRepositoryInterface;


class UsersRepository extends BaseRepository implements UsersRepositoryInterface

{

  public function getModel()
  {
    return User::class;
  }

  public function getAllUsers(){
    return $this->model->select(['id','name','email','created_at','role_id'])->latest()->get();
  }
}
