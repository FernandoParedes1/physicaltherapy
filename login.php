<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Portal AZUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<?php
    require('db_connect.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE emailUser='$username'
                     AND passwordUser='" . $password . "'";
        $result = mysqli_query($conn, $query) 
                or die(mysqli_error($conn));
            $row = mysqli_fetch_array($result);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['roleUser'];
                header("Location: dashboard.php?id=".$row['idUser']);
            } else {
                echo "<div class='form'>
                      <h3>Incorrect Username/password.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                      </div>";
            }

        
    } else {
?>
    <div class="container square-box d-flex justify-content-center align-items-center vh-100">
       
                <h1> Portal AZUR </h1>

                <form class="form m-4" method="post" name="login">
                    <h1 class="login-title">Iniciar Sesión</h1>
                    <div class="mb-2 w-100">
                        <input type="text" class="form-control" name="username" placeholder="Correo" autofocus="true"/>
                    </div>
                    <div class="mb-2 w-100">
                        <input type="password" class="form-control" name="password" placeholder="Password"/>
                    </div>
                    <input type="submit" value="Login"  name="submit" class="btn btn-primary w-100"/>
                </form>
         
        
        
    </div>
<?php
    }
?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>