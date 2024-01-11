<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/WIKI/public/css/DashAdmin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Wiki - My Dashboard</title>
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8;
        }

        .profile-button {
            background: #b6b6b7;
            box-shadow: none;
            border: none;
        }

        .profile-button:hover {
            background: #98989a;
        }

        .profile-button:focus {
            background: #b6b6b7;
            box-shadow: none;
        }

        .profile-button:active {
            background: #b6b6b7;
            box-shadow: none;
        }

        .back:hover {
            color: #682773;
            cursor: pointer;
        }

        .card {
            width: 100%;
            border: none;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card label {
            margin-top: 30px;
            text-align: center;
            height: 40px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card input {
            display: none;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-house-user me-2"></i>Wiki</div>
            <div class="list-group list-group-flush my-3">
                <a href="Dashboard" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                <a href="Wikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-book me-2 "></i>Add New Wikis</a>
                <a href="ArchivedWikis" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-trash me-2"></i>My Wikis Cards</a>
                <a href="WikiAuthors" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-feather me-2"></i>Author Profile</a>


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
                    <h2 class="fs-2 m-0 text-white">My Profile</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2 text-white"></i>Ibtihal Boukhanchouch
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

            <div class="container rounded bg-white mt-5">
                <form action="UpdateProfil" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5 card">
                                <img class="rounded-circle mt-5" src="/WIKI/public/img/<?php echo $existingUser->getProfile(); ?>" width="90" id="image" >
                                <label for="input-file">Choose A new Picture</label>
                                <input type="file" accept="image/jpg , image/png , image/jpeg" id="input-file" name="profile" required>
                                <span class="font-weight-bold"><?php echo $existingUser->getName(); ?></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-row align-items-center back"><i class="fas fa-backward mr-1 mb-1"></i> &nbsp
                                        <h6>Back to home</h6>
                                    </div>
                                    <h6 class="text-right">Edit Profile</h6>
                                </div>
                                <div class="row mt-2">
                                    <label for="">Name:</label>
                                    <div class="col-md-6"><input type="text" class="form-control" name="name" placeholder="first name" value="<?php echo $existingUser->getName(); ?>"></div>
                                    <label for="">Email:</label>
                                    <div class="col-md-6"><input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $existingUser->getEmail(); ?>"></div>

                                </div>
                                <div class="row mt-3">
                                    <label for="">Description:</label>

                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="your description" value="<?php echo $existingUser->getName(); ?>"></textarea>
                                </div>
                                <div class="row mt-3">
                                    <label for="">Socials:</label>
                                    <div class="col-md-6"><input type="text" name="linkedinProfile" class="form-control" placeholder="Linkedin link" value="<?php echo $existingUser->getLinkedinProfile(); ?>"></div>
                                    <div class="col-md-6"><input type="text" name="instagramProfile"  class="form-control" placeholder="Instagram link" value="<?php echo $existingUser->getInstagramProfile(); ?>"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><input type="text" name="xProfile"  class="form-control" placeholder=" X profile" value="<?php echo $existingUser->getXProfile(); ?>"></div>
                                </div>
                                <div class="mt-5 text-right"><button type="submit"  name="submit" class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
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

        let image = document.getElementById("image");
        let input = document.getElementById("input-file");

        input.onchange = () => {
            image.src = URL.createObjectURL(input.files[0]);
        }
    </script>
</body>

</html>