<?php

function menu($_opc, $_titulo) {
    if ($_opc == '7') {
        return '<header class="main-header">
                    <nav class="navbar navbar-static-top">
                        <div class="container">
                            <div class="navbar-header">
                                <a href="menu.php" class="navbar-brand"><b>' . $_titulo . '</b></a>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                  <!--  <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registro <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="inscripcion.php" target="_blank">Registrar Inscripción</a></li>
                                            <li><a href="mod_inscripcion.php">Modificar Inscripción</a></li>
                                        </ul>
                                    </li>-->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cierre Cajas <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">                                        
                                          <li><a href="cierre2.php">Cierre de Caja Detallado</a></li>
                                          <li><a href="cierre.php">Cierre de Caja Consolidado</a></li>
                                        </ul>
                                    </li>	
                                    <li><a href="../anular.php">Anular Venta</a></li>
                                    <li><a href="../reimprimir.php">Reimprimir</a></li>                                   
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="bitacora.php">Reporte de Bitácora</a></li>
                                           <!-- <li><a href="asistencia.php">Reporte General de Inscripciones</a></li>
                                            <li><a href="asistenciaTipo.php">Reporte de Inscripciones por Curso</a></li>
                                            <li><a href="cupos.php">Reporte de Cupos</a></li>-->
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mantenimiento <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="montos.php">Gestionar Precios</a></li>
                                            <li><a href="programaciones.php">Gestionar Programaciones</a></li>
                                            <li><a href="usuarios.php">Gestionar Usuarios</a></li>
                                        </ul>
                                    </li>								
                                    <li><a href="index.php">Cerrar Sesión</a></li>
                                </ul>
                            </div>						
                        </div>
                    </nav>
                </header>';
    } else {
        return '<header class="main-header">
                    <nav class="navbar navbar-static-top">
                        <div class="container">
                            <div class="navbar-header">
                                <a href="menu.php" class="navbar-brand"><b>' . $_titulo . '</b></a>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registro <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                    <li><a href="inscripcion.php" target="_blank">Registrar Inscripción</a></li>
                                            </ul>
                                    </li>
                                    <li><a href="cierre.php">Cierre de Caja</a></li>
                                    <li><a href="../reimprime.php" target="_blank">Reimprimir Comprobante</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="bitacora.php">Reporte de Bitácora</a></li>
                                            <li><a href="asistencia.php">Reporte General de Inscripciones</a></li>
                                            <li><a href="asistenciaTipo.php">Reporte de Inscripciones por Curso</a></li>
                                            <li><a href="cupos.php">Reporte de Cupos</a></li>
                                        </ul>
                                    </li>
									<li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mantenimiento <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="montos.php">Gestionar Montos</a></li>
                                            <li><a href="programaciones.php">Gestionar Programaciones</a></li>
                                            <li><a href="usuarios.php">Gestionar Usuarios</a></li>
                                        </ul>
                                    </li>		
                                    <li><a href="index.php">Cerrar Sesión</a></li>
                                </ul>
                            </div>						
                        </div>
                    </nav>
                </header>';
    }
}

?>