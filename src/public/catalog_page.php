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
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <div class="card-header">Hit!</div>
                <img class="card-img-top" src="<?php echo $product['image_url'];?>" alt="Card image">
                <div class="card-body">
                    <p class="card-text text-muted"> <?php echo $product['name'];?> </p>
                    <h5 class="card-title"> <?php echo $product['description'];?> </h5>
                </div>
                <div class="card-footer"> <?php echo $product['price'];?> </div>
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
        max-width: calc(25% - 50px);;
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