<?php

require_once 'config.php';

if(isset($_POST["submit"])){
    $petname = mysqli_real_escape_string($conn, $_POST["pet_name"]);
    $petbreed = mysqli_real_escape_string($conn, $_POST["pet_breed"]);
    $petage = mysqli_real_escape_string($conn, $_POST["pet_age"]);
    $petcolor = mysqli_real_escape_string($conn, $_POST["pet_color"]);
    $petprice = mysqli_real_escape_string($conn, $_POST["pet_price"]);
    $petdescription = mysqli_real_escape_string($conn, $_POST["pet_description"]);
    $petcategory = mysqli_real_escape_string($conn, $_POST["pet_category"]);

    // For uploads photos
    $upload_dir = "assets/img/"; // This is where the uploaded photo is stored
    $pet_image = $_FILES["image_name"]["name"];
    $upload_file = $upload_dir . basename($_FILES["image_name"]["name"]);
    $imageType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
    $check = $_FILES["image_name"]["size"];
    $upload_ok = 1;

    // Check if the file already exists
    if(file_exists($upload_file)){
        echo "<script>alert('The file already exists')</script>";
        $upload_ok = 0;
    }

    // Check the file size
    if ($check === false) {
        echo '<script>alert("The photo size is 0, please change the photo ")</script>';
        $upload_ok = 0;
    }

    // Allow only specific image formats
    if($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'gif'){
        echo '<script>alert("Please change the image format (jpg, jpeg, png, gif)")</script>';
        $upload_ok = 0;
    }

    if($upload_ok == 0){
        echo '<script>alert("Sorry, your file was not uploaded. Please try again")</script>';
    } else {
        if(move_uploaded_file($_FILES["image_name"]["tmp_name"], $upload_file)){
            $sql = "INSERT INTO `add_pets`(pet_name, image_name, pet_breed, pet_category, pet_color, pet_age, pet_price, pet_description) 
                    VALUES('$petname', '$upload_file', '$petbreed', '$petcategory', '$petcolor', '$petage', '$petprice', '$petdescription')";
            
            if(mysqli_query($conn, $sql)){
                echo '<script>alert("Pet added successfully!")</script>';
                header('location:ngo-home.php');
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '")</script>';
            }
        } else {
            echo '<script>alert("File upload failed.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>add pets</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" xintegrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
</head>
<body>

     <form action="" method="POST" enctype="multipart/form-data" >
         <div class="form-group border bg-light rounded p-3 m-lg-5">
             <input type="text" class="form-control" name="pet_name" id="pet_name" placeholder="Pet Name" required><br>
             <input type="text" class="form-control" name="pet_breed" id="pet_breed" placeholder="Pet Breed" required><br>
             <input type="text" class="form-control" name="pet_category" id="pet_category" placeholder="Pet Category" required><br>
             <input type="number" class="form-control" name="pet_age" id="pet_age" placeholder="Pet age" required><br>
             <input type="text" class="form-control" name="pet_color" id="pet_color" placeholder="Pet Color" required><br>
             <input type="number" class="form-control" name="pet_price" id="pet_price" placeholder="Pet Price" required><br>
             <input type="text" class="form-control" name="pet_description" id="pet_description" placeholder="Add Pet Description" ><br>
             <input type="file" class="form-control" name="image_name" id="image_name" required ><br>
             <input type="submit" class="form-control btn btn-primary" value="Upload" name="submit">
         </div>
     </form>


     <script>
        var pet_name = document.getElementById("pet_name");
        var pet_breed = document.getElementById("pet_breed");
        var pet_category = document.getElementById("pet_category"); // Added pet_category
        var pet_age = document.getElementById("pet_age");
        var pet_color = document.getElementById("pet_color");
        var pet_price = document.getElementById("pet_price");
        var pet_description = document.getElementById("pet_description");
    </script>
</body>
</html>
