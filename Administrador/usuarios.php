<?php
session_start();

if(!isset($_SESSION['documento_usuario'])) {
    header('Location: ../index.php');
    exit();
}

include '../assets/conexion.php';

$rows = 0;
$limit = 10; // Número de resultados por página


$records = $conexion->query("SELECT * FROM usuarios WHERE id_rol_usuario = 1");

$nr_of_rows = $records->num_rows;

$pages = ceil($nr_of_rows / $limit);

if(isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'];

    $start = $page * $limit;
} 


$query = "
    SELECT u.documento_usuario, u.documento_usuario, u.nombre_usuario, u.apellido_usuario,
           u.correo_usuario, u.telefono_usuario,
           m.estado_pago, m.fecha_proximo_pago, m.tipo_pago
    FROM usuarios u
    LEFT JOIN mensualidad m ON u.documento_usuario = m.id_usuario_pago
    WHERE u.id_rol_usuario = 1 limit $rows, $limit
";

$result = mysqli_query($conexion, $query);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Panel de Administrador - FitLife">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Usuarios | FitLife Admin</title>

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
                        <li class="active"><a href="usuarios.php"><i class="fa-solid fa-users"></i> Usuarios</a></li>
                        <li><a href="horarios.php"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
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
                                <a href="perfil.html"><i class="fa-solid fa-user"></i> Mi Perfil</a>
                                <a href="configuracion.html"><i class="fa-solid fa-gear"></i> Configuración</a>
                                <a href="../index.html"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
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
            <li class="active"><a href="usuarios.html"><i class="fa-solid fa-users"></i> Usuarios</a></li>
            <li><a href="index.html"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
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
                    <h2>Gestión de Usuarios</h2>
                    <p>Administra los usuarios registrados en el gimnasio</p>
                </div>
                <div class="admin-page-actions">
                    <button class="admin-btn" id="addUserBtn"><i class="fa-solid fa-user-plus"></i> Nuevo Usuario</button>
                    <button class="admin-btn secondary"><i class="fa-solid fa-file-export"></i> Exportar</button>
                </div>
            </div>
            
            <!-- Users Filter -->
            <div class="users-filter">
                <div class="filter-group">
                    <label for="statusFilter">Estado de Pago:</label>
                    <select id="statusFilter" class="admin-select">
                        <option value="all">Todos</option>
                        <option value="active">Al día</option>
                        <option value="pending">Pendiente</option>
                        <option value="expired">Vencido</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="membershipFilter">Membresía:</label>
                    <select id="membershipFilter" class="admin-select">
                        <option value="all">Todas</option>
                        <option value="monthly">Mensual</option>
                        <option value="quarterly">Trimestral</option>
                        <option value="annual">Anual</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="countRows">Mostrar:</label>
                    <select id="countRows" class="admin-select">
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                </div>
                
                <div class="filter-group search-group">
                    <label for="searchUser">Buscar:</label>
                    <div class="search-input-wrapper">
                        <input type="text" id="buscador" name="buscador" class="admin-input" placeholder="Documento, nombre o correo..." >
                        <button class="search-btn"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </div>
            
            <!-- Users Table -->
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado de Pago</th>
                            <th>Próximo Pago</th>
                            <th>Tipo de pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">

                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['documento_usuario'] . "</td>";
                            echo "<td>" . $row['nombre_usuario'] . "</td>";
                            echo "<td>" . $row['apellido_usuario'] . "</td>";
                            echo "<td>" . $row['correo_usuario'] . "</td>";
                            echo "<td>" . $row['telefono_usuario'] . "</td>";

                            // Estado de pago (puede ser NULL si no hay mensualidad aún)
                            if ($row['estado_pago'] === null) {
                                echo '<td><span class="status-badge expired">Sin registro</span></td>';
                            } elseif ($row['estado_pago'] == 1) {
                                echo '<td><span class="status-badge active">Al día</span></td>';
                            } elseif ($row['estado_pago'] == 0) {
                                echo '<td><span class="status-badge pending">Pendiente</span></td>';
                            } else {
                                echo '<td><span class="status-badge expired">Vencido</span></td>';
                            }

                            // Fecha próximo pago (puede ser NULL también)
                            echo "<td>" . ($row['fecha_proximo_pago'] ? date('d/m/Y', strtotime($row['fecha_proximo_pago'])) : '-') . "</td>";
                            // Tipo de pago (puede ser NULL también)
                            echo "<td>" . ($row['tipo_pago'] ? $row['tipo_pago'] : '-') . "</td>";

                            // Acciones
                            echo "<td>
                                    <div class='table-actions'>
                                        <button class='action-btn view' title='Ver detalles'><i class='fa-solid fa-eye'></i></button>
                                        <button class='action-btn edit' title='Editar'><i class='fa-solid fa-pen-to-square'></i></button>
                                        <button class='action-btn delete' title='Eliminar'><i class='fa-solid fa-trash'></i></button>
                                    </div>
                                </td>";
                            echo "</tr>";
                        }

                    ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="admin-pagination">
                <div class="pagination-info">
                    <?php
                        // Mostrar el número total de usuarios
                        echo "<span>Mostrando " . ($rows + 1) . "-" . ($rows + $limit) . " de " . $nr_of_rows . " usuarios</span>";
                    ?>
                </div>
                <div class="pagination-controls">
                        <?php 
                        if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                            ?>
                            <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>"><button class="pagination-btn" ><i class="fa-solid fa-chevron-left"></i></button></a>
                            <?php
                        } else {
                            ?>
                            <button class="pagination-btn" ><i class="fa-solid fa-chevron-left"></i></button>
                            <?php
                        }

                        ?>

                    
                    
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    
                    <?php
                    if(!isset($_GET['page-nr'])) {
                        ?>
                        <a href="?page-nr=2"><button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button></a>
                        <?php
                    } else {
                        if ($_GET['page-nr'] >= $pages) {
                            ?>
                            <a href=""><button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button></a>
                            <?php
                        } else {
                            ?>
                            <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>"><button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button></a>
                            <?php
                    }
                }
                    
                    ?>


                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="admin-modal" id="userModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Añadir Nuevo Usuario</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <form id="userForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userDocument">Número de Documento</label>
                            <input type="text" id="userDocument" class="admin-input" required>
                        </div>
                        <div class="form-group">
                            <label for="userPhone">Teléfono</label>
                            <input type="tel" id="userPhone" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userFirstName">Nombre</label>
                            <input type="text" id="userFirstName" class="admin-input" required>
                        </div>
                        <div class="form-group">
                            <label for="userLastName">Apellido</label>
                            <input type="text" id="userLastName" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="userEmail">Correo Electrónico</label>
                        <input type="email" id="userEmail" class="admin-input" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userMembership">Tipo de Membresía</label>
                            <select id="userMembership" class="admin-select" required>
                                <option value="">Seleccionar Membresía</option>
                                <option value="monthly">Mensual</option>
                                <option value="quarterly">Trimestral</option>
                                <option value="annual">Anual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userStartDate">Fecha de Inicio</label>
                            <input type="date" id="userStartDate" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="userNotes">Notas</label>
                        <textarea id="userNotes" class="admin-textarea" rows="3" placeholder="Notas adicionales sobre el usuario..."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="admin-btn secondary" id="cancelUserForm">Cancelar</button>
                        <button type="submit" class="admin-btn">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="admin-modal" id="deleteUserModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Confirmar Eliminación</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
                <p class="delete-user-info">Ana Martínez (1098765432)</p>
                <div class="form-actions">
                    <button type="button" class="admin-btn secondary" id="cancelDeleteUser">Cancelar</button>
                    <button type="button" class="admin-btn danger" id="confirmDeleteUser">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min."></script>
    <script src="../js/admin.js"></script>
    <script src="../js/usuarios.ja"></script>
    <script src='./js/buscar_usuarios.js'></script>
    <script>
    </script>
</body>

</html>