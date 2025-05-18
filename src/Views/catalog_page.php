<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
</head>
<body>
<div class="container">
    <a href="/profile"> Мой профиль</a>
    <a href="/cart"> Корзина</a>
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <div class="card-header">Hit!</div>
                <img class="card-img-top" src="<?php echo $product->getImageUrl();?>" alt="Card image">
                <div class="card-body">
                    <h2 class="card-text"><?php echo $product->getName();?></h2>
                    <h5 class="card-title"><?php echo $product->getDescription();?></h5>
                </div>
                <div class="card-footer">
                    <?php echo $product->getPrice();?>
                </div>
                <!-- Форма теперь находится внутри карточки -->
                <form action="/cart" method="POST" class="product-form">
                    <input id="product_id" name="product_id" value="<?php echo $product->getId(); ?>" type="hidden">

                    <div class="form-group">
                        <label for="amount" class="form-label">Количество</label>
                        <input type="number" id="amount" name="amount" class="form-input" min="1" placeholder="1">
                        <?php if (isset($errors['amount'])): ?>
                            <p class="form-error"><?php echo $errors['amount']; ?></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="form-button">Добавить в корзину</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>

</html>
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
        height: 300px; /* Устанавливаем фиксированную высоту */
        object-fit: cover; /* Сохраняем пропорции и обрезаем лишнее */
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

    /* Стили для формы */
    .product-form {
        display: flex;
        flex-direction: column;
        align-items: center; /* Выравнивание по центру */
        gap: 10px;
        padding: 15px;
        background-color: #f9f9f9;
        border-top: 1px solid #ddd;
    }

    /* Стили для группы полей ввода */
    .form-group {
        display: flex;
        flex-direction: column;
        width: 80%; /* Ограничение ширины группы */
        max-width: 250px; /* Максимальная ширина */
        margin: 0 auto; /* Центрирование */
        gap: 5px;
    }

    /* Стили для метки */
    .form-label {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        text-align: left;
    }

    /* Стили для поля ввода */
    .form-input {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
        outline: none;
        transition: border-color 0.3s ease;
        width: 100%; /* Занимает всю ширину родителя */
        box-sizing: border-box; /* Учитывает padding и border в ширину */
    }

    /* Стили для сообщений об ошибках */
    .form-error {
        font-size: 12px;
        color: #e74c3c;
        margin-top: 5px;
        text-align: left;
    }

    /* Стили для кнопки */
    .form-button {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #35B729;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        width: 80%; /* Ограничение ширины кнопки */
        max-width: 250px; /* Максимальная ширина */
        margin: 0 auto; /* Центрирование */
    }

    .form-button:hover {
        background-color: #2a8c20;
        transform: scale(1.05);
    }

    .form-button:active {
        transform: scale(0.98);
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






<!--<!DOCTYPE html>-->
<!--<html lang="ru">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Каталог товаров</title>-->
<!--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">-->
<!--    <style>-->
<!--        :root {-->
<!--            --bg-color: #f8f9fa;-->
<!--            --card-bg: #ffffff;-->
<!--            --primary-color: #3a86ff;-->
<!--            --text-color: #212529;-->
<!--            --text-secondary: #6c757d;-->
<!--            --border-color: #e9ecef;-->
<!--            --card-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);-->
<!--            --btn-primary: #3a86ff;-->
<!--            --btn-hover: #2a75f5;-->
<!--            --hit-badge: #ff6b6b;-->
<!--        }-->
<!---->
<!--        * {-->
<!--            margin: 0;-->
<!--            padding: 0;-->
<!--            box-sizing: border-box;-->
<!--        }-->
<!---->
<!--        body {-->
<!--            font-family: 'Inter', sans-serif;-->
<!--            background-color: var(--bg-color);-->
<!--            color: var(--text-color);-->
<!--            line-height: 1.5;-->
<!--            padding: 20px;-->
<!--        }-->
<!---->
<!--        .container {-->
<!--            max-width: 1200px;-->
<!--            margin: 0 auto;-->
<!--            padding: 0 15px;-->
<!--        }-->
<!---->
<!--        .header {-->
<!--            display: flex;-->
<!--            justify-content: space-between;-->
<!--            align-items: center;-->
<!--            margin-bottom: 30px;-->
<!--            padding-bottom: 15px;-->
<!--            border-bottom: 1px solid var(--border-color);-->
<!--        }-->
<!---->
<!--        .page-title {-->
<!--            font-size: 24px;-->
<!--            font-weight: 600;-->
<!--            color: var(--text-color);-->
<!--        }-->
<!---->
<!--        .nav-links {-->
<!--            display: flex;-->
<!--            gap: 20px;-->
<!--        }-->
<!---->
<!--        .nav-link {-->
<!--            text-decoration: none;-->
<!--            color: var(--text-color);-->
<!--            font-weight: 500;-->
<!--            font-size: 15px;-->
<!--            transition: color 0.2s;-->
<!--            padding: 8px 12px;-->
<!--            border-radius: 6px;-->
<!--        }-->
<!---->
<!--        .nav-link:hover {-->
<!--            color: var(--primary-color);-->
<!--            background-color: rgba(58, 134, 255, 0.05);-->
<!--        }-->
<!---->
<!--        .card-deck {-->
<!--            display: grid;-->
<!--            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));-->
<!--            gap: 30px;-->
<!--        }-->
<!---->
<!--        .card {-->
<!--            background-color: var(--card-bg);-->
<!--            border-radius: 12px;-->
<!--            overflow: hidden;-->
<!--            box-shadow: var(--card-shadow);-->
<!--            transition: transform 0.2s, box-shadow 0.2s;-->
<!--            position: relative;-->
<!--        }-->
<!---->
<!--        .card:hover {-->
<!--            transform: translateY(-5px);-->
<!--            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);-->
<!--        }-->
<!---->
<!--        .card-header {-->
<!--            position: absolute;-->
<!--            top: 12px;-->
<!--            left: 12px;-->
<!--            background-color: var(--hit-badge);-->
<!--            color: white;-->
<!--            padding: 6px 10px;-->
<!--            font-size: 12px;-->
<!--            font-weight: 600;-->
<!--            border-radius: 6px;-->
<!--            text-transform: uppercase;-->
<!--            letter-spacing: 0.5px;-->
<!--        }-->
<!---->
<!--        .card-img-top {-->
<!--            width: 100%;-->
<!--            height: 200px;-->
<!--            object-fit: cover;-->
<!--            border-bottom: 1px solid var(--border-color);-->
<!--        }-->
<!---->
<!--        .card-body {-->
<!--            padding: 20px;-->
<!--        }-->
<!---->
<!--        .card-text {-->
<!--            font-size: 18px;-->
<!--            font-weight: 600;-->
<!--            margin-bottom: 8px;-->
<!--            color: var(--text-color);-->
<!--        }-->
<!---->
<!--        .card-title {-->
<!--            font-size: 14px;-->
<!--            font-weight: 400;-->
<!--            color: var(--text-secondary);-->
<!--            margin-bottom: 15px;-->
<!--        }-->
<!---->
<!--        .card-footer {-->
<!--            padding: 0 20px 15px;-->
<!--            font-size: 20px;-->
<!--            font-weight: 700;-->
<!--            color: var(--primary-color);-->
<!--        }-->
<!---->
<!--        .product-form {-->
<!--            padding: 0 20px 20px;-->
<!--        }-->
<!---->
<!--        .form-group {-->
<!--            margin-bottom: 15px;-->
<!--        }-->
<!---->
<!--        .form-label {-->
<!--            display: block;-->
<!--            font-size: 14px;-->
<!--            color: var(--text-secondary);-->
<!--            margin-bottom: 6px;-->
<!--        }-->
<!---->
<!--        .form-input {-->
<!--            width: 100%;-->
<!--            padding: 10px 12px;-->
<!--            border: 1px solid var(--border-color);-->
<!--            border-radius: 6px;-->
<!--            font-size: 14px;-->
<!--            transition: border-color 0.2s, box-shadow 0.2s;-->
<!--        }-->
<!---->
<!--        .form-input:focus {-->
<!--            outline: none;-->
<!--            border-color: var(--primary-color);-->
<!--            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);-->
<!--        }-->
<!---->
<!--        .form-error {-->
<!--            font-size: 12px;-->
<!--            color: var(--hit-badge);-->
<!--            margin-top: 5px;-->
<!--        }-->
<!---->
<!--        .form-button {-->
<!--            width: 100%;-->
<!--            padding: 12px;-->
<!--            background-color: var(--btn-primary);-->
<!--            color: white;-->
<!--            border: none;-->
<!--            border-radius: 6px;-->
<!--            font-size: 14px;-->
<!--            font-weight: 500;-->
<!--            cursor: pointer;-->
<!--            transition: background-color 0.2s;-->
<!--        }-->
<!---->
<!--        .form-button:hover {-->
<!--            background-color: var(--btn-hover);-->
<!--        }-->
<!---->
<!--        @media (max-width: 768px) {-->
<!--            .card-deck {-->
<!--                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));-->
<!--                gap: 20px;-->
<!--            }-->
<!---->
<!--            .header {-->
<!--                flex-direction: column;-->
<!--                align-items: flex-start;-->
<!--                gap: 15px;-->
<!--            }-->
<!---->
<!--            .nav-links {-->
<!--                width: 100%;-->
<!--            }-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<div class="container">-->
<!--    <div class="header">-->
<!--        <h1 class="page-title">Каталог товаров</h1>-->
<!--        <div class="nav-links">-->
<!--            <a href="/profile" class="nav-link">Мой профиль</a>-->
<!--            <a href="/cart" class="nav-link">Корзина</a>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="card-deck">-->
<!--        --><?php //foreach ($products as $product): ?>
<!--            <div class="card">-->
<!--                --><?php //if (isset($product['is_hit']) && $product['is_hit']): ?>
<!--                    <div class="card-header">Хит!</div>-->
<!--                --><?php //endif; ?>
<!--                <img class="card-img-top" src="--><?php //echo $product['image_url'];?><!--" alt="--><?php //echo $product['name'];?><!--">-->
<!--                <div class="card-body">-->
<!--                    <h2 class="card-text">--><?php //echo $product['name'];?><!--</h2>-->
<!--                    <h5 class="card-title">--><?php //echo $product['description'];?><!--</h5>-->
<!--                </div>-->
<!--                <div class="card-footer">-->
<!--                    --><?php //echo $product['price'];?><!-- ₽-->
<!--                </div>-->
<!--                <form action="/addProduct" method="POST" class="product-form">-->
<!--                    <input id="product_id" name="product_id" value="--><?php //echo $product['id']; ?><!--" type="hidden">-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="amount_--><?php //echo $product['id']; ?><!--" class="form-label">Количество</label>-->
<!--                        <input type="number" id="amount_--><?php //echo $product['id']; ?><!--" name="amount" class="form-input" min="1" value="1">-->
<!--                        --><?php //if (isset($errors['amount']) && isset($_POST['product_id']) && $_POST['product_id'] == $product['id']): ?>
<!--                            <p class="form-error">--><?php //echo $errors['amount']; ?><!--</p>-->
<!--                        --><?php //endif; ?>
<!--                    </div>-->
<!---->
<!--                    <button type="submit" class="form-button">Добавить в корзину</button>-->
<!--                </form>-->
<!--            </div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->