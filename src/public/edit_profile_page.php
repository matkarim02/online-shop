<?php

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->query("SELECT * FROM users WHERE id = $userId");
    $user = $stmt->fetch();
} else {
    header("Location: /login_form.php");
}


?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #e3f9e5, #c1e1c5);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 400px;
            text-align: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #35B729;
        }

        h2 {
            color: #2c3e50;
            font-size: 26px;
            margin: 15px 0;
        }

        .profile-info {
            text-align: left;
            margin-top: 20px;
        }

        .profile-info p {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .edit-btn {
            background: #35B729;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .edit-btn:hover {
            background: #2a8c20;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<form class="profile-container" action="edit_profile_handle.php" method="POST">
    <img src="https://img.freepik.com/free-photo/portrait-white-man-isolated_53876-40306.jpg" alt="Фото профиля" class="profile-img">

    <div class="profile-info">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" value="<?php echo ($user['name']); ?>" >
        <?php if(isset($errors['name'])): ?>
            <p style="color: red" class = "errors"> <?php echo $errors['name'] ?> </p>
        <?php endif; ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo ($user['email']); ?>" >
        <?php if(isset($errors['email'])): ?>
            <p style="color: red" class = "errors"> <?php echo $errors['email'] ?> </p>
        <?php endif; ?>

        <label for="password">Новый пароль (необязательно):</label>
        <input type="password" id="password" name="password" placeholder="Введите новый пароль">
        <?php if(isset($errors['password'])): ?>
            <p style="color: red" class = "errors"> <?php echo $errors['password'] ?> </p>
        <?php endif; ?>

        <label for="password">Повторите новый пароль (необязательно):</label>
        <input type="password" id="password_rpt" name="password_rpt" placeholder="Введите новый пароль">
        <?php if(isset($errors['password_rpt'])): ?>
            <p style="color: red" class = "errors"> <?php echo $errors['password_rpt'] ?> </p>
        <?php endif; ?>
    </div>
    <button class="edit-btn">Сохранить изменения</button>
</form>
</body>
</html>

