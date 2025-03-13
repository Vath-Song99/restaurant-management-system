<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --dark-color: #292f36;
            --light-color: #f7f7f7;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        
        .error-container {
            text-align: center;
            max-width: 800px;
            padding: 2rem;
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
            line-height: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .error-message {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }
        
        .error-details {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }
        
        .error-image {
            max-width: 300px;
            margin: 1rem auto 2rem;
        }
        
        .btn-home {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-home:hover {
            background-color: #ff5252;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        
        .plate {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 2rem;
        }
        
        .plate-circle {
            position: absolute;
            border-radius: 50%;
            background-color: white;
            border: 8px solid var(--secondary-color);
            width: 180px;
            height: 180px;
            top: 10px;
            left: 10px;
        }
        
        .fork {
            position: absolute;
            width: 40px;
            height: 120px;
            background-color: #ddd;
            border-radius: 5px;
            top: -60px;
            left: 50px;
            transform: rotate(30deg);
        }
        
        .fork::before {
            content: '';
            position: absolute;
            width: 8px;
            height: 60px;
            background-color: #ddd;
            border-radius: 4px;
            top: -10px;
            left: 5px;
            transform: rotate(-15deg);
        }
        
        .fork::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 60px;
            background-color: #ddd;
            border-radius: 4px;
            top: -10px;
            right: 5px;
            transform: rotate(15deg);
        }
        
        .knife {
            position: absolute;
            width: 30px;
            height: 120px;
            background-color: #ddd;
            border-radius: 5px;
            top: -40px;
            right: 50px;
            transform: rotate(-30deg);
        }
        
        .knife::before {
            content: '';
            position: absolute;
            width: 60px;
            height: 15px;
            background-color: #ddd;
            border-radius: 50%;
            top: -10px;
            right: -15px;
        }
        
        .question-mark {
            position: absolute;
            font-size: 80px;
            color: var(--primary-color);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-message {
                font-size: 1.5rem;
            }
            
            .plate {
                transform: scale(0.8);
            }
        }
        
        @media (max-width: 576px) {
            .error-code {
                font-size: 5rem;
            }
            
            .error-message {
                font-size: 1.2rem;
            }
            
            .error-details {
                font-size: 1rem;
            }
            
            .plate {
                transform: scale(0.7);
            }
        }
        
        /* Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .animated-element {
            animation: float 6s ease-in-out infinite;
        }
        
        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="error-container">
            <h1 class="error-code">404</h1>
            <h2 class="error-message">Oops! Page Not Found</h2>
            <p class="error-details">The dish you ordered seems to be missing from our menu.</p>
            
            <div class="plate animated-element">
                <div class="plate-circle">
                    <div class="question-mark">?</div>
                </div>
                <div class="fork"></div>
                <div class="knife"></div>
            </div>
            
            <a href="/" class="btn btn-home btn-lg">Go Back Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('404 Error Page Loaded');
            // You can add more interactive features here
        });
    </script>
</body>
</html>