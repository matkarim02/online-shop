<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <style>
        body {
            background-color: #A8A8A8;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 800px;
            height: 450px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: inline-flex;
        }

        .backbox {
            background-color: #404040;
            width: 100%;
            height: 80%;
            position: absolute;
            transform: translate(0, -50%);
            top: 50%;
            display: inline-flex;
        }

        .frontbox {
            background-color: white;
            border-radius: 25px;
            height: 100%;
            width: 50%;
            z-index: 10;
            position: absolute;
            right: 0;
            margin-right: 3%;
            margin-left: 3%;
        }

        .loginMsg, .signupMsg {
            width: 50%;
            height: 100%;
            font-size: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .loginMsg .title, .signupMsg .title {
            font-weight: 300;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .loginMsg p, .signupMsg p {
            font-weight: 100;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .textcontent {
            color: white;
            max-width: 80%;
        }

        .loginMsg button, .signupMsg button {
            background-color: #404040;
            border: 2px solid white;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 300;
            padding: 12px 20px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .loginMsg button:hover, .signupMsg button:hover {
            background-color: white;
            color: #404040;
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .login, .signup {
            padding: 40px;
            text-align: center;
        }

        .login h2, .signup h2 {
            color: #35B729;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .inputbox {
            margin-top: 30px;
        }

        .login input, .signup input {
            display: block;
            width: 100%;
            height: 50px;
            background-color: #f2f2f2;
            border: 2px solid transparent;
            margin-bottom: 20px;
            font-size: 16px;
            padding: 0 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .login input:focus, .signup input:focus,
        .login input:hover, .signup input:hover {
            border-color: #35B729;
            box-shadow: 0 0 10px rgba(53, 183, 41, 0.5);
        }

        .login button, .signup button {
            background-color: #35B729;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: 300;
            padding: 12px 20px;
            border-radius: 10px;
            width: 100%;
            height: 50px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login button:hover, .signup button:hover {
            background-color: #28a745;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login p {
            cursor: pointer;
            color: #404040;
            font-size: 15px;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .login p:hover {
            color: #35B729;
            text-decoration: underline;
            font-size: 16px;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="backbox">
        <div class="loginMsg">
            <div class="textcontent">
                <p class="title">Нет аккаунта?</p>
                <p>Зарегистрируйтесь, чтобы сохранить свой прогресс.</p>
                <button onclick="window.location.href='/registration'">Регистрация</button>
            </div>
        </div>
        <div class="signupMsg">
            <div class="textcontent">
                <p class="title">Уже есть аккаунт?</p>
                <p>Войдите, чтобы увидеть свои коллекции.</p>
            </div>
        </div>
    </div>
    <!-- backbox -->
    <div class="frontbox">
        <form class="login" action = '/login' method="POST">
            <h2>Вход</h2>
            <div class="inputbox">
                <input type="text" name="username" placeholder="Email">
                <?php if(isset($errors['username'])): ?>
                    <p style="color: red" class = "errors"> <?php echo $errors['username'] ?> </p>
                <?php endif; ?>
                <input type="password" name="password" placeholder="Пароль">
                <?php if(isset($errors['username'])): ?>
                    <p style="color: red" class = "errors"> <?php echo $errors['username'] ?> </p>
                <?php endif; ?>
                <?php if(isset($errors['password'])): ?>
                    <p style="color: red" class = "errors"> <?php echo $errors['password'] ?> </p>
                <?php endif; ?>
            </div>
            <button>Войти</button>
            <p>Забыли пароль?</p>
        </form>
    </div>
    <!-- frontbox -->
</div>
</body>
</html>

