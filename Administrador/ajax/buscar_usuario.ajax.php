<?php
include ('../../assets/conexion.php');

$consulta = isset($_POST['consulta']) ? mysqli_real_escape_string($conexion, $_POST['consulta']) : '';

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
    SELECT u.documento_usuario, u.nombre_usuario, u.apellido_usuario,
           u.correo_usuario, u.telefono_usuario,
           m.estado_pago, m.fecha_proximo_pago, m.tipo_pago
    FROM usuarios u
    LEFT JOIN mensualidad m ON u.documento_usuario = m.id_usuario_pago
    WHERE u.id_rol_usuario = 1 LIMIT $rows, $limit
";

if ($consulta != '') {
    $query .= " AND (
        u.documento_usuario LIKE '%$consulta%' OR 
        u.nombre_usuario LIKE '%$consulta%' OR 
        u.apellido_usuario LIKE '%$consulta%' OR 
        u.correo_usuario LIKE '%$consulta%' OR 
        u.telefono_usuario LIKE '%$consulta%'
    )";
}

$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['documento_usuario'] . "</td>";
        echo "<td>" . $row['nombre_usuario'] . "</td>";
        echo "<td>" . $row['apellido_usuario'] . "</td>";
        echo "<td>" . $row['correo_usuario'] . "</td>";
        echo "<td>" . $row['telefono_usuario'] . "</td>";

        // Estado de pago
        if ($row['estado_pago'] === null) {
            echo '<td><span class="status-badge expired">Sin registro</span></td>';
        } elseif ($row['estado_pago'] == 1) {
            echo '<td><span class="status-badge active">Al día</span></td>';
        } elseif ($row['estado_pago'] == 0) {
            echo '<td><span class="status-badge pending">Pendiente</span></td>';
        } else {
            echo '<td><span class="status-badge expired">Vencido</span></td>';
        }

        echo "<td>" . ($row['fecha_proximo_pago'] ? date('d/m/Y', strtotime($row['fecha_proximo_pago'])) : '-') . "</td>";
        echo "<td>" . ($row['tipo_pago'] ? $row['tipo_pago'] : '-') . "</td>";

        echo "<td>
                <div class='table-actions'>
                    <button class='action-btn view'><i class='fa-solid fa-eye'></i></button>
                    <button class='action-btn edit'><i class='fa-solid fa-pen-to-square'></i></button>
                    <button class='action-btn delete'><i class='fa-solid fa-trash'></i></button>
                </div>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No se encontraron resultados</td></tr>";
}
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/usuarios.js"></script>
    <script src='../js/buscar_usuarios.js'></script>