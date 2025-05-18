<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
            line-height: 1.6;
            padding-bottom: 3rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header styles */
        .page-header {
            text-align: center;
            padding: 2rem 0;
            position: relative;
            margin-bottom: 3rem;
            background-color: #fff;
            border-radius: 0 0 1rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }

        .title-underline {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 6rem;
            height: 0.25rem;
            background: #2563eb;
            border-radius: 9999px;
        }

        /* Order section styles */
        .order-section {
            margin-bottom: 3.5rem;
            position: relative;
        }

        .order-number {
            position: absolute;
            top: -1.5rem;
            left: 1rem;
            background: #2563eb;
            color: white;
            font-weight: bold;
            padding: 0.25rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            z-index: 10;
        }

        /* Card styles */
        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #e5e7eb;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            position: relative;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background-color: #f1f5f9;
        }

        .card-header-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0.25rem;
            background: #2563eb;
        }

        .card-header-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding-top: 0.5rem;
        }

        .order-id-container {
            display: flex;
            align-items: center;
        }

        .icon-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
        }

        .icon-circle i {
            color: #2563eb;
            font-size: 1rem;
        }

        .order-id {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .order-total {
            background-color: #dbeafe;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
        }

        .order-total-label {
            color: #1e40af;
            margin-right: 0.5rem;
        }

        .order-total-value {
            color: #1e3a8a;
            font-weight: 700;
        }

        /* Card content */
        .card-content {
            padding: 1.5rem;
        }

        .section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #2563eb;
            margin-bottom: 1rem;
            background-color: #f1f5f9;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }

        .section-title i {
            margin-right: 0.5rem;
        }

        .recipient-info {
            background-color: #f8fafc;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            background-color: #fff;
            padding: 0.75rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item i {
            color: #2563eb;
            margin-top: 0.125rem;
        }

        /* Products list */
        .products-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .product-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateX(0.25rem);
            border-color: #bfdbfe;
        }

        .product-content {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        @media (min-width: 640px) {
            .product-content {
                flex-direction: row;
                gap: 1rem;
            }
        }

        .product-image-container {
            position: relative;
            width: 100%;
            height: 8rem;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: #f1f5f9;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 640px) {
            .product-image-container {
                width: 7rem;
                height: 7rem;
                flex-shrink: 0;
            }
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top right, rgba(37, 99, 235, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-image-overlay {
            opacity: 1;
        }

        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-weight: 500;
            font-size: 1.125rem;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .product-card:hover .product-name {
            color: #2563eb;
        }

        .product-description {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 0.5rem;
        }

        .product-price-info {
            font-size: 0.875rem;
            background-color: #f1f5f9;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        .product-total-price {
            font-weight: 500;
            color: #2563eb;
        }

        .product-divider {
            display: flex;
            justify-content: center;
            margin: 0.5rem 0;
        }

        .product-divider-line {
            width: 0.25rem;
            height: 1.5rem;
            background: #bfdbfe;
            border-radius: 9999px;
        }

        /* Card footer */
        .card-footer {
            background: #f1f5f9;
            padding: 1rem;
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #e5e7eb;
        }

        .total-container {
            background-color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #bfdbfe;
        }

        .total-label {
            color: #1e40af;
            margin-right: 0.5rem;
        }

        .total-value {
            color: #1e3a8a;
            font-weight: 700;
        }

        /* Empty state */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 0;
            text-align: center;
        }

        .empty-icon-container {
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            background-color: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .empty-icon-container i {
            font-size: 2.5rem;
            color: #2563eb;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }

        .empty-description {
            font-size: 0.875rem;
            color: #64748b;
            max-width: 20rem;
        }

        /* Order separator */
        .order-separator {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            position: relative;
        }

        .order-separator-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(to right, transparent, #93c5fd, transparent);
        }

        .order-separator-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 2.5rem;
            height: 2.5rem;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.2);
            border: 1px solid #bfdbfe;
        }

        .order-separator-circle i {
            color: #2563eb;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="page-header">
        <h1 class="page-title">Мои заказы</h1>
        <div class="title-underline"></div>
    </header>

    <main id="orders-container">


        <?php foreach ($newUserOrders as $newUserOrder):?>
            <!-- Заказ 1 -->
            <section class="order-section">
                <div class="order-number">Заказ <?php echo $newUserOrder->getId() ?> </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-gradient"></div>
                        <div class="card-header-content">
                            <div class="order-id-container">
                                <div class="icon-circle">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <h2 class="order-id">Заказ</h2>
                            </div>
                            <div class="order-total">
                                <span class="order-total-label">Сумма:</span>
                                <span class="order-total-value"> <?php echo $newUserOrder->getSumAll() ?> ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="section recipient-info">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                Информация о получателе
                            </h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span><?php echo $newUserOrder->getContactName()?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo $newUserOrder->getContactPhone()?></span>
                                </div>
                                <div class="info-item full-width">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo $newUserOrder->getAddress()?></span>
                                </div>
                                <div class="info-item full-width">
                                    <i class="fas fa-comment"></i>
                                    <span><?php echo $newUserOrder->getComment()?></span>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <h3 class="section-title">
                                <i class="fas fa-shopping-bag"></i>
                                Товары в заказе
                            </h3>
                            <div class="products-list">
                                <?php foreach ($newUserOrder->getProductDetails() as $productDetail): ?>
                                    <div class="product-card">
                                        <div class="product-content">
                                            <div class="product-image-container">
                                                <img src="<?php echo $productDetail->getImageUrl() ?>" alt="Смартфон Galaxy S23" class="product-image">
                                                <div class="product-image-overlay"></div>
                                            </div>
                                            <div class="product-details">
                                                <h4 class="product-name"><?php echo $productDetail->getName() ?></h4>
                                                <p class="product-description"><?php echo $productDetail->getDescription() ?></p>
                                                <div class="product-price-row">
                                                    <div class="product-price-info">
                                                        <?php echo $productDetail->getPrice() ?> ₽ × <?php echo $productDetail->getAmount() ?> шт.
                                                    </div>
                                                    <div class="product-total-price">
                                                        <?php echo $productDetail->getProductTotal() ?>  ₽
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-divider">
                                        <div class="product-divider-line"></div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="total-container">
                            <span class="total-label">Итого:</span>
                            <span class="total-value"><?php echo $newUserOrder->getSumALl() ?> ₽</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Разделитель между заказами -->
            <div class="order-separator">
                <div class="order-separator-line"></div>
                <div class="order-separator-circle">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>
        <?php endforeach; ?>

    </main>
</div>

<script>
    // Функция для форматирования цены (оставлена для возможного использования в будущем)
    function formatPrice(price) {
        return new Intl.NumberFormat("ru-RU", {
            style: "currency",
            currency: "RUB",
            minimumFractionDigits: 0,
        }).format(price);
    }
</script>
</body>
</html>
