<?php

namespace Modules\XemPhim\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Modules\Comments\src\Repositories\CommentsRepositoryInterface;
use Modules\Movies\src\Models\Movie;
use Modules\Reviews\src\Repositories\ReviewsRepositoryInterface;
use Modules\XemPhim\src\Repositories\XemPhimRepositoryInterface;

class XemPhimController extends BaseController
{
    private $commentsRepo;
    private $reviewsRepo;
    private $xemPhimRepo;
    public function __construct(CommentsRepositoryInterface $commentsRepo, ReviewsRepositoryInterface $reviewsRepo, XemPhimRepositoryInterface $xemPhimRepo)
    {
        $this->commentsRepo = $commentsRepo;
        $this->reviewsRepo = $reviewsRepo;
        $this->xemPhimRepo = $xemPhimRepo;
    }

    public function index(Movie $movie)
    {
        $comments = $this->renderComments($movie->comments);
        $reviews = $this->renderReviews($movie->reviews);
        $rateMovies = $this->xemPhimRepo->getHighlyRatedMovies($movie);
        return view('xemphim::main', compact('movie', 'comments', 'reviews','rateMovies'));
    }

    public function add(Request $request, Movie $movie)
    {
        $customer_id = auth('customer')->user()->id;
        $parent_id = $request->parent_id ?? null;
        $data = $this->commentsRepo->create([
            'content' => $request->comment_content,
            'movie_id' => $movie->id,
            'customer_id' => $customer_id,
            'parent_id' => $parent_id,
        ]);
        ///
        $comments = $movie->comments;
        $data = $this->renderComments($comments);
        return $data;
    }

    public function renderComments($comments, $parent_id = null, $name = null)
    {
        $string = "";
        if ($comments->count() > 0) {
            foreach ($comments as $item) {
                if ($item->parent_id == $parent_id) {
                    $class = $parent_id == null ? '' : 'comments__item--quote';
                    $string .= '
                    <li class="comments__item ' . $class . '">
                        <div class="comments__autor">
                            <img class="comments__avatar" src="' . asset('/client/img/user.svg') . '" alt="">
                            <span class="comments__name">' . $item->customers->name . '</span>
                            <span class="comments__time">' . $item->created_at . '</span>
                        </div>
                        <p class="comments__text">' . $name . " " . $item->content . '</p>
                        <div class="comments__actions">
                            <button type="button" value="' . $item->id . '" onclick="show_reply(this)"><i class="icon ion-ios-share-alt"></i>Phản hồi</button>
                        </div>
                        <div class="show_reply" id="show_reply_' . $item->id  . '">';
                    $string .= $this->renderComments($comments, $item->id, '<strong style="color: gold;">@' . $item->customers->name . '</strong>');
                    $string .= '</li>';
                }
            }
        }
        return $string;
    }

    public function reviews(Request $request, Movie $movie)
    {
        $customer_id = auth('customer')->user()->id;
        $star = $request->star;
        $data = $this->reviewsRepo->create([
            'star' => $star,
            'content' => $request->review_content,
            'movie_id' => $movie->id,
            'customer_id' => $customer_id,
        ]);
        $data = $this->renderReviews($movie->reviews);
        return $data;
    }

    public function renderReviews($reviews)
    {
        $string = "";
        if ($reviews->count() > 0) {
            foreach ($reviews as $review) {
                $string .= '<li class="reviews__item">
                <div class="reviews__autor">
                    <img class="reviews__avatar" src="' . asset('/client/img/user.svg') . '" alt="">
                    <span class="reviews__name">' . $review->customers->name . '</span>
                    <span class="reviews__time">' . $review->created_at . '</span>
                    <span class="reviews__rating reviews__rating--green">' . $review->star . '</span>
                </div>
                <p class="reviews__text">' . $review->content . '</p>
               </li>';
            }
        }
        return $string;
    }
}
