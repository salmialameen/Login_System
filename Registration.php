<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="icon" href="./img/avatar.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100;1,300&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="w3.css">
    <style>
        input:hover{
            box-shadow: 0 0 5pt 0.5pt #D3D3D3;
        }
        input:focus {
            box-shadow: 0 0 5pt 2pt #D3D3D3;
            outline-width: 0;
        }
        a:hover{
            cursor: pointer;
        }
    </style>
</head>
<body class="w3-light-gray">
<div class="w3-padding-64">
    <div class="w3-row-padding">
        <div class="w3-col s12 m12 l3">&nbsp;</div>
        <div class="w3-col s12 m12 l6">
            <div class="w3-border w3-padding w3-white w3-round-large w3-card-2 w3-margin-top">
                <p class="w3-center w3-large w3-wide w3-text-blue" style="font-style: italic; font-family: Roboto,sans-serif;font-weight: bolder">Register Now</p>
                <p class="w3-center w3-xlarge w3-sofia" style="font-family: 'Tangerine', serif;">Kindly Register Your Account Now</p>

                <form action="Registration.php" method="post">
                    <?php 

                        if(isset($_POST["register"])){
                            $fullname = $_POST["fullname"];
                            $email    = $_POST["email"];
                            $password = $_POST["password"];
                            $confirmPassword = $_POST["confirmPassword"];

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $errors = array();

                            if(empty($fullname) OR empty($email) OR empty($password) OR empty($confirmPassword)){
                                array_push($errors, "All fields are required");
                            }

                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                array_push($errors, "Email is not valid");
                            }

                            if(strlen($password) < 8){
                                array_push($errors, "Password must be at least 8 characters long");
                            }

                            if($password !== $confirmPassword){
                                array_push($errors, "Password doesn't match");
                            }

                            if(count($errors) > 0){
                                foreach($errors as $error){
                                    echo "<div class='w3-container w3-animate-zoom w3-red w3-round-large w3-padding'> $error </div> <br>";
                                }
                            }
                            else{
                                require_once "db_conn.php";

                                $sql = "INSERT INTO users (fullname, email, password),  VALUES (?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                                if($prepareStmt){
                                   mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
                                   mysqli_stmt_execute($stmt);
                                   echo "<div class='w3-container w3-animate-zoom w3-green w3-round-large w3-padding'>Registration Successful </div>";
                                }
                                else{
                                    die("<div class='w3-container w3-animate-zoom w3-red w3-round-large w3-padding'>Something went wrong</div> <br>");
                                }

                                
                            }
                        }
                    ?>



                    <div class="w3-container w3-panel  w3-card-2 w3-padding w3-round-large" style="display: flex; margin: 5px">
                        <span class="material-symbols-sharp w3-text-blue" style="padding-top: 5px; font-size: 35px">account_circle</span>
                        <span style="margin: 5px"></span>
                        <label style="width: 100%">
                            <input class="w3-input w3-animate-input w3-large w3-round-large  w3-border" style="width: 65%" placeholder="Full Name" name="fullname" type="text">

                        </label>
                    </div>
                    <br>

                    <div class="w3-container w3-panel  w3-card-2 w3-padding w3-round-large" style="display: flex; margin: 5px">
                        <span class="material-symbols-sharp w3-text-blue" style="padding-top: 5px; font-size: 35px">mail</span>
                        <span style="margin: 5px"></span>
                        <label style="width: 100%">
                            <input class="w3-input w3-animate-input w3-large w3-round-large  w3-border" style="width: 65%" placeholder="Email" name="email"  type="email">

                        </label>
                    </div>
                    <br>

                    <div class="w3-container w3-panel w3-card-2 w3-padding w3-round-large" style="display: flex; margin: 5px">
                        <span class="material-symbols-sharp w3-text-blue" style="padding-top: 5px; font-size: 35px">password</span>
                        <span style="margin: 5px"></span>
                        <label style="width: 100%;">
                            <input class="w3-input w3-border w3-large w3-round-large w3-animate-input" type="password" placeholder="Password" name="password"  style="width:65%" >
                        </label>
                    </div>
                    <br>

                    <div class="w3-container w3-panel w3-card-2 w3-padding w3-round-large" style="display: flex; margin: 5px">
                        <span class="material-symbols-sharp w3-text-blue" style="padding-top: 5px; font-size: 35px">password</span>
                        <span style="margin: 5px"></span>
                        <label style="width: 100%;">
                            <input class="w3-input w3-border w3-large w3-round-large w3-animate-input" type="password" placeholder="Confirm Password" name="confirmPassword" style="width:65%" >
                        </label>
                    </div>
                    <br>

                    <div class="w3-container">

                        <button name="register" class="w3-btn w3-bar w3-round-large w3-blue w3-large">Register</button>
                        <div class="w3-center w3-medium w3-margin">
                            <p>Have an account! <a href="./login.html" class="w3-text-blue w3-wide" style="text-decoration: none">Login</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>