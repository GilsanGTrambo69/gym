<?php
session_start();

if(!isset($_SESSION['documento_usuario'])) {
    header('Location: ../index.php');
    exit();
}
//echo "hola";

$mail = $_SESSION['correo_usuario'];

//echo $mail;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Panel de Administrador - FitLife">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Administrador | FitLife</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/home.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/admin.css" type="text/css">
</head>

<body class="admin-body">
    <!-- Preloader 
    <div id="preloader">
        <div class="loader"></div>
    </div> -->

    <!-- Admin Header -->
    <header class="admin-header">
        <div class="container">
            <div class="admin-header-wrapper">
                <div class="admin-logo">
                    <a href="index.html">
                        <h1>FitLife <span>Admin</span></h1>
                    </a>
                </div>
                
                <div class="admin-nav">
                    <ul>
                        <li><a href="usuarios.php"><i class="fa-solid fa-users"></i> Usuarios</a></li>
                        <li class="active"><a href="horarios.php"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
                        <li><a href="entrenadores.php"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
                        <li><a href="pagos.php"><i class="fa-solid fa-credit-card"></i> Pagos</a></li>
                        <li><a href="notificaciones.php"><i class="fa-solid fa-bell"></i> Notificaciones</a></li>
                    </ul>
                </div>
                
                <div class="admin-user-menu">
                    <div class="admin-notifications">
                        <a href="#" class="notification-icon"><i class="fa-solid fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </a>
                    </div>
                    <div class="admin-user">
                        <img src="../img/admin/admin-avatar.jpg" alt="Admin Avatar">
                        <div class="admin-user-info">
                            <h4>Admin</h4>
                            <span>Administrador</span>
                        </div>
                        <div class="admin-dropdown">
                            <i class="fa-solid fa-chevron-down"></i>
                            <div class="admin-dropdown-menu">
                                <a href="perfil.php"><i class="fa-solid fa-user"></i> Mi Perfil</a>
                                <a href="configuracion.php"><i class="fa-solid fa-gear"></i> Configuración</a>
                                <a href="../index.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="admin-menu-toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Mobile Menu -->
    <div class="admin-mobile-menu">
        <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
        <ul>
            <li><a href="usuarios.html"><i class="fa-solid fa-users"></i> Usuarios</a></li>
            <li class="active"><a href="index.html"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
            <li><a href="entrenadores.html"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
            <li><a href="pagos.html"><i class="fa-solid fa-credit-card"></i> Pagos</a></li>
            <li><a href="notificaciones.html"><i class="fa-solid fa-bell"></i> Notificaciones</a></li>
        </ul>
        <div class="admin-mobile-user">
            <a href="perfil.html"><i class="fa-solid fa-user"></i> Mi Perfil</a>
            <a href="configuracion.html"><i class="fa-solid fa-gear"></i> Configuración</a>
            <a href="../index.html"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </div>
    </div>

    <!-- Admin Content -->
    <div class="admin-content">
        <div class="container">
            <!-- Page Header -->
            <div class="admin-page-header">
                <div class="admin-page-title">
                    <h2>Gestión de Horarios</h2>
                    <p>Administra los horarios de clases del gimnasio</p>
                </div>
                <div class="admin-page-actions">
                    <button class="admin-btn" id="addClassBtn"><i class="fa-solid fa-plus"></i> Añadir Clase</button>
                    <button class="admin-btn secondary"><i class="fa-solid fa-print"></i> Imprimir Horario</button>
                </div>
            </div>
            
            <!-- Schedule Filter -->
            <div class="schedule-filter">
                <div class="filter-group">
                    <label for="weekFilter">Semana:</label>
                    <select id="weekFilter" class="admin-select">
                        <option value="current">Semana Actual</option>
                        <option value="next">Próxima Semana</option>
                        <option value="custom">Personalizado</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="classFilter">Clase:</label>
                    <select id="classFilter" class="admin-select">
                        <option value="all">Todas las Clases</option>
                        <option value="yoga">Yoga</option>
                        <option value="spinning">Spinning</option>
                        <option value="crossfit">CrossFit</option>
                        <option value="boxing">Boxeo</option>
                        <option value="pilates">Pilates</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="trainerFilter">Entrenador:</label>
                    <select id="trainerFilter" class="admin-select">
                        <option value="all">Todos los Entrenadores</option>
                        <option value="1">Sara Jiménez</option>
                        <option value="2">Miguel Moreno</option>
                        <option value="3">Elena Díaz</option>
                        <option value="4">David Ruiz</option>
                    </select>
                </div>
                
                <button class="admin-btn"><i class="fa-solid fa-filter"></i> Filtrar</button>
            </div>
            
            <!-- Schedule Table -->
            <div class="schedule-table-wrapper">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sábado</th>
                            <th>Domingo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="time-cell">06:00 - 07:00</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">07:15 - 08:15</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">08:30 - 09:30</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">09:45 - 10:45</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">11:00 - 12:00</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">16:00 - 17:00</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">17:15 - 18:15</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Yoga</h4>
                                    <p>Sara Jiménez</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">18:30 - 19:30</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Pilates</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>CrossFit</h4>
                                    <p>Miguel Moreno</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">19:45 - 20:45</td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Elena Díaz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell">
                                <div class="class-info">
                                    <h4>Boxeo</h4>
                                    <p>David Ruiz</p>
                                    <div class="class-actions">
                                        <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                            <td class="class-cell empty">
                                <button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Class Modal -->
    <div class="admin-modal" id="addClassModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Añadir Nueva Clase</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <form id="addClassForm">
                    <div class="form-group">
                        <label for="className">Nombre de la Clase</label>
                        <select id="className" class="admin-select" required>
                            <option value="">Seleccionar Clase</option>
                            <option value="yoga">Yoga</option>
                            <option value="pilates">Pilates</option>
                            <option value="spinning">Spinning</option>
                            <option value="crossfit">CrossFit</option>
                            <option value="boxing">Boxeo</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="classTrainer">Entrenador</label>
                        <select id="classTrainer" class="admin-select" required>
                            <option value="">Seleccionar Entrenador</option>
                            <option value="1">Sara Jiménez</option>
                            <option value="2">Miguel Moreno</option>
                            <option value="3">Elena Díaz</option>
                            <option value="4">David Ruiz</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="classDay">Día</label>
                            <select id="classDay" class="admin-select" required>
                                <option value="">Seleccionar Día</option>
                                <option value="monday">Lunes</option>
                                <option value="tuesday">Martes</option>
                                <option value="wednesday">Miércoles</option>
                                <option value="thursday">Jueves</option>
                                <option value="friday">Viernes</option>
                                <option value="saturday">Sábado</option>
                                <option value="sunday">Domingo</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="classTime">Hora</label>
                            <select id="classTime" class="admin-select" required>
                                <option value="">Seleccionar Hora</option>
                                <option value="06:00">06:00 - 07:00</option>
                                <option value="07:15">07:15 - 08:15</option>
                                <option value="08:30">08:30 - 09:30</option>
                                <option value="09:45">09:45 - 10:45</option>
                                <option value="11:00">11:00 - 12:00</option>
                                <option value="16:00">16:00 - 17:00</option>
                                <option value="17:15">17:15 - 18:15</option>
                                <option value="18:30">18:30 - 19:30</option>
                                <option value="19:45">19:45 - 20:45</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="classCapacity">Capacidad</label>
                        <input type="number" id="classCapacity" class="admin-input" min="1" max="50" value="20" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="classNotes">Notas</label>
                        <textarea id="classNotes" class="admin-textarea" rows="3" placeholder="Notas adicionales sobre la clase..."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="admin-btn secondary" id="cancelAddClass">Cancelar</button>
                        <button type="submit" class="admin-btn">Guardar Clase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="admin-modal" id="deleteConfirmModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Confirmar Eliminación</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <p>¿Estás seguro de que deseas eliminar esta clase del horario?</p>
                <p class="delete-class-info">CrossFit - Miguel Moreno (Lunes, 06:00 - 07:00)</p>
                <div class="form-actions">
                    <button type="button" class="admin-btn secondary" id="cancelDelete">Cancelar</button>
                    <button type="button" class="admin-btn danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="../js/admin.js"></script>
</body>

</html>