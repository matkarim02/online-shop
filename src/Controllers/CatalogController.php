<?php

namespace Controllers;
use Model\Product;
use Model\Review;
use Model\UserProduct;
use Request\AddReviewRequest;
use Request\GetProductRequest;

class CatalogController extends BaseController
{
    private Product $productModel;
    private UserProduct $userProductModel;
    private Review $reviewModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new Product();
        $this->userProductModel = new UserProduct();
        $this->reviewModel = new Review();
    }

    public function getCatalog()
    {


        if (!$this->authService->check()) {
            header('location: /login');
            exit();
        }
        $user = $this->authService->getUser();
        $products = $this->productModel->getAllProduct();


        if($products !== null){
            $newProducts = [];
            foreach ($products as $product)
            {
                $user_product = $this->userProductModel->getById($user->getId(), $product->getId());
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
        $product = $this->productModel->getProductById($product_id);
        $reviews = $this->reviewModel->getProductReviewsByProductId($product_id);
        $avg_rating = $this->reviewModel->getAvgRatingByProductId($product_id);



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



        $this->reviewModel->setProductReview(
            $request->getProductId(),
            $request->getAuthor(),
            $request->getText(),
            $request->getRating()
        );

        $product = $this->productModel->getProductById($request->getProductId());
        $reviews = $this->reviewModel->getProductReviewsByProductId($request->getProductId());
        $avg_rating = $this->reviewModel->getAvgRatingByProductId($request->getProductId());



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