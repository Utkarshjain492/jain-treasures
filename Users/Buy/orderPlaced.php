<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Animation</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .order-container {
            display: none;
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        .order-message h1 {
            margin: 0;
            font-size: 2em;
            color: #4CAF50;
        }

        .order-message p {
            font-size: 1.2em;
            color: #555;
        }

        .tick-container {
            display: none;
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFD700, #FFEA00);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            opacity: 0;
        }

        .tick {
            font-size: 2em;
            color: #4CAF50;
            animation: tickAnimation 2s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes borderAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes tickAnimation {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.5) rotate(15deg);
                opacity: 1;
            }
            100% {
                transform: scale(1) rotate(0deg);
            }
        }

        @keyframes circleAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="order-container">
        <div class="order-message">
            <h1>Order Placed!</h1>
            <p>Your order has been placed successfully.</p>
            <div class="tick-container">
                <div class="tick">✔️</div>
            </div>
        </div>
    </div>

    <script>
        function showOrderConfirmation() {
            const orderContainer = document.querySelector('.order-container');
            const tickContainer = document.querySelector('.tick-container');
            const tick = document.querySelector('.tick');
            orderContainer.style.display = 'block';
            orderContainer.classList.add('animate');

            setTimeout(() => {
                tickContainer.style.display = 'flex';
                tickContainer.style.opacity = '1';
                tick.classList.add('animate');
                tickContainer.style.animation = 'circleAnimation 1s ease forwards';
            }, 500);

        }

        document.addEventListener('DOMContentLoaded', () => {
            showOrderConfirmation();
        });
    </script>
</body>
</html>