<?php

require_once('../../config/conexion.php');

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    // Verificar si el producto aparece en algún detalle de venta
    $chk = $conexion->prepare("SELECT COUNT(*) as total FROM detalle_ventas WHERE id_producto = ?");
    $chk->bind_param("i", $id);
    $chk->execute();
    $total = $chk->get_result()->fetch_assoc()['total'];

    if ($total > 0) {
        header("Location: listar.php?error=fk&detalle=El+producto+aparece+en+$total+venta(s)+registrada(s).+No+puede+eliminarse+para+conservar+el+historial.");
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header('Location: listar.php?ok=del');
    } else {
        header('Location: listar.php?error=db');
    }
    exit;
}

header('Location: listar.php');
exit;