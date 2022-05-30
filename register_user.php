<?php
include "db_connect.php";
$id = $_GET['id'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `users`( `emailUser`, `passwordUser`, `roleUser`) VALUES ('$email','$password','$role')";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM users WHERE emailUser = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $userId = $row['idUser'];

    if($role == "admin"){
        $sql = "INSERT INTO `doctor`(`idDoctor`, `nameDoctor`, `phoneDoctor`, `emailDoctor`) VALUES ('$userId','$name','$phone','$email')";
    }else{
        $sql = "INSERT INTO `patient`(`idPatient`, `namePatient`, `phonePatient`, `emailPatient`) VALUES ('$userId','$name','$phone','$email')";
    }
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: dashboard.php?id=$id");
    }else{
        echo "Failed: " . mysqli_error($conn);
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal AZUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container square-box d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="text-center mb-4">
            <h3>Agregar una nueva cita</h3>
            <p class="text-muted">Completa el formulario</p>      
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName">Rol de usuario</label>
                            <select id="role" class="form-control" name="role">
                              <option value="admin">Doctor</option>
                              <option value="patient">Paciente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success w-100 m-2" name="submit">Guardar</button>
                    <a href="dashboard.php?id=<?php echo $_GET['id']?>" class="btn btn-danger w-100 m-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>