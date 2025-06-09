<?php

namespace Request;

use Model\Product;

class DecreaseProductRequest
{
    public function __construct(private array $data)
    {
    }

    public function getProductId(): int
    {
        return $this->data['product_id'];
    }

    public function getAmount(): int
    {
        return $this->data['amount'];
    }

    public function validateAddProduct(): array
    {

        $errors = [];

        if (!empty($this->data['product_id'])) {
            $product_id = (int)$this->data['product_id'];

            $productModel = new Product();
            $product = $productModel->getProductById($product_id);

            if ($product === false) {
                $errors['product_id'] = "Product does not exist";
            }
        } else {
            $errors['product_id'] = "Product ID is required";
        }


        if (empty($this->data['amount'])) {
            $errors['amount'] = 'Amount is required';
        } elseif (!is_numeric($this->data['amount'])) {
            $errors['amount'] = 'Amount must be numeric';
        }

        return $errors;
    }
}