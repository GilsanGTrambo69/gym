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
                
                <div class="filter-group search-group">
                    <label for="searchUser">Buscar:</label>
                    <div class="search-input-wrapper">
                        <input type="text" id="searchUser" class="admin-input" placeholder="Documento, nombre o correo...">
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1098765432</td>
                            <td>Ana</td>
                            <td>Martínez</td>
                            <td>ana.martinez@email.com</td>
                            <td>601-234-5678</td>
                            <td><span class="status-badge active">Al día</span></td>
                            <td>15/06/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1087654321</td>
                            <td>Carlos</td>
                            <td>Rodríguez</td>
                            <td>carlos.rodriguez@email.com</td>
                            <td>602-345-6789</td>
                            <td><span class="status-badge pending">Pendiente</span></td>
                            <td>05/06/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1076543210</td>
                            <td>Laura</td>
                            <td>Gómez</td>
                            <td>laura.gomez@email.com</td>
                            <td>603-456-7890</td>
                            <td><span class="status-badge expired">Vencido</span></td>
                            <td>01/05/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1065432109</td>
                            <td>Pedro</td>
                            <td>Sánchez</td>
                            <td>pedro.sanchez@email.com</td>
                            <td>604-567-8901</td>
                            <td><span class="status-badge active">Al día</span></td>
                            <td>20/06/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1054321098</td>
                            <td>María</td>
                            <td>López</td>
                            <td>maria.lopez@email.com</td>
                            <td>605-678-9012</td>
                            <td><span class="status-badge active">Al día</span></td>
                            <td>25/06/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1043210987</td>
                            <td>Javier</td>
                            <td>Fernández</td>
                            <td>javier.fernandez@email.com</td>
                            <td>606-789-0123</td>
                            <td><span class="status-badge pending">Pendiente</span></td>
                            <td>10/06/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1032109876</td>
                            <td>Sofía</td>
                            <td>Díaz</td>
                            <td>sofia.diaz@email.com</td>
                            <td>607-890-1234</td>
                            <td><span class="status-badge expired">Vencido</span></td>
                            <td>28/04/2025</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1021098765</td>
                            <td>Miguel</td>
                            <td>Torres</td>
                            <td>miguel.torres@email.com</td>
                            <td>608-901-2345</td>
                            <td><span class="status-badge active">Al día</span></td>
                            <td>30/06/2025</td>
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
                    <span>Mostrando 1-8 de 24 usuarios</span>
                </div>
                <div class="pagination-controls">
                    <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/usuarios.js"></script>
</body>

</html>