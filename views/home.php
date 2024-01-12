<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Wiki - Home </title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="/WIKI/public/css/index.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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



    <!-- Featured articles -->
    <section class="featured-articles section section-header-offset">

        <div class="featured-articles-container container d-grid">

            <div class="featured-content d-grid">

                <div class="headline-banner">
                    <h3 class="headline fancy-border">
                        <span class="place-items-center">News flash</span>
                    </h3>
                    <span class="headline-description"> <?php echo $lastInsertedWikiTitle; ?> </span>
                </div>


                <a href="DetailsWikipage?id=<?= $lastWiki7->getId(); ?>" class="article featured-article featured-article-1">
                    <img src="/WIKI/public/img/R.jpg" alt="" class="article-image" width="100PX" height="70px">
                    <span class="article-category">Technologies</span>

                    <div class="article-data-container">

                        <div class="article-data">
                            <span><?php echo $lastWiki7->getCreationDate(); ?></span>
                            <span class="article-data-spacer"></span>
                            <span> <?php echo $lastWiki7->getReadMin(); ?> Min read</span>
                        </div>

                        <h3 class="title article-title"><?php echo $lastWiki7->getTitle(); ?></h3>

                    </div>
                </a>



                <a href="DetailsWikipage?id=<?= $lastWiki6->getId(); ?>" class="article featured-article featured-article-2">
                    <img src="/WIKI/public/img/sportt.jpg" alt="" class="article-image">
                    <span class="article-category">Sport</span>

                    <div class="article-data-container">

                        <div class="article-data">
                            <span><?php echo $lastWiki6->getCreationDate(); ?></span>
                            <span class="article-data-spacer"></span>
                            <span><?php echo $lastWiki6->getReadMin(); ?> Min read</span>
                        </div>

                        <h3 class="title article-title"><?php echo $lastWiki6->getTitle(); ?></h3>

                    </div>
                </a>

                <a href="DetailsWikipage?id=<?= $lastWiki->getId(); ?>DetailsWikipage" class="article featured-article featured-article-3">
                    <img src="/WIKI/public/img/food.jpg" alt="" class="article-image">
                    <span class="article-category">Food</span>

                    <div class="article-data-container">

                        <div class="article-data">
                            <span><?php echo $lastWiki->getCreationDate(); ?></span>
                            <span class="article-data-spacer"></span>
                            <span><?php echo $lastWiki->getReadMin(); ?> Min read</span>
                        </div>

                        <h3 class="title article-title"><?php echo $lastWiki->getTitle(); ?></h3>

                    </div>
                </a>

            </div>

            <div class="sidebar d-grid">

                <h3 class="title featured-content-title">Trending news</h3>

                <?php foreach ($lastFiveWikis as $index => $wiki) : ?>
                    <input type="hidden" name="Wiki_id" value="<?= $wiki->getId(); ?>">
                    <a href="DetailsWikipage?id=<?= $wiki->getId(); ?>" class="trending-news-box">
                        <div class="trending-news-img-box">
                            <span class="trending-number place-items-center"><?php echo $index + 1; ?></span>
                            <!-- You may need to adjust the image source based on your data -->
                            <img src="/WIKI/public/img/<?php echo $wiki->getPicture(); ?>" alt="" class="article-image">
                        </div>

                        <div class="trending-news-data">
                            <div class="article-data">
                                <span><?php echo $wiki->getCreationDate(); ?></span>
                                <span class="article-data-spacer"></span>
                                <span><?php echo $wiki->getReadMin(); ?> Min read</span>
                            </div>

                            <h3 class="title article-title"><?php echo $wiki->getTitle(); ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>







            </div>

        </div>

    </section>

    <!-- Wiki posts -->
    <section class="older-posts section">

        <div class="container">
            <!-- data-name="Wiki posts" -->
            <h2 class="title section-title">Wiki posts</h2>

            <div class="older-posts-grid-wrapper d-grid">



                <?php foreach ($lastSixWikis as $index => $wiki) : ?>

                    <a href="DetailsWikipage?id=<?= $wiki->getId(); ?>" class="article d-grid">

                    <input type="hidden" name="Wiki_id" value="<?= $wiki->getId(); ?>">

                        <div class="older-posts-article-image-wrapper">
                            <img src="/WIKI/public/img/<?php echo $wiki->getPicture(); ?>" alt="" class="article-image">
                        </div>

                        <div class="article-data-container">

                            <div class="article-data">
                                <span><?php echo $wiki->getCreationDate(); ?></span>
                                <span class="article-data-spacer"></span>
                                <span><?php echo $wiki->getReadMin(); ?> Min read</span>
                            </div>

                            <h3 class="title article-title"><?php echo $wiki->getTitle(); ?></h3>
                            <p class="article-description"><?php echo implode(' ', array_slice(explode(' ', $wiki->getContent()), 0, 20)); ?></p>

                        </div>
                    </a>
                <?php endforeach; ?>



            </div>

            <div class="see-more-container">
                <a href="AllWikiSwiki" class="btn see-more-btn place-items-center">See more <i class="ri-arrow-right-s-line"></i></i></a>
            </div>

        </div>

    </section>


    <!-- popular Cartegories -->
    <section class="popular-tags section">

        <div class="container">

            <!-- data-name="Popular Categories" -->
            <h2 class="title section-title">Popular Categories</h2>

            <div class="popular-tags-container d-grid">




                <?php foreach ($lastSixCategories as $category) : ?>
                    <a href="#" class="article">
                        <span class="tag-name"><?= $category->getName(); ?></span>
                        <img src="/WIKI/public/img/<?= $category->getPicture(); ?>" alt="" class="article-image">
                    </a>
                <?php endforeach; ?>

            </div>

        </div>
    </section>

    <!-- Popular tags -->
    <section class="popular-tags section">

        <div class="container">

            <!-- data-name="Popular tags" -->
            <h2 class="title section-title">Popular tags</h2>

            <div class="popular-tags-container d-grid">

                <?php foreach ($lastSixTags as $tag) {
                    echo '<a href="#" class="article">';
                    echo '<span class="tag-name">' . htmlspecialchars($tag->getLabel()) . '</span>';
                    echo '<img src="/WIKI/public/img/hashtag.jpg" alt="" class="article-image">';
                    echo '</a>';
                }
                ?>



            </div>

        </div>
    </section>








    <!-- Newsletter -->
    <section class="newsletter section">

        <div class="container">

            <!-- data-name="Newsletter" -->
            <h2 class="title section-title">Newsletter</h2>

            <div class="form-container-inner">
                <h6 class="title newsletter-title">Subscribe to WIKI ' s</h6>
                <p class="newsletter-description">Stay connected with our newsletter to uncover the latest updates,
                    exclusive tips, and exciting opportunities delivered straight to your inbox.</p>

                <form action="" class="form">
                    <input class="form-input" type="text" placeholder="Enter your email address ...">
                    <button class="btn form-btn" type="submit">
                        <i class="ri-mail-send-line"></i>
                    </button>
                </form>

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

                <span class="copyright-notice">&copy;2024 WIKI.Ibtihal All rights reserved.</span>
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