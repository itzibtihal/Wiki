<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="/WIKI/public/css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script type="module" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.js"></script>


    <title> Wiki - Auth Section</title>
</head>

<body>

    <!-- blue circle background -->
    <div class="d-none d-md-block ball login bg-secondary bg-gradient position-absolute rounded-circle"></div>

    <!-- logo name -->
    <div class="position-absolute top-0 start-0 p-3">
        <span>
            <a href="homepage" class="text-decoration-none fw-bold fs-5 "><ion-icon name="home-outline"></ion-icon> &nbsp;Wiki</a>
        </span>
    </div>

    <!-- Login Section -->
    <div class="container login__form active">
        <div class="row vh-100 w-100 align-self-center">
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder">WELCOME BACK !</h3>
                        <p class="fw-lighter fs-6">Don't have an account, <span id="signUp" role="button" class="text-primary">Sign Up</span></p>
                        <!-- form login section -->
                        <form action="Auth-signin" class="mt-5" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="name@example.com" name="email" id="email">
                                <div id="emailError" class="text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" id="password">
                                    <span class="password__icon text-secondary fs-4 fw-bold bi bi-eye-slash"></span>
                                </div>
                                <div id="passwordError" class="text-danger"></div>
                            </div>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-outline-dark btn-lg rounded-pill mt-4 w-100">Login</button>
                            </div>
                        </form>

                        <p class="mt-5 text-center">Or Sign in with social platforms</p>
                        <div class="row text-center">
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-facebook fs-5"></i></a>
                            </div>
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-linkedin fs-5"></i></a>
                            </div>

                            <div class="col my-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-google fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                <div class="row vh-100 p-5">
                    <div class="col align-self-center p-5 text-center">
                        <img src="/WIKI/public/img/login.png" class="bounce" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Section -->
    <div class="container register__form">
        <div class="row vh-100 w-100 align-self-center">
            <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                <div class="row vh-100 p-5">
                    <div class="col align-self-center p-5 text-center">
                        <img src="/WIKI/public/img/register.png" class="bounce" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder">REGISTER HERE !</h3>
                        <p class="fw-lighter fs-6">Have an account, <span id="signIn" role="button" class="text-primary">Sign In</span></p>

                        <!-- form register section -->
                        <form action="Auth-signup" class="mt-5" method="post" id="registerForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="name" id="name">
                                <div id="nameError" class="text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="name@example.com">
                                <div id="emailError" class="text-danger"></div>

                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" ">
                                    <span class=" password__icon text-secondary fs-4 fw-bold bi bi-eye-slash"></span>
                                </div>
                                <div id="passwordError" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"> Confirm your Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="Confirmpassword" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3">
                                    <span class="password__icon text-secondary fs-4 fw-bold bi bi-eye-slash"></span>
                                </div>
                                <div id="confirmPasswordError" class="text-danger"></div>
                            </div>

                            <div class="col text-center">
                                <button type="submit" class="btn btn-outline-dark btn-lg rounded-pill mt-4 w-100">Sign
                                    Up</button>
                            </div>
                        </form>

                        <p class="mt-5 text-center">Or Sign up with social platforms</p>
                        <div class="row text-center">
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-facebook fs-5"></i></a>
                            </div>
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-linkedin fs-5"></i></a>
                            </div>
                            <div class="col my-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-google fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="/WIKI/public/js/auth.js"></script>
    <Script>
        document.addEventListener("DOMContentLoaded", function() {
            const registerForm = document.getElementById("registerForm");

            registerForm.addEventListener("submit", function(event) {
                const nameInput = document.getElementById("name");
                const nameError = document.getElementById("nameError");

                if (nameInput.value.trim() === "") {
                    nameError.textContent = "Name cannot be empty";
                    event.preventDefault(); // Prevent form submission
                } else {
                    nameError.textContent = ""; // Clear previous error messages
                }
            });
        });
    </Script>


</body>

</html>