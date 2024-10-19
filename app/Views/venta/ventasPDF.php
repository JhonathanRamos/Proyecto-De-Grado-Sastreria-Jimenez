<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Descripción</th>
                <th>Adelanto</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Método de Pago</th>
                <th>Fecha Registro</th>
                <th>Fecha Entrega</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($ventas) && !empty($ventas)): ?>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= $venta['idVenta']; ?></td>
                        <td><?= $venta['nombre'] . ' ' . $venta['apellido']; ?></td>
                        <td><?= $venta['descripcion']; ?></td>
                        <td><?= $venta['adelanto'] . ' Bs'; ?></td>
                        <td><?= $venta['total'] . ' Bs'; ?></td>
                        <td><?= $venta['estado'] == 1 ? 'Completado' : 'Pendiente'; ?></td>
                        <td><?= $venta['metodo_pago']; ?></td>
                        <td><?= $venta['fechaRegistro']; ?></td>
                        <td><?= $venta['fecha']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No hay ventas para mostrar</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
