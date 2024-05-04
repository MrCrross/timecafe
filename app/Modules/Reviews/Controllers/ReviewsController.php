<?php

namespace App\Modules\Reviews\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Reviews\Models\Review;
use App\Modules\Reviews\Requests\ReviewsStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewsController extends Controller
{
    public function index(): Response
    {
        $reviews = Review::with('user')
            ->get();

        return response()->view('reviews.welcome', [
            'reviews' => $reviews
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewsStoreRequest $request): RedirectResponse
    {
        $fields = [
            'user_id' => Auth::id(),
            'content' => $request->post('content'),
            'rating' => $request->post('rating'),
        ];

        Review::create($fields);

        return Redirect::route('reviews.welcome')->with('status', 'review-created');
    }
}
