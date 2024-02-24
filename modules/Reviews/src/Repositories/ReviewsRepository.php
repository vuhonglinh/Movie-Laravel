<?php

namespace Modules\Reviews\src\Repositories;


use App\Models\Reviews;

use App\Repositories\BaseRepository;
use Modules\Reviews\src\Models\Review;
use Modules\Reviews\src\Repositories\ReviewsRepositoryInterface;


class ReviewsRepository extends BaseRepository implements ReviewsRepositoryInterface

{

  public function getModel()
  {
    return Review::class;
  }

  public function totalReviews()
  {
    return $this->model->count();
  }


}
