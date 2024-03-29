<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/index.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon.png">
</head>

<body>
    
<!-- Header -->
<header class="header" id="header">

<nav class="navbar container">
    <a href="./index.html">
        <h2 class="logo">Wiki</h2>
    </a>

    <div class="menu" id="menu">
        <ul class="list">
            <li class="list-item">
                <a href="#" class="list-link current">Home</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Categories</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Trends</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">News</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Contact Us</a>
            </li>
            <li class="list-item screen-lg-hidden">
                <a href="../auth/Auth.php" class="list-link">Login/Register</a>
            </li>
            
        </ul>
    </div>

    <div class="list list-right">
        <button class="btn place-items-center" id="theme-toggle-btn">
            <i class="ri-sun-line sun-icon"></i>
            <i class="ri-moon-line moon-icon"></i>
        </button>

        <button class="btn place-items-center" id="search-icon">
            <i class="ri-search-line"></i>
        </button>

        <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
            <i class="ri-menu-3-line open-menu-icon"></i>
            <i class="ri-close-line close-menu-icon"></i>
        </button>

     
        <a href="#" class="btn sign-up-btn fancy-border screen-sm-hidden">
            <span>Login/Register</span>
        </a>
    </div>

</nav>

</header>
</body>
</html>