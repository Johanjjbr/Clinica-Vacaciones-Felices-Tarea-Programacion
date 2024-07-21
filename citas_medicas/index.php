<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el rol del usuario
$user_role = $_SESSION['role_id'];

// Obtener la próxima cita con detalles
$next_cita = null;
$query = "SELECT c.FECHACITA, c.HORACITA, c.DIAGNOSTICO, p.NOMBRE AS paciente_nombre, m.NOMBRE AS medico_nombre, c.ID AS cita_id
          FROM citas c
          JOIN pacientes p ON c.CODP = p.CODP
          JOIN medicos m ON c.CODM = m.CODM
          ORDER BY c.FECHACITA ASC LIMIT 1";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $next_cita = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Clínica Vacaciones Felices C.A.</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            margin-bottom: 20px;
        }
        .menu {
            margin-bottom: 20px;
        }
        .menu a {
            margin: 0 10px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .menu a:hover {
            color: #45a049;
        }
        .countdown {
            margin-top: 30px;
            font-size: 24px;
            position: relative;
        }
        .countdown div {
            display: inline-block;
            margin: 0 10px;
        }
        .countdown .popup {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        .countdown:hover .popup {
            display: block;
        }
        .countdown .clock-icon {
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenido al Panel de Control</h1>
            <h3>Clínica Vacaciones Felices C.A.</h3>
        </div>
        <div class="menu">
            <?php if ($user_role == 1): // Administrador ?>
                <a href="./usuario/usuarios.php">Gestión de Usuarios</a>
            <?php endif; ?>
            <a href="./medico/view.php">Gestión de Médicos</a>
            <a href="./paciente/view.php">Gestión de Pacientes</a>
            <a href="cita/view.php">Gestión de Citas</a>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
        <div>
            <p>Utilice el menú para navegar a las diferentes secciones del sistema.</p>
        </div>
        <div class="countdown">
            <?php if ($next_cita): ?>
                <h2>Próxima Cita</h2>
                <p><strong>Fecha:</strong> <?php echo date('d-m-Y', strtotime($next_cita['FECHACITA'])); ?></p>
                <p><strong>Hora:</strong> <?php echo date('H:i', strtotime($next_cita['HORACITA'])); ?></p>
                <p><strong>Paciente:</strong> <?php echo $next_cita['paciente_nombre']; ?></p>
                <p><strong>Médico:</strong> <?php echo $next_cita['medico_nombre']; ?></p>
                <p><strong>Diagnóstico:</strong> <?php echo $next_cita['DIAGNOSTICO']; ?></p>
                <a href="cita/edit.php?id=<?php echo $next_cita['cita_id']; ?>">Editar Cita</a>
                <div class="clock-icon">
                    &#128337;
                    <div class="popup" id="popup">
                        <p id="days">00</p> Días,
                        <p id="hours">00</p> Horas,
                        <p id="minutes">00</p> Minutos,
                        <p id="seconds">00</p> Segundos
                    </div>
                </div>
            <?php else: ?>
                <p>No hay citas próximas.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        <?php if ($next_cita): ?>
            var countDownDate = new Date("<?php echo $next_cita['FECHACITA'] . ' ' . $next_cita['HORACITA']; ?>").getTime();
            var x = setInterval(function(){
                var now = new Date().getTime();
                var distance = countDownDate - now; 

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24))/ (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                if(distance < 0){
                    clearInterval(x);
                    document.getElementById("days").innerHTML = "00";
                    document.getElementById("hours").innerHTML = "00";
                    document.getElementById("minutes").innerHTML = "00";
                    document.getElementById("seconds").innerHTML = "00";
                }

            }, 1000);
        <?php endif; ?>
    </script>
</body>
</html>
