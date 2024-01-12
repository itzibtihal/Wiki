<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/WIKI/public/css/DashAdmin.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <Style>
        .button-container {
            text-align: center;
        }

        .card {
            width: 100%;
            border: none;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card img {
            width: 200px;

            object-fit: cover;
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
    </Style>
    <title>Wiki - My Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-house-user me-2"></i>Wiki</div>
            <div class="list-group list-group-flush my-3">
                <a href="MyDash" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                <a href="MyDashCreateWiki" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-book me-2 "></i>Add New Wikis</a>

                <a href="MyProfile" class="list-group-item list-group-item-action bg-transparent second-text "><i class="fas fa-feather me-2"></i>Author Profile</a>


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
                    <h2 class="fs-2 m-0 text-white">Add New Wiki!</h2>
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
                                <li><a class="dropdown-item" href="MyProfile">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


            <div class="container mt-5">
                <h2>Create a Wiki</h2>
                <form action="MyDashCreateWiki" method="post" enctype="multipart/form-data">

                    <div class="card">
                        <img src="/WIKI/public/img/category.jpg" alt="image" id="image">
                        <label for="input-file">Choose Picture</label>
                        <input type="file" accept="image/jpg, image/png, image/jpeg" id="input-file" name="picture" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <form action="" method="post">

                        <label for="content">After you Finish Enter Tool and Copy the Source Code</label>
                        <textarea name="textarea" id="default"></textarea>

                    </form>

                    <div class="form-group">
                        <label for="content"> Past the code of the Content here </label>
                        <textarea class="form-control" name="content" id="content" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control" id="tags" name="tags[]" multiple required>
                            <?php
                            foreach ($tags as $tag) {
                                echo "<option value='" . htmlspecialchars($tag->getName()) . "'>" . htmlspecialchars($tag->getName()) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categoryId">Category</label>
                        <select class="form-control" id="categoryId" name="categoryId" required>
                            <?php
                            foreach ($categories as $category) {
                                echo "<option value='" . htmlspecialchars($category->getId()) . "'>" . htmlspecialchars($category->getName()) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="readMin">Read Time (minutes)</label>
                        <input type="number" class="form-control" id="readMin" name="readMin" required>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Create Wiki</button>
                    <br>
                </form>

            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.tiny.cloud/1/qsvz06g2f1i1irwo0414xeap7cvkeow8gs3rykio9igphxw3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
            <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

            <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
            <script>
                tinymce.init({
                    selector: 'textarea#default',
                    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [{
                            value: 'First.Name',
                            title: 'First Name'
                        },
                        {
                            value: 'Email',
                            title: 'Email'
                        },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                });
            </script>
            <script>
                new MultiSelectTag('tags');
            </script>



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
        };
    </script>
</body>

</html>