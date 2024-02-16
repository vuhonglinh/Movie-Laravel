<?php

namespace Modules\Episodes\src\Repositories;


use App\Models\Episodes;

use App\Repositories\BaseRepository;
use Modules\Episodes\src\Models\Episode;
use Modules\Episodes\src\Repositories\EpisodesRepositoryInterface;


class EpisodesRepository extends BaseRepository implements EpisodesRepositoryInterface

{

  public function getModel()
  {
    return Episode::class;
  }
}
