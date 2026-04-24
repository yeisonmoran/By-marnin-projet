<?php

require_once('../../config/conexion.php');

$id = (int)($_GET['id'] ?? 0);

// No permitir eliminar el propio usuario
if ($id === (int)$_SESSION['id_usuario']) {
    header('Location: listar.php?error=self');
    exit;
}

if ($id > 0) {
    // Verificar si el usuario tiene ventas registradas
    $chk = $conexion->prepare("SELECT COUNT(*) as total FROM ventas WHERE id_usuario = ?");
    $chk->bind_param("i", $id);
    $chk->execute();
    $total = $chk->get_result()->fetch_assoc()['total'];

    if ($total > 0) {
        header("Location: listar.php?error=fk&detalle=El+usuario+tiene+$total+venta(s)+registrada(s).+No+puede+eliminarse+para+conservar+el+historial.");
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
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
