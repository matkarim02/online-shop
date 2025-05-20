
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <style>
        :root {
            --primary-color: #5755d9;
            --accent-color: #ff6b6b;
            --light-bg: #f8f9fa;
            --dark-text: #333;
            --light-text: #5a5a5a;
            --border-radius: 10px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
            transform: rotate(30deg);
        }

        .checkout-form {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;
        }

        .personal-info {
            flex: 1;
            min-width: 300px;
        }

        .order-summary {
            flex: 1;
            min-width: 300px;
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: var(--dark-text);
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 50px;
            background-color: var(--accent-color);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--light-text);
            font-weight: 500;
        }

        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
        }

        .textarea-icon {
            position: absolute;
            left: 15px;
            top: 20px;
            color: var(--light-text);
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(87, 85, 217, 0.2);
            outline: none;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background-color: #eee;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-thumbnail img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .product-details h3 {
            margin: 0;
            font-size: 16px;
            color: var(--dark-text);
        }

        .product-price {
            font-weight: bold;
            color: var(--dark-text);
        }

        .product-quantity {
            color: var(--light-text);
            font-size: 14px;
            margin-top: 4px;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #e0e0e0;
            margin-top: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn:hover {
            background-color: #4644c8;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(87, 85, 217, 0.2);
        }

        @media (max-width: 768px) {
            .checkout-form {
                flex-direction: column;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        Оформление заказа
    </header>

    <form id="orderForm" action="/create-order" method="POST">
        <div class="checkout-form">
            <div class="personal-info">
                <h2>Данные получателя</h2>

                <div class="form-group">
                    <label for="name">Имя получателя</label>
                    <?php if(!empty($errors['name'])): ?>
                        <p style="color: red" class = "errors"> <?php echo $errors['name'] ?> </p>
                    <?php endif; ?>
                    <div class="input-container">
                        <!-- Иконка пользователя -->
                        <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя получателя" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <?php if(!empty($errors['phone'])): ?>
                        <p style="color: red" class = "errors"> <?php echo $errors['phone'] ?> </p>
                    <?php endif; ?>
                    <div class="input-container">
                        <!-- Иконка телефона -->
                        <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Адрес доставки</label>
                    <?php if(!empty($errors['address'])): ?>
                        <p style="color: red" class = "errors"> <?php echo $errors['address'] ?> </p>
                    <?php endif; ?>
                    <div class="input-container">
                        <!-- Иконка местоположения -->
                        <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Город, улица, дом, квартира" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comments">Комментарий к заказу</label>
                    <div class="input-container">
                        <!-- Иконка комментария -->
                        <svg class="textarea-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <textarea class="form-control" id="comments" name="comments" placeholder="Укажите дополнительную информацию по заказу"></textarea>
                    </div>
                </div>
            </div>

            <div class="order-summary">
                <h2>Ваш заказ</h2>

                <ul class="product-list">
                    <?php foreach ($products as $product): ?>
                        <li class="product-item">
                            <div class="product-info">
                                <div class="product-thumbnail">
                                    <img src="<?php echo $product->getProduct()->getImageUrl()?>" alt="Cтул">
                                </div>
                                <div class="product-details">
                                    <h3><?php echo $product->getProduct()->getName()?></h3>
                                    <div class="product-quantity"><?php echo $product->getAmount()?> × <?php echo $product->getProduct()->getPrice()?></div>
                                </div>
                            </div>
                            <div class="product-price"><?php echo $product->getProduct()->getPrice()?> тг</div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="total-line">
                    <span>Итого:</span>
                    <span><?php echo $total?></span>
                </div>

                <button type="submit" class="btn pulse">
                    <!-- Иконка чека для кнопки -->
                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" style="margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Оформить заказ
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Маска для телефона
    document.getElementById('phone').addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : '+' + x[1] + ' (' + x[2] + ') ' + (x[3] ? x[3] + '-' + x[4] : (x[3] ? x[3] : '')) + (x[5] ? '-' + x[5] : '');
    });

    // Анимация кнопки
    // setTimeout(() => {
    //     document.querySelector('.pulse').classList.remove('pulse');
    // }, 5000);
</script>
</body>
</html>