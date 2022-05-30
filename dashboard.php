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
    <?php
        require "db_connect.php";
        $id = $_GET['id'];
    ?>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AZUR</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="dashboard.php?id= <?php echo $_GET['id'] ?>" class="nav-link active">Inicio</a></li>
            <?php
                include "db_connect.php";
                $sql = "SELECT * FROM users WHERE idUser = '$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                
                if ($row['roleUser'] == 'admin') {
                    echo "<li class="."nav-item"."><a href=" . "make_appointment.php?id=". $id ." class="."\"nav-link active\"".">Hacer cita</a></li>";
                }
                if ($row['roleUser'] == 'admin') {
                    echo "<li class="."nav-item"."><a href=" . "register_user.php?id=". $id ." class="."\"nav-link active\"".">Registrar Usuario</a></li>";
                }
            ?>
            <li class="nav-item"><a href="login.php" class="nav-link active">Cerrar Sesión</a></li>
        </ul>
        </div>
            
    </nav>
    <?php
        require "db_connect.php";
        $id = $_GET['id'];
    ?>

    
    <div class="container">
    
        <?php
            $sql = "SELECT * FROM users WHERE idUser = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row['roleUser'] != 'admin') {
                
                echo "<h1>Citas</h1>
                    <table class="."table".">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Doctor</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                <tbody>";

                $sql = "SELECT * FROM appointment WHERE idPatient = '$id'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT * FROM doctor WHERE idDoctor = '$row[idDoctor]'";
                    $result2= mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    echo "<tr>";
                    echo "<td>" . $row['idAppointment'] . "</td>";
                    echo "<td>" . $row2['nameDoctor'] . "</td>";
                    echo "<td>" . $row['dateAppointment'] . "</td>";
                    echo "</tr>";
                }
                    
                echo "</tbody></table>";
            }else{
                echo "<h1>Pacientes</h1>
                    <table class="."table".">
                        <thead>
                            <tr>
                                <th>ID Cita</th>
                                <th>Paciente</th>
                                <th>Fecha y Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>";

                $sql = "SELECT * FROM appointment WHERE idDoctor = '$id'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT * FROM patient WHERE idPatient = '$row[idPatient]'";
                    $result2= mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    echo "<tr>";
                    echo "<td>" . $row['idAppointment'] . "</td>";
                    echo "<td>" . $row2['namePatient'] . "</td>";
                    echo "<td>" . $row['dateAppointment'] . "</td>";
                    echo "<td>
                    <a href=" . "delete_appointment.php?id=" . $row['idAppointment'] . " class="."\"btn btn-danger\"".">Eliminar</a>
                    <a href=" . "edit_appointment.php?id=" . $row['idAppointment'] . "  class="."\"btn btn-dark\"".">Editar</a>
                    </td>";
                    echo "</tr>";
                }
                    
                echo "</tbody></table>";
            }
        ?>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>