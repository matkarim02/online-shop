<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Страница продукта</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .product-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-image-wrapper {
            width: 100%;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fafafa;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-title {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0 10px;
            color: #222;
        }

        .average-rating {
            font-size: 18px;
            color: #f39c12;
            margin-bottom: 15px;
        }

        .stars {
            color: #f1c40f;
        }

        .product-description {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }

        .reviews-section {
            margin-top: 50px;
        }

        .reviews-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .review {
            background-color: #f9f9f9;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-left: 5px solid #00c437;
            border-radius: 10px;
        }

        .review-author {
            font-weight: bold;
            color: #222;
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .review-date {
            font-weight: normal;
            font-size: 14px;
            color: #999;
        }

        .review-text {
            font-size: 16px;
            color: #444;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .review-rating {
            font-size: 16px;
            color: #f39c12;
        }

        .review-form {
            margin-top: 40px;
            background: #f5f5f5;
            padding: 25px;
            border-radius: 12px;
        }

        .review-form h3 {
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
        }

        .review-form input,
        .review-form textarea,
        .review-form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .review-form button {
            background-color: #00c437;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .review-form button:hover {
            background-color: #029b2c;
        }

        @media (max-width: 600px) {
            .product-container {
                padding: 20px;
            }

            .product-title {
                font-size: 24px;
            }

            .product-description {
                font-size: 16px;
            }

            .review-form h3 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<div class="product-container">
    <div class="product-image-wrapper">
        <img src="<?php echo $product->getImageUrl(); ?>" alt="Изображение товара" class="product-image">
    </div>

    <h1 class="product-title"><?php echo $product->getName(); ?></h1>
    <div class="average-rating">
        Средняя оценка:
        <span class="stars">
            <?php
                $avg = round($product->getAvgRating());
            echo str_repeat('★', $avg);
            echo str_repeat('☆', 5 - $avg);
            ?>
        </span>
        (<?php echo number_format($product->getAvgRating(), 1); ?>/5)
    </div>

    <p class="product-description"><?php echo $product->getDescription(); ?></p>

    <div class="reviews-section">
        <h2>Отзывы:</h2>

        <?php foreach ($product->getReviews() as $review): ?>
            <div class="review">
                <div class="review-author">
                    <?php echo htmlspecialchars($review->getAuthor()); ?>
                    <span class="review-date">
                        <?php echo date('Y-m-d H:i:s', strtotime($review->getCreatedAt())); ?>
                    </span>
                </div>
                <div class="review-text"><?php echo nl2br(htmlspecialchars($review->getText())); ?></div>
                <div class="review-rating">
                    Оценка:
                    <span class="stars">
                        <?php
                        $rating = (int) $review->getRating();
                        echo str_repeat('★', $rating);
                        echo str_repeat('☆', 5 - $rating);
                        ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="review-form">
        <h3>Оставить отзыв</h3>
        <form action="/add-review" method="POST">
            <input type="text" name="author" placeholder="Ваше имя" required>
            <textarea name="text" rows="4" placeholder="Ваш отзыв..." required></textarea>
            <label for="rating">Ваша оценка:</label>
            <select name="rating" id="rating" required>
                <option value="">Выберите оценку</option>
                <option value="5">5 — Отлично</option>
                <option value="4">4 — Хорошо</option>
                <option value="3">3 — Нормально</option>
                <option value="2">2 — Плохо</option>
                <option value="1">1 — Ужасно</option>
            </select>
            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
            <button type="submit">Отправить</button>
        </form>
    </div>
</div>
</body>
</html>
