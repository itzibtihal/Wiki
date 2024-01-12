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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <!-- <link  href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- Swiper.js styles -->
  <!-- <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css"/> -->
  <!-- Custom styles -->
  <link rel="stylesheet" href="/WIKI/public/css/index.css">
  <style>
    :root {
      --bg-clr: #06030a;
      --search-bg-clr: #1e1b20;
      --white: #fff;
      --text-clr: #5e5e5e;
      --btn-hvr-clg: #959595;
    }

    .wrapper {
      display: flex;
      justify-content: center;
      align-items: center;

    }

    .search_box_wrapper .search_box_item {
      position: relative;
      height: 50px;
      margin-bottom: 50px;
      width: 500px;
      max-width: 100%;
    }

    .search_box_wrapper .search_box_item .search_box {
      height: 50px;
    }

    .search_box_wrapper .search_box_item .input_search {
      background: var(--search-bg-clr);
      border: 0;
      border-radius: 25px;
      color: #fff;
      width: 100%;
      height: 100%;
    }

    .search_box_wrapper .search_box_item .icon {
      position: absolute;
      top: 16px;
      color: var(--white);
      font-size: 18px;
      display: flex;
      width: 20px;
    }

    .search_box_wrapper .search_box_item button {
      width: 150px;
      height: 50px;
      position: absolute;
      top: 0;
      border-radius: 25px;
      border: 0;
      display: block;
      background: var(--white);
      cursor: pointer;
      text-transform: uppercase;
      transition: all 0.5s ease;
    }

    .search_box_wrapper .search_box_item button:hover {
      background: var(--btn-hvr-clg);
    }





    .search_box_wrapper .search_box_item.search_box_item_3 .icon {
      left: 20px;
    }







    /*search_box_item_3 and 4*/
    .search_box_wrapper .search_box_item.search_box_item_3 {
      display: flex;
    }

    .search_box_wrapper .search_box_item.search_box_item_3 .search_box {
      width: calc(100% - 135px);
      margin-right: 15px;
    }



    .search_box_wrapper .search_box_item.search_box_item_3 .input_search {
      padding: 15px 20px;
      padding-left: 55px;
    }



    .search_box_wrapper .search_box_item.search_box_item_3 button {
      position: relative;
    }
  </style>
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
  <br><br><br><br><br>
  <!-- barre de recherche -->

  <form id="searchForm" onsubmit="return false;">
    <!-- Your existing form content here -->
    <div class="wrapper">
        <div class="search_box_wrapper">
            <div class="search_box_item search_box_item_3">
                <div class="search_box">
                    <input type="text" id="searchInput" class="input_search form-control" oninput="load_data(this.value)" placeholder="Search for anything you wish for?">
                    <span class="icon">
                        <ion-icon name="search-outline" class="i"></ion-icon>
                    </span>
                </div>
                <button type="submit">Search</button>
            </div>
        </div>
    </div>
</form>





  <!-- list all wikis -->

  <section class="older-posts section">

    <div class="container">
      <!-- data-name="Wiki posts" -->
      <h2 class="title section-title">Wiki posts</h2>
      

      <div class="older-posts-grid-wrapper d-grid" id="searchResultsContainer">



        <?php foreach ($wikis as $index => $wiki) : ?>

          <a href="DetailsWikipage?id=<?= $wiki->getId(); ?>" class="article d-grid" id="data">

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  <script>
    // function load_data(search = '') {
    //   let xhr = new XMLHttpRequest();

    //   xhr.open("GET", "=" + search, true);

    //   xhr.onprogress = function() {
    //     document.getElementById('data').innerHTML = `<div class="spinner-border" role="status">
    //                 <span class="visually-hidden">Loading...</span>
    //         </div>`;
    //   }

    //   xhr.onload = function() {
    //     document.getElementById('data').innerHTML = xhr.responseText;
    //   }

    //   xhr.send();
    // }

    // load_data();
  </script>
 <script>
//     function load_data(search) {
//     // Use AJAX to send a request to the server
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'search-wikis?search=' + encodeURIComponent(search), true);

//     xhr.onprogress = function () {
//         // Display a loading spinner while waiting for the response
//         document.getElementById('searchResultsContainer').innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
//     };

//     xhr.onload = function () {
//         // Update the searchResultsContainer with the received response
//         document.getElementById('searchResultsContainer').innerHTML = xhr.responseText;
//     };

//     // Handle errors
//     xhr.onerror = function () {
//         console.error("Error occurred during the request.");
//     };

//     // Send the request
//     xhr.send();
// }

</script>



</body>

</html>