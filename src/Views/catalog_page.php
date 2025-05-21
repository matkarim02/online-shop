<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }

        h3 {
            text-align: left;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-deck {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
            margin-top: 20px;
        }

        .card {
            max-width: calc(25% - 50px);
            flex: 0 1 calc(25% - 50px);
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .card-header {
            font-size: 14px;
            color: gray;
            background-color: #f9f9f9;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }

        .card-body .text-muted {
            font-size: 12px;
            color: #888;
            margin: 5px 0;
        }

        .card-body .card-title {
            font-size: 16px;
            font-weight: bold;
            color: #35B729;
            margin: 5px 0;
        }

        .card-text {
            font-size: 20px;
            font-weight: bold;
            color: #393939;
            margin: 5px 0;
        }

        .card-footer {
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            background-color: #f9f9f9;
            text-align: center;
            color: #333;
        }

        .product-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .form-button {
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            background-color: #00c437;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 40px;
            height: 40px;
        }

        .form-button:hover {
            background-color: #029b2c;
            transform: scale(1.05);
        }

        .form-button:active {
            transform: scale(0.95);
        }

        .amount-field {
            width: 60px;
            text-align: center;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
        }

        @media (max-width: 768px) {
            .card-deck {
                flex-direction: column;
                gap: 20px;
            }

            .card {
                max-width: 100%;
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="/profile">Мой профиль</a>
    <a href="/cart">Корзина</a>
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach ($newProducts as $newProduct): ?>
            <div class="card text-center">
                <div class="card-header">Hit!</div>
                <img class="card-img-top" src="<?php echo $newProduct->getImageUrl(); ?>" alt="Card image">
                <div class="card-body">
                    <h2 class="card-text"><?php echo $newProduct->getName(); ?></h2>
                    <h5 class="card-title"><?php echo $newProduct->getDescription(); ?></h5>
                </div>
                <div class="card-footer">
                    <?php echo $newProduct->getPrice(); ?>
                </div>

                <div class="product-controls">


                    <form action="/cart-decrease" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $newProduct->getId(); ?>">
                        <input type="hidden" name="amount" class="amount-field" value="1">
                        <button type="submit" class="form-button">-</button>
                    </form>

                    <input type="number" name="amount" class="amount-field" value="<?php echo $newProduct->getUserProduct()->getAmount(); ?>" readonly>

                    <form action="/cart-increase" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $newProduct->getId(); ?>">
                        <input type="hidden" name="amount" class="amount-field" value="1">
                        <button type="submit" class="form-button">+</button>
                    </form>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
