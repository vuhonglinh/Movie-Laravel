<?php

namespace Modules\Profile\src\Repositories;


use App\Models\Profile;

use App\Repositories\BaseRepository;

use Modules\Profile\src\Repositories\ProfileRepositoryInterface;
use Modules\Users\src\Models\User;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface

{

  public function getModel()
  {
    return User::class;
  }
}
