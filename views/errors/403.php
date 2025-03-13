<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_ROOT ?>/css/styles.css">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2021/05/25/02/03/restaurant-6281067_1280.png" type="image/x-icon">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3a506b;
            --secondary-color: #e63946;
            --dark-color: #1d3557;
            --light-color: #f1faee;
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
            font-size: 6rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
            line-height: 1;
        }
        
        .error-message {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .error-details {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }
        
        .user-role {
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-bottom: 2rem;
            display: inline-block;
            border-left: 4px solid var(--secondary-color);
            font-size: 1rem;
        }
        
        .btn-dashboard {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-dashboard:hover {
            background-color: #2d3e50;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(58, 80, 107, 0.4);
        }
        
        .lock-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 2rem;
        }
        
        .lock-body {
            position: absolute;
            width: 100px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 10px;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .lock-hole {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #fff;
            border-radius: 50%;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .lock-arc {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 15px solid var(--primary-color);
            border-bottom: none;
            border-radius: 50px 50px 0 0;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .forbidden-icon {
            position: absolute;
            color: var(--secondary-color);
            font-size: 60px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 5rem;
            }
            
            .error-message {
                font-size: 1.5rem;
            }
            
            .lock-container {
                transform: scale(0.8);
            }
        }
        
        @media (max-width: 576px) {
            .error-code {
                font-size: 4rem;
            }
            
            .error-message {
                font-size: 1.2rem;
            }
            
            .error-details {
                font-size: 1rem;
            }
            
            .lock-container {
                transform: scale(0.7);
            }
        }
        
        /* Animation */
        @keyframes shake {
            0% { transform: translateX(-50%) rotate(0); }
            25% { transform: translateX(-53%) rotate(-5deg); }
            50% { transform: translateX(-50%) rotate(0); }
            75% { transform: translateX(-47%) rotate(5deg); }
            100% { transform: translateX(-50%) rotate(0); }
        }
        
        .shake-animation {
            animation: shake 1.5s ease-in-out infinite;
            transform-origin: bottom center;
        }
        
        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="error-container">
            <h1 class="error-code">403</h1>
            <h2 class="error-message">Access Denied</h2>
            <p class="error-details">You don't have permission to view this page.</p>
            
            <div id="user-role-container" class="user-role">
                <i class="fas fa-user-tag me-2"></i>
                <span id="user-role-text">Logged in as: Staff</span>
            </div>
            
            <div class="lock-container">
                <div class="lock-arc shake-animation"></div>
                <div class="lock-body"></div>
                <div class="lock-hole"></div>
                <i class="fas fa-ban forbidden-icon"></i>
            </div>
            
            <a href="/" class="btn btn-dashboard btn-lg">Return to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to get user role from session (PHP would populate this in reality)
        document.addEventListener('DOMContentLoaded', function() {
            // This would normally be populated by PHP, this is just a simulation
            // In a real implementation, PHP would output the actual user role from the session
            
            // Example of how you would include PHP to dynamically show the user's role:
            /*
            <?php
            if(isset($_SESSION['user_role'])) {
                echo "document.getElementById('user-role-text').innerHTML = 'Logged in as: " . $_SESSION['user_role'] . "';";
            } else {
                echo "document.getElementById('user-role-container').style.display = 'none';";
            }
            ?>
            */
            
            // For demo purposes only:
            console.log('403 Error Page Loaded');
        });
    </script>
</body>
</html>