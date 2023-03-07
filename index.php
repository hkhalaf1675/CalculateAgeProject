<?php
    $con = new mysqli('localhost','root','','calculateage');
    if($con->connect_error){
        die("connection failed : ".$con->connect_error);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $con->real_escape_string($_POST['username']);
        $dayofbirth = (int)($con->real_escape_string($_POST['dayofbirth']));
        $monthofbirth = (int)($con->real_escape_string($_POST['monthofbirth']));
        $yearofbirth = (int)($con->real_escape_string($_POST['yearofbirth']));

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $res = $con->query($sql);
        if($res->num_rows > 0){
            echo "<script>alert('This is username is already used !');</script>";
        }
        else{
            $datetime = new Datetime();
            $ageday = $datetime->format('d') - $dayofbirth;
            $agemonth = $datetime->format('m') - $monthofbirth;
            $ageyear = $datetime->format('Y') - $yearofbirth;

            if($ageday < 0){
                $agemonth--;
                $ageday = $ageday + 30;
            }
            if($agemonth < 0){
                $ageyear--;
                $agemonth = $agemonth + 12;
            }
            $age = $ageday + ($agemonth * 30) + ($ageyear * 365);
            $sql = "INSERT INTO users(username,dayofbirth,monthofbirth,yearofbirth,age) VALUES('$username',$dayofbirth,$monthofbirth,$yearofbirth,$age)";
            if($con->query($sql) === TRUE){
                header("location:showage.php?username=$username");
            }
            else{
                echo"Error : ".$sql."<br />".$con->error;
            }
        }
        $con->close();
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
        <div class="">
            <h1 class="text-primary-emphasis">Calclute Your Age</h1>
            <h2 class="">Enter Your Birth Day</h2>
            
            <form action="index.php" method="POST" class="row gy-2 gx-3 align-items-center">

                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                    <div class="input-group">
                    <div class="input-group-text">@</div>
                        <input type="text" name="username" class="form-control" id="autoSizingInputGroup" placeholder="Username">
                    </div>
                </div>

                <hr class="border border-primary  border-2 opacity-50">

                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select name="dayofbirth" class="form-select" id="autoSizingSelect">
                        <?php
                            for($i=1; $i<=31; $i++){
                                echo"<option class='' value='".$i."'>".$i."</option>";
                            }
                        ?>
                    </select>
                </div>

                <hr class="border border-primary  border-2 opacity-50">

                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select name="monthofbirth"  class="form-select" id="autoSizingSelect">
                        <option class="" value="1">January</option>
                        <option class="" value="2">February</option>
                        <option class="" value="3">March</option>
                        <option class="" value="4">April</option>
                        <option class="" value="5">May</option>
                        <option class="" value="6">June</option>
                        <option class="" value="7">July</option>
                        <option class="" value="8">August</option>
                        <option class="" value="9">September</option>
                        <option class="" value="10">October</option>
                        <option class="" value="11">November</option>
                        <option class="" value="12">December</option>
                    </select>
                </div>
                
                <hr class="border border-primary  border-2 opacity-50">

                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingInput">Name</label>
                    <input type="text" name="yearofbirth" class="form-control" id="autoSizingInput" placeholder="Enter the Year of Birth ..">
                </div>

                <hr class="border border-primary  border-2 opacity-50">

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Calcuate Age</button>
                </div>
            </form>
        </div>
    </body>
</html>