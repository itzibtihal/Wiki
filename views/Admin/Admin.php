<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/WIKI/public/css/DashAdmin.css" />
    <title>ImmoConnect - Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-house-user me-2"></i>Immo</div>
            <div class="list-group list-group-flush my-3">
                <a href="Dashboard" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                <a href="Categories" class="list-group-item list-group-item-action bg-transparent second-text fw-bold "><i class="fas fa-layer-group me-2"></i>Categories</a>
                <a href="Tags" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-hashtag me-2"></i>Tags</a>
                <a href="Wikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-book me-2 "></i>Verified Wikis</a>
                <a href="ArchivedWikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-trash me-2"></i>Archived Wikis</a>
                <a href="WikiAuthors" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-feather me-2"></i>Wiki's Authors</a>


                <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-map-marker-alt me-2"></i>Outlet</a> -->
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2 text-white"></i>Said Aabilla
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countUsersWithRoleId2(); ?></h3>
                                <p class="fs-5">Authors</p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countAllWikis(); ?></h3>
                                <p class="fs-5">Total Wikis</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countWikisCreatedToday(); ?></h3>
                                <p class="fs-5">Today's Wikis</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countVerifiedWikis(); ?></h3>
                                <p class="fs-5">Verified Wikis</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countArchivedWikis(); ?></h3>
                                <p class="fs-5">Archived Wikis</p>
                            </div>
                            <i class="fas fa-inbox fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countCategories(); ?></h3>
                                <p class="fs-5">Categories</p>
                            </div>
                            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?= $this->countTags(); ?></h3>
                                <p class="fs-5">Tags</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3 text-white">Recent Wikis</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">Id</th>
                                    <th scope="col">Wiki's Tirle</th>
                                    <th scope="col">Date add</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($last6Wikis as $wiki) : ?>
                                    <tr>
                                        <th scope="row"><?= $wiki['id']; ?></th>
                                        <td><?= $wiki['title']; ?></td>
                                        <td><?= $wiki['creation_date']; ?></td>
                                        <td><?= $wiki['category_id']; ?></td> 
                                        <td><?= $wiki['status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>