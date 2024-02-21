<?php

namespace Modules\XemPhim\src\Repositories;


use App\Models\XemPhim;

use App\Repositories\BaseRepository;
use Modules\Movies\src\Models\Movie;
use Modules\XemPhim\src\Repositories\XemPhimRepositoryInterface;


class XemPhimRepository extends BaseRepository implements XemPhimRepositoryInterface

{

  public function getModel()
  {
    return Movie::class;
  }

  public function getHighlyRatedMovies($movie)
  {
    return $this->model->whereHas('reviews', function ($query) use ($movie) { //reviews ở đây tên phương thức xác lập mỗi quan hệ giữa 2 bảng
      $query->where('star', '>=', 8);
    })->inRandomOrder()->whereNotIn('id', [$movie->id])->take(5)->get();
  }
}
