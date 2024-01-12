<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/WIKI/public/css/DashAdmin.css" />
    <title>Wiki - Dash</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-house-user me-2"></i>Wiki</div>
            <div class="list-group list-group-flush my-3">
                <a href="Dashboard" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                <a href="Categories" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-layer-group me-2"></i>Categories</a>
                <a href="Tags" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-hashtag me-2"></i>Tags</a>
                <a href="Wikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-book me-2 "></i>Verified Wikis</a>
                <a href="ArchivedWikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-trash me-2"></i>Archived Wikis</a>
                <a href="WikiAuthors" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-feather me-2"></i>Wiki's Authors</a>

                <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-map-marker-alt me-2"></i>Outlet</a> -->
                <a href="logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Authors</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2 text-white"></i><?php echo $existingUser->getName(); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">

                <div class="row my-5">
                    <h3 class="fs-4 mb-3 text-white">All Authors</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover text-center">

                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Author's name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $user->getId(); ?></td>
                                        <td><?= $user->getName(); ?></td>
                                        <td><?= $user->getEmail(); ?></td>
                                        <td>
                                            <?php if ($user->getProfile() !== null) : ?>
                                                <img src="/WIKI/public/img/<?= $user->getProfile(); ?>" alt="Profile Picture" class="img-thumbnail" width="50">
                                            <?php else : ?>
                                                The author didn't upload a picture.
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($user->getDescription() !== null) : ?>
                                                <?= $user->getDescription(); ?>
                                            <?php else : ?>
                                                No description available.
                                            <?php endif; ?>
                                        </td>
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