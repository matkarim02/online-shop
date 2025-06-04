<?php

namespace Controllers;
use Model\Product;
use Model\Review;
use Model\UserProduct;

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

    public function getProduct()
    {
        if(!$this->authService->check()){
            header('location: /login');
            exit();
        }

        $product_id = $_POST['product_id'];
        $product = $this->productModel->getProductById($product_id);
        $reviews = $this->reviewModel->getProductReviewsByProductId($product_id);
        $avg_rating = $this->reviewModel->getAvgRatingByProductId($product_id);



        if($product !== null){

            if($reviews !== null)
            {
                $product->setReviews($reviews);

            }

            if ($avg_rating !== null) {
                $product->setAvgRating($avg_rating);
            } else {
                $product->setAvgRating(0.0);
            }

            require_once '../Views/product_review_page.php';
        } else {
            header('location: /catalog');
        }


    }



    public function addReview()
    {
        if(!$this->authService->check()){
            header('location: /login');
            exit();
        }

        $product_id = $_POST['product_id'];
        $author = $_POST['author'];
        $text = $_POST['text'];
        $rating = $_POST['rating'];

        $this->reviewModel->setProductReview($product_id, $author, $text, $rating);

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
                    $product->setAvgRating(0.0); // или какое значение ты хочешь по умолчанию
                }
            }

            require_once '../Views/product_review_page.php';
        } else {
            header('location: /catalog');
        }

    }


}