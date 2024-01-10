<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            border-radius: 50%;
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
    <title> WIKIDash - Update Category</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: gray;">
        Categories
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Update Category</h3>
            <p class="text-muted">Complete the form below to Update your Category</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="UpdateCategory" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
               
                <input type="hidden" name="category_id" value="<?php echo $existingCategory->getId(); ?>">

                <div class="card">
                    <img src="/WIKI/public/img/<?php echo $existingCategory->getPicture(); ?>" alt="image" id="image">
                    <label for="input-file">update Picture</label>
                    <input type="file" accept="image/jpg , image/png , image/jpeg" id="input-file" name="picture"  >
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Update Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $existingCategory->getName(); ?>" required>
                    </div>
                </div>




                <div class="button-container">

                    <br>
                    <button type="submit" class="btn btn-success" name="submit" style="background-color: #959c9e; border: 2px solid black">Save</button>
                    <a href="Categories" class="btn btn-danger" style="background-color: #959c9e;  border: 2px solid black"">Cancel</a>
                </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
                        <script>
                            let image = document.getElementById("image");
                            let input = document.getElementById("input-file");

                            input.onchange = () => {
                                image.src = URL.createObjectURL(input.files[0]);
                            }
                        </script>
</body>

</html>