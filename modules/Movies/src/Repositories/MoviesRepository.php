<?php

namespace Modules\Movies\src\Repositories;

use App\Models\Movies;
use App\Repositories\BaseRepository;
use Modules\Movies\src\Models\Movie;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;

class MoviesRepository extends BaseRepository implements MoviesRepositoryInterface
{
  public function getModel()
  {
    return Movie::class;
  }
  public function getAllMovies()
  {
    return $this->model->select([
      "id",
      "thumbnail",
      "name",
      "slug",
      "description",
      "release_date",
      "directors",
      "quality",
      "trailer_url",
      "movie_url",
      'is_series',
      'created_at',
    ])->latest();
  }
}
