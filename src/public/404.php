<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Стиль для всей страницы */
        .page_404 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #fff;
            font-family: 'Arvo', serif;
            text-align: center;
        }

        /* Увеличенный блок с изображением */
        .four_zero_four_bg {
            background-image: url('https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            height: 400px; /* Увеличил высоту */
            width: 100%;
        }

        /* Заголовок 404 */
        .four_zero_four_bg h1 {
            font-size: 80px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Текст ошибки */
        .contant_box_404 h3 {
            font-size: 26px;
            font-weight: bold;
        }

        .contant_box_404 p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Кнопка */
        .link_404 {
            text-decoration: none;
            color: white;
            padding: 12px 25px;
            background: #39ac31;
            font-size: 18px;
            border-radius: 5px;
            display: inline-block;
            transition: 0.3s;
        }

        .link_404:hover {
            background: #2e8b22;
        }
    </style>
</head>
<body>

<section class="page_404">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="four_zero_four_bg">
                    <h1>404</h1>
                </div>
                <div class="contant_box_404">
                    <h3>Look like you're lost</h3>
                    <p>The page you are looking for is not available!</p>
                    <a href="/catalog" class="link_404">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
