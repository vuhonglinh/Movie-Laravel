<?php

namespace Modules\Dashboard\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Comments\src\Repositories\CommentsRepositoryInterface;
use Modules\Customers\src\Repositories\CustomersRepositoryInterface;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Modules\Reviews\src\Repositories\ReviewsRepositoryInterface;

class DashboardController extends BaseController
{
    private $moviesRepo;
    private $reviewsRepo;
    private $commentsRepo;
    private $customersRepo;
    public function __construct(
        MoviesRepositoryInterface $moviesRepo,
        ReviewsRepositoryInterface $reviewsRepo,
        CommentsRepositoryInterface $commentsRepo,
        CustomersRepositoryInterface $customersRepo
    ) {
        $this->moviesRepo = $moviesRepo;
        $this->reviewsRepo = $reviewsRepo;
        $this->commentsRepo = $commentsRepo;
        $this->customersRepo = $customersRepo;
    }

    public function index()
    {
        $totalViews = $this->moviesRepo->getTotalViews();
        $totalMovies = $this->moviesRepo->totalMovies();
        $totalComments = $this->commentsRepo->totalComments();
        $totalReviews = $this->reviewsRepo->totalReviews();

        $topReviews = $this->moviesRepo->getTopRatedMovies();
        $getTopViewMovies = $this->moviesRepo->getTopViewMovies();
        $getNewCustomers = $this->customersRepo->getNewCustomers();
        return view('dashboard::dashboard', compact('totalViews', 'totalMovies', 'totalComments', 'totalReviews', 'topReviews', 'getTopViewMovies','getNewCustomers'));
    }
}
