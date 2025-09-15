<?php

include 'config.php';
$req = "SELECT * FROM add_pets WHERE pet_breed = 'street dog'";
$all_pets = $conn->query($req);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Home</title>
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" xintegrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .welcome-section {
            background-color: #e9ecef;
            padding: 4rem 2rem;
            margin-top: 2rem;
            border-radius: .5rem;
            text-align: center;
        }
        .welcome-section h1 {
            font-weight: 300;
            font-size: 3rem;
            color: #343a40;
        }
        .welcome-section p {
            font-size: 1.25rem;
            color: #6c757d;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="ngo-home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="ngo-add-pets.php">Add Pets</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="ngo-profile.php" method="POST">
            <button class="btn btn-outline my-2 my-sm-0" type="submit">My Profile</button>
            </form>
        </div>
    </nav>

    <!-- ======= Welcome Section ======= -->
    <div class="container welcome-section">
      <h1>Welcome, NGO User!</h1>
      <p>This is your home page. You can add new pets for adoption here.</p>
    </div>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <?php
            while($row = mysqli_fetch_assoc($all_pets)){
            ?>
            <form action="manage-cart.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                    <div class="card mt-5">
                        <div class="card-body text-center">
                            <img src="<?php echo $row["image_name"]; ?>" class="img-fluid equal-img" alt=""><br><br>
                            <p class="pet_name" name="pet_name"><h5><b>Name : <?php echo $row['pet_name'];?></b></h5></p>
                            <p class="pet_breed" name="pet_breed"><h5><b>Breed : <?php echo $row['pet_breed'];  ?></b></h5></p>
                            <p class="pet_color" name="pet_color"><h5><b>Color : <?php echo $row['pet_color'];  ?></b></h5></p>
                            <p class="pet_age" name="pet_age"><h5><b>Age : <?php echo $row['pet_age'];  ?> year</b></h5></p>
                            <p class="pet_price" name="pet_price"><h5><b>Price : <?php echo $row['pet_price'];  ?> rs.</b></h5></p><br>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="image_name" value="<?php echo $row['image_name'] ?>">
                            <input type="hidden" name="petname" value="<?php echo $row['pet_name'] ?>">
                            <input type="hidden" name="petprice" value="<?php echo $row['pet_price'] ?>">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php
            }
            ?>
        </div>
    </section><!-- End Services Section -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
