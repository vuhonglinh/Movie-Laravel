<?php

namespace Modules\TrangChu\src\Repositories;


use App\Models\TrangChu;

use App\Repositories\BaseRepository;
use Modules\Movies\src\Models\Movie;
use Modules\TrangChu\src\Repositories\TrangChuRepositoryInterface;


class TrangChuRepository extends BaseRepository implements TrangChuRepositoryInterface

{

  public function getModel()
  {
    return Movie::class;
  }


  public function danhSachPhimMoi()
  {
    return $this->model->select([
      "id",
      "thumbnail",
      "name",
      "slug",
      "quality",
      'is_series',
      'created_at',
    ])->whereHas('categories', function ($query) {
      $query->where('categories.id', 1);
    })->get();
  }

  public function danhSachPhimDanhGiaCao()
  {
    return $this->model->select([
      "id",
      "thumbnail",
      "name",
      "slug",
      "quality",
      'is_series',
      'created_at',
    ])->orderBy('created_at', 'desc')->paginate(12);
  }
}
