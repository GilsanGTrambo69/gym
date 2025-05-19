<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Panel de Administrador - FitLife">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Entrenadores | FitLife Admin</title>

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
                        <li><a href="horarios.php"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
                        <li class="active"><a href="entrenadores.php"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
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
            <li><a href="usuarios.html"><i class="fa-solid fa-users"></i> Usuarios</a></li>
            <li><a href="index.html"><i class="fa-solid fa-calendar-days"></i> Horarios</a></li>
            <li class="active"><a href="entrenadores.html"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
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
                    <h2>Gestión de Entrenadores</h2>
                    <p>Administra los entrenadores del gimnasio</p>
                </div>
                <div class="admin-page-actions">
                    <button class="admin-btn" id="addTrainerBtn"><i class="fa-solid fa-user-plus"></i> Nuevo Entrenador</button>
                    <button class="admin-btn secondary"><i class="fa-solid fa-file-export"></i> Exportar</button>
                </div>
            </div>
            
            <!-- Trainers Filter -->
            <div class="users-filter">
                <div class="filter-group">
                    <label for="specialtyFilter">Especialidad:</label>
                    <select id="specialtyFilter" class="admin-select">
                        <option value="all">Todas</option>
                        <option value="yoga">Yoga</option>
                        <option value="crossfit">CrossFit</option>
                        <option value="spinning">Spinning</option>
                        <option value="boxing">Boxeo</option>
                        <option value="pilates">Pilates</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="statusFilter">Estado:</label>
                    <select id="statusFilter" class="admin-select">
                        <option value="all">Todos</option>
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                </div>
                
                <div class="filter-group search-group">
                    <label for="searchTrainer">Buscar:</label>
                    <div class="search-input-wrapper">
                        <input type="text" id="searchTrainer" class="admin-input" placeholder="Documento, nombre o correo...">
                        <button class="search-btn"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </div>
            
            <!-- Trainers Table -->
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Especialidad</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1023456789</td>
                            <td>Sara</td>
                            <td>Jiménez</td>
                            <td>Yoga</td>
                            <td>sara.jimenez@email.com</td>
                            <td>601-987-6543</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1034567890</td>
                            <td>Miguel</td>
                            <td>Moreno</td>
                            <td>CrossFit</td>
                            <td>miguel.moreno@email.com</td>
                            <td>602-876-5432</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1045678901</td>
                            <td>Elena</td>
                            <td>Díaz</td>
                            <td>Spinning, Pilates</td>
                            <td>elena.diaz@email.com</td>
                            <td>603-765-4321</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1056789012</td>
                            <td>David</td>
                            <td>Ruiz</td>
                            <td>Boxeo</td>
                            <td>david.ruiz@email.com</td>
                            <td>604-654-3210</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1067890123</td>
                            <td>Carmen</td>
                            <td>Vega</td>
                            <td>Yoga, Pilates</td>
                            <td>carmen.vega@email.com</td>
                            <td>605-543-2109</td>
                            <td><span class="status-badge inactive">Inactivo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1078901234</td>
                            <td>Roberto</td>
                            <td>Pérez</td>
                            <td>CrossFit</td>
                            <td>roberto.perez@email.com</td>
                            <td>606-432-1098</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="admin-pagination">
                <div class="pagination-info">
                    <span>Mostrando 1-6 de 6 entrenadores</span>
                </div>
                <div class="pagination-controls">
                    <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Trainer Modal -->
    <div class="admin-modal" id="trainerModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Añadir Nuevo Entrenador</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <form id="trainerForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="trainerDocument">Número de Documento</label>
                            <input type="text" id="trainerDocument" class="admin-input" required>
                        </div>
                        <div class="form-group">
                            <label for="trainerPhone">Teléfono</label>
                            <input type="tel" id="trainerPhone" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="trainerFirstName">Nombre</label>
                            <input type="text" id="trainerFirstName" class="admin-input" required>
                        </div>
                        <div class="form-group">
                            <label for="trainerLastName">Apellido</label>
                            <input type="text" id="trainerLastName" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="trainerEmail">Correo Electrónico</label>
                        <input type="email" id="trainerEmail" class="admin-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Especialidades</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="specialtyYoga" name="specialty" value="yoga">
                                <label for="specialtyYoga">Yoga</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="specialtyCrossfit" name="specialty" value="crossfit">
                                <label for="specialtyCrossfit">CrossFit</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="specialtySpinning" name="specialty" value="spinning">
                                <label for="specialtySpinning">Spinning</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="specialtyBoxing" name="specialty" value="boxing">
                                <label for="specialtyBoxing">Boxeo</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="specialtyPilates" name="specialty" value="pilates">
                                <label for="specialtyPilates">Pilates</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="trainerStartDate">Fecha de Inicio</label>
                            <input type="date" id="trainerStartDate" class="admin-input" required>
                        </div>
                        <div class="form-group">
                            <label for="trainerStatus">Estado</label>
                            <select id="trainerStatus" class="admin-select" required>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="trainerBio">Biografía</label>
                        <textarea id="trainerBio" class="admin-textarea" rows="3" placeholder="Breve biografía del entrenador..."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="admin-btn secondary" id="cancelTrainerForm">Cancelar</button>
                        <button type="submit" class="admin-btn">Guardar Entrenador</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="admin-modal" id="deleteTrainerModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Confirmar Eliminación</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <p>¿Estás seguro de que deseas eliminar este entrenador? Esta acción no se puede deshacer.</p>
                <p class="delete-trainer-info">Sara Jiménez (1023456789)</p>
                <div class="form-actions">
                    <button type="button" class="admin-btn secondary" id="cancelDeleteTrainer">Cancelar</button>
                    <button type="button" class="admin-btn danger" id="confirmDeleteTrainer">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/entrenadores.js"></script>
</body>

</html>