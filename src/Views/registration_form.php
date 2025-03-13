<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        :root {
            --primary-color: #4a6fdc;
            --background-color: #f8f9fa;
            --text-color: #333;
            --error-color: #e74c3c;
            --border-color: #ddd;
            --success-color: #2ecc71;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: 40px;
            width: 100%;
            max-width: 480px;
        }

        h1 {
            font-weight: 500;
            margin-bottom: 12px;
            color: var(--text-color);
            font-size: 28px;
        }

        p {
            color: #666;
            margin-bottom: 24px;
            font-size: 15px;
            line-height: 1.5;
        }

        hr {
            border: none;
            height: 1px;
            background-color: var(--border-color);
            margin: 20px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 111, 220, 0.1);
        }

        input::placeholder {
            color: #aaa;
        }

        .error {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 6px;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        a:hover {
            text-decoration: underline;
        }

        .registerbtn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 24px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: var(--transition);
        }

        .registerbtn:hover {
            background-color: #3a5ec4;
            transform: translateY(-1px);
        }

        .signin {
            text-align: center;
            margin-top: 24px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
<form action="/registration" method="POST">
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
            <input type="email" name="email" placeholder="Введите email" id="email" required>
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
            <p>Уже есть аккаунт? <a href="/login">Войти</a>.</p>
        </div>
    </div>
</form>
</body>
</html>