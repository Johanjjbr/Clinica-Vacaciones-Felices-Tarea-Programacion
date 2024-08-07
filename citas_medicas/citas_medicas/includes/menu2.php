<div class="sidebar">
        <div class="header">
            <h3>Clínica Vacaciones Felices C.A.</h3>
        </div>

        <div id="accordian">
            <ul>
                <li>
                    <h3><span class="icon-dashboard"></span>Inicio</h3>
                    <ul>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Search</a></li>
                        <li><a href="#">Graphs</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </li>
                <!-- we will keep this LI open by default -->
                <li class="active">
                    <h3><span class="icon-tasks"></span>Citas</h3>
                    <ul>
                        <li><a href="../cita/view.php">Ver citas</a></li>
                        <li><a href="../cita/add.php">Agregar citas</a></li>
                    </ul>
                </li>

                <li class="active">
                    <h3><span class="icon-tasks"></span>Médicos</h3>
                    <ul>
                        <li><a href="../medico/view.php">Gestionar Médicos</a></li>
                    </ul>
                </li>

                <li class="active">
                    <h3><span class="icon-tasks"></span>Pacientes</h3>
                    <ul>
                        <li><a href="../paciente/view.php">Gestionar Pacientes</a></li>
                    </ul>
                </li>
                <li>
                    <h3><span class="icon-calendar"></span>Calendar</h3>
                    <ul>
                        <li><a href="#">Current Month</a></li>
                        <li><a href="#">Current Week</a></li>
                        <li><a href="#">Previous Month</a></li>
                        <li><a href="#">Previous Week</a></li>
                        <li><a href="#">Next Month</a></li>
                        <li><a href="#">Next Week</a></li>
                        <li><a href="#">Team Calendar</a></li>
                        <li><a href="#">Private Calendar</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </li>

                <?php if ($user_role == 1): // Administrador ?>
                    <li class="active">
                        <h3><span class="icon-tasks"></span>Usuarios</h3>
                        <ul>
                            <li><a href="../usuario/usuarios.php">Gestionar Usuarios</a></li>
                        </ul>
                    </li>            
                <?php endif; ?>
                <li>
                    <h3><span class="icon-heart"></span>Sesión</h3>
                    <ul>
                        <li><a href=".../logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- jQuery -->
        <script>
            $(document).ready(function(){
                $("#accordian h3").click(function(){
                    //slide up all the link lists
                    $("#accordian ul ul").slideUp();
                    //slide down the link list below the h3 clicked - only if its closed
                    if(!$(this).next().is(":visible"))
                    {
                        $(this).next().slideDown();
                    }
                });
            });
        </script>
    </div>

