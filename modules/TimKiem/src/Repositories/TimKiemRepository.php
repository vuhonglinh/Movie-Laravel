<?php

namespace Modules\TimKiem\src\Repositories;


use App\Models\TimKiem;

use App\Repositories\BaseRepository;
use Modules\Movies\src\Models\Movie;
use Modules\TimKiem\src\Repositories\TimKiemRepositoryInterface;


class TimKiemRepository extends BaseRepository implements TimKiemRepositoryInterface

{

  public function getModel()
  {
    return Movie::class;
  }

  public function getSearch($name)
  {
    return $this->model->where('name', 'LIKE', "%" . $name . "%")->get();
  }
}
