<?php
include "db_connect.php";
$id = $_GET['id'];

if(isset($_POST['submit'])){
    $patient = $_POST['patient'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `appointment`( `idDoctor`, `idPatient`, `dateAppointment`) VALUES ('$id','$patient','$date')";

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
                            <label for="firstName">Paciente</label>
                            <select id="patient" class="form-control" name="patient">
                                <?php
                                    include "db_connect.php";
                                    $sql = "SELECT * FROM patient";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['idPatient'] . "'>" . $row['namePatient'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName">Hora</label>
                            <input type="datetime-local" class="form-control" name="date" id="date" required>
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