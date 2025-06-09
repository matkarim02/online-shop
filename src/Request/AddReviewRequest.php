<?php

namespace Request;

class AddReviewRequest
{
    public function __construct(private array $data)
    {
    }

    public function getProductId(): int
    {
        return $this->data['product_id'];
    }

    public function getAuthor(): string
    {
        return $this->data['author'];
    }

    public function getText(): string
    {
        return $this->data['text'];
    }

    public function getRating(): int
    {
        return $this->data['rating'];
    }
}