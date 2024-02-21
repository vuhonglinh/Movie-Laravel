<?php

namespace Modules\Comments\src\Repositories;



use App\Repositories\BaseRepository;
use Modules\Comments\src\Models\Comment;
use Modules\Comments\src\Repositories\CommentsRepositoryInterface;


class CommentsRepository extends BaseRepository implements CommentsRepositoryInterface

{

  public function getModel()
  {
    return Comment::class;
  }
}
