<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;


class ReviewController extends Controller
{

    public function index($productId)
    {
        return ReviewResource::collection( Product::find( $productId )->reviews );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(ReviewRequest $request,$product_id)
    {
        $product = Product::find( $product_id );
        $review = new Review($request->all());
        $product->reviews()->save($review);
        return response([
           'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }


    public function update(Request $request, $product_id, $review_id)
    {
        $review = Review::find( $review_id );
        $product = Product::find( $product_id );
        $review->update($request->all());
        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }


    public function destroy($product_id, $review_id)
    {
        $product = Product::find( $product_id );
        $review = Review::find( $review_id );
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
