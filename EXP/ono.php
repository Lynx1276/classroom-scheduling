<?php

if(isset($_POST['SUBMIT'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $_POST['uname'] = $uname; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen Animation</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: white;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            flex-direction: column;
        }

        /* Splash Screen */
        #splashScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #121212;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 1s ease;
            z-index: 1000;
        }

        #logo {
            width: 200px;
            transition: transform 1.5s ease-in-out;
        }

        /* Form Container */
        #formContainer {
            display: none;
            position: relative;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 1s ease, transform 1s ease;
            text-align: center;
        }

        #formContainer.show {
            display: block;
            opacity: 1;
            transform: translateY(10px);
        }

        /* Logo Above Form */
        #logoMinimized {
            width: 80px;
            margin-bottom: 10px;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            padding: 10px;
            margin: 5px;
            width: 200px;
            border: 1px solid #555;
            background-color: #333;
            color: white;
            border-radius: 4px;
        }

        /* Buttons in a Row */
        .button-container {
            display: flex;
            justify-content: space-between;
            width: 220px;
            margin-top: 10px;
        }

        button {
            padding: 10px;
            width: 100px; /* Set equal width */
            border: 1px solid #555;
            background-color: #333;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>

    <!-- Splash Screen -->
    <div id="splashScreen">
        <img src="prmsu.png" alt="Logo" id="logo">
    </div>

    <!-- Form with Logo Above -->
    <div id="formContainer">
        <img src="prmsu.png" alt="Logo" id="logoMinimized">
        <form method="POST" action="EXE.php">
            <input type="text" name="uname" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>

            <!-- Buttons Side by Side -->
            <div class="button-container">
                <button type="submit" name="SUBMIT">Login</button>
                <button type="button" onclick="window.location.href='register.html'">Register</button>
            </div>
        </form>
    </div>

    <script>
        window.onload = () => {
            setTimeout(() => {
                const splashScreen = document.getElementById('splashScreen');
                const logo = document.getElementById('logo');
                const formContainer = document.getElementById('formContainer');
                const minimizedLogo = document.getElementById('logoMinimized');

                // Shrink logo and move it upwards before fading in the form
                logo.style.transform = 'scale(0.4) translateY(-100px)';
                
                setTimeout(() => {
                    // Hide splash screen smoothly
                    splashScreen.style.opacity = '0';
                    
                    setTimeout(() => {
                        splashScreen.style.display = 'none';
                        
                        // Show form and minimized logo
                        minimizedLogo.style.opacity = '1';
                        formContainer.classList.add('show');
                    }, 500); // After splash fades
                }, 1000); // Let the logo animation play first
            }, 2000); // Initial splash delay
        };
    </script>
</body>
</html>
