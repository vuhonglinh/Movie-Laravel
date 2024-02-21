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
}
