<?php

session_start();

if(!isset($_SESSION['documento_usuario'])) {
    header('Location: ../index.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Panel de Administrador - FitLife">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Pagos | FitLife Admin</title>

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
                        <li><a href="entrenadores.php"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
                        <li class="active"><a href="pagos.php"><i class="fa-solid fa-credit-card"></i> Pagos</a></li>
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
            <li><a href="entrenadores.html"><i class="fa-solid fa-dumbbell"></i> Entrenadores</a></li>
            <li class="active"><a href="pagos.html"><i class="fa-solid fa-credit-card"></i> Pagos</a></li>
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
                    <h2>Gestión de Pagos</h2>
                    <p>Administra los pagos realizados en el gimnasio</p>
                </div>
                <div class="admin-page-actions">
                    <button class="admin-btn" id="registerPaymentBtn"><i class="fa-solid fa-plus"></i> Registrar Pago</button>
                    <button class="admin-btn secondary"><i class="fa-solid fa-file-export"></i> Exportar</button>
                </div>
            </div>
            
            <!-- Payments Filter -->
            <div class="users-filter">
                <div class="filter-group">
                    <label for="dateRangeFilter">Rango de Fechas:</label>
                    <select id="dateRangeFilter" class="admin-select">
                        <option value="all">Todos</option>
                        <option value="today">Hoy</option>
                        <option value="week">Esta Semana</option>
                        <option value="month">Este Mes</option>
                        <option value="custom">Personalizado</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="paymentMethodFilter">Forma de Pago:</label>
                    <select id="paymentMethodFilter" class="admin-select">
                        <option value="all">Todas</option>
                        <option value="cash">Efectivo</option>
                        <option value="credit">Tarjeta de Crédito</option>
                        <option value="debit">Tarjeta de Débito</option>
                        <option value="transfer">Transferencia</option>
                    </select>
                </div>
                
                <div class="filter-group search-group">
                    <label for="searchPayment">Buscar:</label>
                    <div class="search-input-wrapper">
                        <input type="text" id="searchPayment" class="admin-input" placeholder="ID, documento o nombre...">
                        <button class="search-btn"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </div>
            
            <!-- Payments Table -->
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Forma de Pago</th>
                            <th>Tipo de Pago</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PAG-001</td>
                            <td>15/05/2025</td>
                            <td>10:30</td>
                            <td>1098765432</td>
                            <td>Ana Martínez</td>
                            <td>Tarjeta de Crédito</td>
                            <td>Mensualidad</td>
                            <td>$80.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-002</td>
                            <td>15/05/2025</td>
                            <td>11:45</td>
                            <td>1087654321</td>
                            <td>Carlos Rodríguez</td>
                            <td>Efectivo</td>
                            <td>Mensualidad</td>
                            <td>$80.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-003</td>
                            <td>16/05/2025</td>
                            <td>09:15</td>
                            <td>1065432109</td>
                            <td>Pedro Sánchez</td>
                            <td>Transferencia</td>
                            <td>Trimestral</td>
                            <td>$210.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-004</td>
                            <td>16/05/2025</td>
                            <td>14:20</td>
                            <td>1054321098</td>
                            <td>María López</td>
                            <td>Tarjeta de Débito</td>
                            <td>Mensualidad</td>
                            <td>$80.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-005</td>
                            <td>17/05/2025</td>
                            <td>10:00</td>
                            <td>1043210987</td>
                            <td>Javier Fernández</td>
                            <td>Efectivo</td>
                            <td>Mensualidad</td>
                            <td>$80.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-006</td>
                            <td>17/05/2025</td>
                            <td>16:30</td>
                            <td>1021098765</td>
                            <td>Miguel Torres</td>
                            <td>Tarjeta de Crédito</td>
                            <td>Anual</td>
                            <td>$750.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAG-007</td>
                            <td>18/05/2025</td>
                            <td>09:45</td>
                            <td>1032109876</td>
                            <td>Sofía Díaz</td>
                            <td>Transferencia</td>
                            <td>Mensualidad</td>
                            <td>$80.000</td>
                            <td>
                                <div class="table-actions">
                                    <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                                    <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="admin-pagination">
                <div class="pagination-info">
                    <span>Mostrando 1-7 de 24 pagos</span>
                </div>
                <div class="pagination-controls">
                    <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">4</button>
                    <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Payment Modal -->
    <div class="admin-modal" id="paymentModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Registrar Nuevo Pago</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <form id="paymentForm">
                    <div class="form-group">
                        <label for="paymentDocument">Documento del Usuario</label>
                        <div class="search-input-wrapper">
                            <input type="text" id="paymentDocument" class="admin-input" required>
                            <button type="button" class="search-btn" id="searchUserBtn"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </div>
                    
                    <div class="user-info-preview" id="userInfoPreview">
                        <div class="user-info-header">
                            <h4>Información del Usuario</h4>
                        </div>
                        <div class="user-info-content">
                            <p><strong>Nombre:</strong> <span id="userName">-</span></p>
                            <p><strong>Correo:</strong> <span id="userEmail">-</span></p>
                            <p><strong>Teléfono:</strong> <span id="userPhone">-</span></p>
                            <p><strong>Membresía Actual:</strong> <span id="userMembership">-</span></p>
                            <p><strong>Estado de Pago:</strong> <span id="userPaymentStatus">-</span></p>
                            <p><strong>Próximo Pago:</strong> <span id="userNextPayment">-</span></p>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="paymentType">Tipo de Pago</label>
                            <select id="paymentType" class="admin-select" required>
                                <option value="">Seleccionar Tipo</option>
                                <option value="monthly">Mensualidad</option>
                                <option value="quarterly">Trimestral</option>
                                <option value="annual">Anual</option>
                                <option value="enrollment">Matrícula</option>
                                <option value="other">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Forma de Pago</label>
                            <select id="paymentMethod" class="admin-select" required>
                                <option value="">Seleccionar Forma</option>
                                <option value="cash">Efectivo</option>
                                <option value="credit">Tarjeta de Crédito</option>
                                <option value="debit">Tarjeta de Débito</option>
                                <option value="transfer">Transferencia</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="paymentAmount">Monto</label>
                            <input type="number" id="paymentAmount" class="admin-input" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="paymentDate">Fecha</label>
                            <input type="date" id="paymentDate" class="admin-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="paymentNotes">Notas</label>
                        <textarea id="paymentNotes" class="admin-textarea" rows="3" placeholder="Notas adicionales sobre el pago..."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="admin-btn secondary" id="cancelPaymentForm">Cancelar</button>
                        <button type="submit" class="admin-btn">Registrar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Details Modal -->
    <div class="admin-modal" id="paymentDetailsModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Detalles del Pago</h3>
                <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <div class="payment-details">
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">ID de Pago:</div>
                        <div class="payment-detail-value" id="detailPaymentId">PAG-001</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Fecha y Hora:</div>
                        <div class="payment-detail-value" id="detailDateTime">15/05/2025 10:30</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Usuario:</div>
                        <div class="payment-detail-value" id="detailUser">Ana Martínez (1098765432)</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Tipo de Pago:</div>
                        <div class="payment-detail-value" id="detailPaymentType">Mensualidad</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Forma de Pago:</div>
                        <div class="payment-detail-value" id="detailPaymentMethod">Tarjeta de Crédito</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Monto:</div>
                        <div class="payment-detail-value" id="detailAmount">$80.000</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Registrado por:</div>
                        <div class="payment-detail-value" id="detailRegisteredBy">Admin</div>
                    </div>
                    <div class="payment-detail-row">
                        <div class="payment-detail-label">Notas:</div>
                        <div class="payment-detail-value" id="detailNotes">Pago de mensualidad correspondiente a mayo 2025.</div>
                    </div>
                </div>
                
                <div class="payment-actions">
                    <button class="admin-btn secondary" id="printReceipt"><i class="fa-solid fa-print"></i> Imprimir Recibo</button>
                    <button class="admin-btn" id="downloadReceipt"><i class="fa-solid fa-download"></i> Descargar Recibo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/pagos.js"></script>
</body>

</html>