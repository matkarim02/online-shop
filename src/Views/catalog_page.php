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
                <img class="card-img-top" src="<?php echo $product['image_url'];?>" alt="Card image">
                <div class="card-body">
                    <p class="card-text text-muted"><?php echo $product['name'];?></p>
                    <h5 class="card-title"><?php echo $product['description'];?></h5>
                </div>
                <div class="card-footer">
                    <?php echo $product['price'];?>
                </div>
                <!-- Форма теперь находится внутри карточки -->
                <form action="/addProduct" method="POST" class="product-form">
                    <input id="product_id" name="product_id" value="<?php echo $product['id']; ?>" type="hidden">

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
        color: #007bff;
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
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        width: 80%; /* Ограничение ширины кнопки */
        max-width: 250px; /* Максимальная ширина */
        margin: 0 auto; /* Центрирование */
    }

    .form-button:hover {
        background-color: #0056b3;
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