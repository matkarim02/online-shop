<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: "Arial", sans-serif;
            background: linear-gradient(135deg, #e3ffe7, #d9e7ff);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .cart-container {
            max-width: 800px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .cart-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr 100px 80px 50px;
            align-items: center;
            gap: 15px;
            padding: 18px;
            border-radius: 10px;
            background: #f9f9f9;
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 12px;
            height: 140px; /* Фиксированная высота */
        }

        .cart-item:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 140px;
            height: 140px;
            border-radius: 10px;
            object-fit: contain;
            transition: transform 0.3s ease-in-out;
            will-change: transform;
            background-color: #fff;
        }

        .cart-item:hover img {
            transform: scale(1.05);
        }


        .cart-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 18px; /* Отступ от картинки */
        }

        .cart-details h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .cart-details p {
            margin: 5px 0;
            color: #666;
            font-size: 16px;
        }

        .quantity-input {
            width: 55px;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: box-shadow 0.3s ease-in-out;
        }

        .quantity-input:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(0, 180, 0, 0.5);
        }

        .remove-btn {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 6px;
            font-size: 18px;
            transition: background 0.3s ease-in-out, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: #e63e3e;
            transform: scale(1.07);
        }

        .price {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        .checkout-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .total-price {
            font-size: 22px;
            font-weight: bold;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #38b000, #008c29);
            color: white;
            padding: 14px 26px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease-in-out, transform 0.2s, box-shadow 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #2f9e00, #00791f);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 128, 0, 0.3);
        }

        /* Мобильная адаптация */
        @media (max-width: 600px) {
            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .quantity-input {
                margin: 0 auto;
            }

            .price {
                text-align: center;
            }

            .checkout-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
<div class="cart-container">
    <h2 class="cart-title">🛒 Ваша корзина</h2>

    <?php foreach($products as $product): ?>
        <div class="cart-item">
            <img src="<?php echo $product['image_url'];?>" alt="Продукт 1">
            <div class="cart-details">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
            </div>
            <input type="number" class="quantity-input" id = "amount"  value="<?php echo $product['amount'];?>" min="1">
            <p class="price"><?php echo $product['price'];?> тг</p>
            <button class="remove-btn"><i class="fas fa-trash"></i></button>
        </div>
    <?php endforeach; ?>

    <div class="checkout-container">
        <h3 class="total-price">Итого: $19.99</h3>
        <button class="checkout-btn"><i class="fas fa-money-bill-wave"></i> Оформить заказ</button>
    </div>
</div>
</body>
</html>
