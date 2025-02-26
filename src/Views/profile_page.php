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
            width: 450px;
            text-align: center;
            overflow: hidden; /* Обрезает контент, если он выходит */
            box-sizing: border-box;
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
            display: block;
            text-align: center;
            text-decoration: none;
            background: #35B729;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            width: calc(100% - 40px); /* Убираем лишние отступы */
            margin: 20px auto 0 auto;
            border: none;
            box-sizing: border-box; /* Учитываем padding в ширине */
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
<div class="profile-container">
    <img src="https://img.freepik.com/free-photo/portrait-white-man-isolated_53876-40306.jpg" alt="Фото профиля" class="profile-img">
    <h2> <?php echo $user['name']; ?> </h2>
    <div class="profile-info">
        <p><strong>Email:</strong> <?php echo $user['email']; ?> </p>
    </div>
    <a href="/editProfile" class="edit-btn">Редактировать профиль</a>
    <a href="/logout" class="edit-btn">Выйти</a>
</div>
</body>
</html>
