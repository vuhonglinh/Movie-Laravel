<?php

namespace Modules\Genres\src\Repositories;


use App\Models\Genres;

use App\Repositories\BaseRepository;

use Modules\Genres\src\Models\Genre;
use Modules\Genres\src\Repositories\GenresRepositoryInterface;


class GenresRepository extends BaseRepository implements GenresRepositoryInterface

{

  public function getModel()
  {
    return Genre::class;
  }
}
