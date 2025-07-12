<?php

namespace Controllers;
use Model\Product;
use Model\Review;
use Model\UserProduct;
use Request\AddReviewRequest;
use Request\GetProductRequest;

class CatalogController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCatalog()
    {


        if (!$this->authService->check()) {
            header('location: /login');
            exit();
        }
        $user = $this->authService->getUser();
        $products = Product::getAllProduct();


        if($products !== null){
            $newProducts = [];
            foreach ($products as $product)
            {
                $user_product = UserProduct::getById($user->getId(), $product->getId());
                if($user_product === null) {
                    $user_product = new UserProduct();
                    $user_product->setAmount(0);
                }
                $product->setUserProduct($user_product);
                $newProducts[] = $product;
            }
        }
        require_once '../Views/catalog_page.php';

    }

    public function getProduct(GetProductRequest $request)
    {
        if(!$this->authService->check()){
            header('location: /login');
            exit();
        }

        $product_id = $request->getProductId();
        $product = Product::getProductById($product_id);
        $reviews = Review::getProductReviewsByProductId($product_id);
        $avg_rating = Review::getAvgRatingByProductId($product_id);



        if($product !== null){

            if($reviews !== null)
            {
                $product->setReviews($reviews);
                if ($avg_rating !== null) {
                    $product->setAvgRating($avg_rating);
                } else {
                    $product->setAvgRating(0.0);
                }

            }



            require_once '../Views/product_review_page.php';
        } else {
            header('location: /catalog');
        }


    }



    public function addReview(AddReviewRequest $request)
    {
        if(!$this->authService->check()){
            header('location: /login');
            exit();
        }



        Review::setProductReview(
            $request->getProductId(),
            $request->getAuthor(),
            $request->getText(),
            $request->getRating()
        );

        $product = Product::getProductById($request->getProductId());
        $reviews = Review::getProductReviewsByProductId($request->getProductId());
        $avg_rating = Review::getAvgRatingByProductId($request->getProductId());



        if($product !== null){

            if($reviews !== null)
            {
                $product->setReviews($reviews);
                if ($avg_rating !== null) {
                    $product->setAvgRating($avg_rating);
                } else {
                    $product->setAvgRating(0.0);
                }
            }

            require_once '../Views/product_review_page.php';
        } else {
            header('location: /catalog');
        }

    }


}