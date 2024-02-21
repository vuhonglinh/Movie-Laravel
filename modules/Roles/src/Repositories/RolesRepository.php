<?php

namespace Modules\Roles\src\Repositories;


use App\Models\Roles;

use App\Repositories\BaseRepository;
use Modules\Roles\src\Models\Role;
use Modules\Roles\src\Repositories\RolesRepositoryInterface;


class RolesRepository extends BaseRepository implements RolesRepositoryInterface

{

  public function getModel()
  {
    return Role::class;
  }

  public function getAllRoles()
  {
    return $this->model->select(['id', 'name', 'created_at'])->latest()->get();
  }
}
