<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIKI - Post</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon.png">
    <!-- Remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Swiper.js styles -->
    <!-- <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css"/> -->
    <!-- Custom styles -->
    <link rel="stylesheet" href="/WIKI/public/css/index.css">
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


                <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
                    <i class="ri-menu-3-line open-menu-icon"></i>
                    <i class="ri-close-line close-menu-icon"></i>
                </button>


                <a href="auth/Auth.php" class="btn sign-up-btn  screen-sm-hidden">
                    <span>Get Started</span>
                </a>
            </div>

            <!-- Search -->
            <div class="search-form-container container" id="search-form-container">
                <button class="btn form-close-btn place-items-center" id="form-close-btn">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        </nav>

    </header>


   

    <section class="blog-post section-header-offset">
        <div class="blog-post-container container">
            <div class="blog-post-data">
            <h3 class="title blog-post-title"><?php echo $wiki->getTitle(); ?></h3>
            <div class="article-data">
                <span><?php echo $wiki->getCreationDate(); ?></span>
                <span class="article-data-spacer"></span>
                <span><?php echo $wiki->getReadMin(); ?> Min read</span>
                <span class="article-data-spacer"></span>
                <span><?php echo $wiki->getCategoryName(); ?></span>
            </div>
            <img src="/WIKI/public/img/<?php echo $wiki->getPicture(); ?>" alt="">
        </div>

        <div class="container">
            <?php echo $wiki->getContent(); ?>

            <p>
                tags here: <?php echo implode(', ', $wiki->getTags()); ?>
            </p>



                <div class="author d-grid">
                    <div class="author-image-box">
                        <img src="./assets/images/author.jpg" alt="" class="article-image">
                    </div>
                    <div class="author-about">
                        <h3 class="author-name"><?php echo $user->getName(); ?></h3>
                        <p><?php echo $user->getDescription(); ?></p>
                        <ul class="list social-media">
                            <li class="list-item">
                                <a href="<?php echo $user->getInstagramProfile(); ?>" class="list-link"><i class="ri-instagram-line"></i></a>
                            </li>
                            <li class="list-item">
                                <a href="<?php echo $user->getXProfile(); ?>" class="list-link"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="list-item">
                                <a href="<?php echo $user->getLinkedinProfile(); ?>" class="list-link"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

   
    <!-- Footer -->
<footer class="footer section">

<div class="footer-container container d-grid">
    
    <div class="company-data">
        <a href="./index.html">
            <h2 class="logo">WIKI</h2>
        </a>
        <p class="company-description"> enhance engagement by providing regular content, improve SEO, 
            all while establishing interactive communication with the audience.</p>
        
        <ul class="list social-media">
            <li class="list-item">
                <a href="#" class="list-link"><i class="ri-instagram-line"></i></a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link"><i class="ri-facebook-circle-line"></i></a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link"><i class="ri-pinterest-line"></i></a>
            </li>
        </ul>

        <span class="copyright-notice">&copy;2024 WIKI.Ibtihal  All rights reserved.</span>
    </div>

    <div>
        <h6 class="title footer-title">TOP Categories</h6>
        
        <ul class="footer-list list">
            <li class="list-item">
                <a href="#" class="list-link">Travel</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Food</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Technology</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Health</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Fitness</a>
            </li>
        </ul>

    </div>

    <div>
        <h6 class="title footer-title">Useful links</h6>
        
        <ul class="footer-list list">
            <li class="list-item">
                <a href="#" class="list-link">Home</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">wiki Blog</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Tags</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Authors</a>
            </li>
        </ul>

    </div>

    <div>
        <h6 class="title footer-title">Company</h6>
        
        <ul class="footer-list list">
            <li class="list-item">
                <a href="#" class="list-link">Contact us</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">F.A.Q</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Careers</a>
            </li>
            <li class="list-item">
                <a href="#" class="list-link">Admin</a>
            </li>
        </ul>

    </div>

</div>

</footer>


<script src="/WIKI/public/js/index.js"></script>
</body>

</html>