<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 550px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
            border-radius: 50%;
            z-index: 0;
            opacity: 0.7;
        }

        .container::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            border-radius: 50%;
            z-index: 0;
            opacity: 0.7;
        }

        h1 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #111827;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            transition: all 0.3s ease;
        }

        input, textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #111827;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
            transform: translateY(-2px);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            padding: 16px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 14px;
            cursor: pointer;
            display: block;
            width: 100%;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            transition: all 0.4s ease;
            z-index: -1;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
        }

        button:hover::before {
            left: 0;
        }

        .required {
            color: #ec4899;
            margin-left: 3px;
        }

        .input-icon {
            position: absolute;
            right: 20px;
            top: 43px;
            color: #8b5cf6;
            transition: all 0.3s ease;
        }

        input:focus + .input-icon,
        textarea:focus + .input-icon {
            transform: scale(1.1);
        }

        .success-message {
            display: none;
            text-align: center;
            color: #047857;
            font-size: 18px;
            margin-top: 20px;
            padding: 20px;
            border-radius: 14px;
            background: rgba(16, 185, 129, 0.1);
            border: 2px dashed #10b981;
            position: relative;
            z-index: 1;
            animation: fadeScale 0.5s ease;
        }

        @keyframes fadeScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .floating-box {
            position: absolute;
            border-radius: 16px;
            z-index: 0;
            opacity: 0.6;
            filter: blur(3px);
            animation: floatAnimation 8s infinite ease-in-out;
        }

        .floating-box:nth-child(1) {
            top: 20%;
            right: 10%;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
            animation-delay: 0s;
        }

        .floating-box:nth-child(2) {
            bottom: 30%;
            left: 15%;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            animation-delay: 2s;
        }

        .floating-box:nth-child(3) {
            top: 70%;
            right: 15%;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            animation-delay: 4s;
        }

        @keyframes floatAnimation {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-15px) rotate(10deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        /* Field animation */
        @keyframes fieldFocus {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .field-animation {
            animation: fieldFocus 0.3s ease;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
                margin: 15px;
            }

            h1 {
                font-size: 24px;
            }

            input, textarea, button {
                padding: 14px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="floating-box"></div>
    <div class="floating-box"></div>
    <div class="floating-box"></div>

    <h1>Оформление заказа</h1>

    <form id="orderForm" action="/create-order" method="POST">
        <div class="form-group">
            <label for="name">Контактное имя <span class="required">*</span></label>
            <?php if(!empty($errors['name'])): ?>
                <p style="color: red" class = "errors"> <?php echo $errors['name'] ?> </p>
            <?php endif; ?>
            <input type="text" id="name" name="name" placeholder="Имя получателя" required>
            <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>

        <div class="form-group">
            <label for="phone">Номер телефона <span class="required">*</span></label>
            <?php if(!empty($errors['phone'])): ?>
                <p style="color: red" class = "errors"> <?php echo $errors['phone'] ?> </p>
            <?php endif; ?>
            <input type="tel" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
            <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
        </div>

        <div class="form-group">
            <label for="address">Адрес доставки <span class="required">*</span></label>
            <?php if(!empty($errors['address'])): ?>
                <p style="color: red" class = "errors"> <?php echo $errors['address'] ?> </p>
            <?php endif; ?>
            <input type="text" id="address" name="address" placeholder="Укажите адрес доставки" required>
            <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <div class="form-group">
            <label for="comments">Комментарии к заказу</label>
            <textarea id="comments" name="comments" placeholder="Расскажите подробнее о вашем заказе..."></textarea>
            <svg class="input-icon" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
        </div>


        <button type="submit">Отправить заказ</button>
    </form>

    <div id="successMessage" class="success-message">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline-block; margin-right: 8px; vertical-align: middle;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Заказ успешно оформлен! Мы скоро с вами свяжемся.
    </div>
</div>

<script>
    // document.getElementById('orderForm').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //
    //     // Здесь будет код для отправки данных формы на сервер
    //     // В данном примере просто показываем сообщение об успешной отправке
    //
    //     document.getElementById('orderForm').style.display = 'none';
    //     document.getElementById('successMessage').style.display = 'block';
    // });

    // Маска для телефона
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value[0] === '7') {
                value = value.substring(0, 11);
                let formattedValue = '+7';
                if (value.length > 1) {
                    formattedValue += ' (' + value.substring(1, 4);
                }
                if (value.length > 4) {
                    formattedValue += ') ' + value.substring(4, 7);
                }
                if (value.length > 7) {
                    formattedValue += '-' + value.substring(7, 9);
                }
                if (value.length > 9) {
                    formattedValue += '-' + value.substring(9, 11);
                }
                e.target.value = formattedValue;
            } else {
                value = value.substring(0, 10);
                let formattedValue = '';
                if (value.length > 0) {
                    formattedValue += '(' + value.substring(0, 3);
                }
                if (value.length > 3) {
                    formattedValue += ') ' + value.substring(3, 6);
                }
                if (value.length > 6) {
                    formattedValue += '-' + value.substring(6, 8);
                }
                if (value.length > 8) {
                    formattedValue += '-' + value.substring(8, 10);
                }
                e.target.value = formattedValue;
            }
        }
    });

    // Анимация фокуса полей
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('field-animation');
            setTimeout(() => {
                this.classList.remove('field-animation');
            }, 300);
        });
    });
</script>
</body>
</html>