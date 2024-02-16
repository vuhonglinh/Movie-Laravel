<?php

namespace Modules\Categories\src\Repositories;


use App\Models\Categories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface

{

  public function getModel()
  {
    return Category::class;
  }

  public function getAllCategories()
  {
    return $this->model->select(['id', 'name', 'slug', 'description', 'created_at'])->get();
  }
}
