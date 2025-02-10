<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #04AA6D;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(4, 170, 109, 0.3);
            outline: none;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 7px;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .registerbtn {
            background-color: #35B729;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .registerbtn:hover {
            background-color: #28a745;
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .signin {
            margin-top: 20px;
            text-align: center;
        }

        .signin a {
            color: dodgerblue;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .signin a:hover {
            color: #004aad;
        }
    </style>
</head>
<body>
<form action="handle_registration_form.php" method="POST">
    <div class="container">
        <h1>Регистрация</h1>
        <p>Пожалуйста, заполните форму для создания аккаунта.</p>
        <hr>

        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" placeholder="Введите имя" id="name" required>
            <?php if (isset($errors['name'])): ?>
                <p class="error"><?php echo $errors['name']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="text" name="email" placeholder="Введите email" id="email" required>
            <?php if (isset($errors['email'])): ?>
                <p class="error"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="psw">Пароль</label>
            <input type="password" name="psw" placeholder="Введите пароль" id="psw" required>
            <?php if (isset($errors['psw'])): ?>
                <p class="error"><?php echo $errors['psw']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="psw_repeat">Повторите пароль</label>
            <input type="password" name="psw_repeat" placeholder="Повторите пароль" id="psw_repeat" required>
            <?php if (isset($errors['psw_repeat'])): ?>
                <p class="error"><?php echo $errors['psw_repeat']; ?></p>
            <?php endif; ?>
        </div>

        <hr>
        <p>Создавая аккаунт, вы соглашаетесь с нашими <a href="#">Правилами и Политикой конфиденциальности</a>.</p>
        <button type="submit" class="registerbtn">Зарегистрироваться</button>

        <div class="signin">
            <p>Уже есть аккаунт? <a href="#">Войти</a>.</p>
        </div>
    </div>
</form>
</body>
</html>
