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

  public function totalMovies()
  {
    return $this->model->count();
  }
  public function getTopRatedMovies()
  {
    return $this->model
      ->with(['reviews']) // Load relationship reviews
      ->withAvg('reviews', 'star') // Lấy giá trị trung bình của cột 'star' trong bảng reviews
      ->orderByDesc('reviews_avg_star') // Sắp xếp giảm dần theo đánh giá trung bình
      ->take(5)
      ->get();
  }

  public function getTopViewMovies()
  {
    return $this->model->orderByDesc('views')->take(5)->get();
  }
  public function getTotalViews() //Tổng phim
  {
    return $this->model->sum('views');
  }
}
