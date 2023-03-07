<?php
    $username = $_GET['username'];
    $con = new mysqli("localhost","root","","calculateage");
    if($con->connect_error){
        die("connection failed");
    }
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $res=$con->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $dayofbirth = $row['dayofbirth'];
            $monthofbirth = $row['monthofbirth'];
            $yearofbirth = $row['yearofbirth'];
            $age = $row['age'];
        }
    }
    else{
        $dayofbirth = 24;
        $monthofbirth = 9;
        $yearofbirth = 1998;
        $age = 8922;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Calculate Age</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="p-5 bg-dark">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand text-secondary-emphasis" href="index.php">Cal Age</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                
            </div>
        </nav>
        <div class="text-info-emphasis">
            <h1 class="">Calclute Your Age</h1>
            <span class="">username : <?php echo $username; ?></span><br /><br />
            <span class="">Birth day : <?php echo $dayofbirth."/".$monthofbirth."/".$yearofbirth; ?></span><br /><br />
            <sapn class="">Your Age : <?php echo (int)($age/365)." years, ".(int)(($age%365)/30)." months, ".(int)(($age%365)%30)." days";?></span><br /><br />
            <sapn class="">Your Age : <?php echo (int)($age/30)." months, ".(int)($age%30)." days";?></span><br /><br />
            <sapn class="">Your Age : <?php echo $age." days";?></span><br /><br />
        </div>
    </body>
</html>