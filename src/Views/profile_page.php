<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #333;
            --accent-color: #4a6fff;
            --bg-color: #f9f9f9;
            --card-color: #ffffff;
            --text-color: #333;
            --border-radius: 12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--text-color);
        }

        .profile-container {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px;
            width: 380px;
            text-align: center;
            box-sizing: border-box;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-color);
            font-size: 22px;
            font-weight: 600;
            margin: 20px 0 5px;
            letter-spacing: -0.5px;
        }

        .profile-info {
            text-align: left;
            margin: 30px 0;
        }

        .info-item {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 14px;
            color: #888;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .btn {
            display: block;
            text-decoration: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 12px;
        }

        .primary-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
        }

        .primary-btn:hover {
            background-color: #3a5be0;
            transform: translateY(-2px);
        }

        .secondary-btn {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid #eaeaea;
        }

        .secondary-btn:hover {
            background-color: #f5f5f5;
            border-color: #ddd;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <img src="https://img.freepik.com/free-photo/portrait-white-man-isolated_53876-40306.jpg" alt="Фото профиля" class="profile-img">
    <h2><?php echo $user->getName(); ?></h2>

    <div class="profile-info">
        <div class="info-item">
            <div class="info-label">Email</div>
            <div class="info-value"><?php echo $user->getEmail() ?></div>
        </div>
        <div class="info-item">
            <div class="info-label">Статус</div>
            <div class="info-value">Активный</div>
        </div>
    </div>

    <a href="/editProfile" class="btn primary-btn">Редактировать профиль</a>
    <a href="/logout" class="btn secondary-btn">Выйти</a>
</div>
</body>
</html>