<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #E8F5E9; /* Светло-зелёный фон */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            width: 450px; /* Увеличил ширину формы */
            text-align: center;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2E7D32; /* Тёмно-зелёный */
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 24px;
        }

        .input-group {
            margin: 20px 0;
            text-align: left;
        }

        label {
            display: block;
            font-size: 16px;
            color: #388E3C; /* Средне-зелёный */
            margin-bottom: 7px;
            padding-left: 5px;
            font-weight: 600;
        }

        input {
            width: calc(100% - 20px); /* Отступы по краям */
            padding: 12px;
            font-size: 18px;
            border: 2px solid #C8E6C9;
            border-radius: 8px;
            outline: none;
            background: #F1F8E9;
            display: block;
            margin: auto;
            transition: 0.3s;
        }

        input:focus {
            border-color: #4CAF50;
            background: #E8F5E9;
        }

        button {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            border: none;
            outline: none;
            border-radius: 8px;
            background: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
        }

        button:hover {
            background: #388E3C;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Добавить товар</h2>
    <form action="/addProduct" method="POST">
        <div class="input-group">
            <label for="product_id">ID товара</label>
            <input type="number" id="product_id" name="product_id" required>
            <?php if(isset($errors['product_id'])): ?>
                <p style="color: red" class = "errors"> <?php echo $errors['product_id'] ?> </p>
            <?php endif; ?>
        </div>
        <div class="input-group">
            <label for="amount">Количество</label>
            <input type="number" id="amount" name="amount" required>
            <?php if(isset($errors['amount'])): ?>
                <p style="color: red" class = "errors"> <?php echo $errors['amount'] ?> </p>
            <?php endif; ?>
        </div>
        <button type="submit">Добавить</button>
    </form>
</div>

</body>
</html>
