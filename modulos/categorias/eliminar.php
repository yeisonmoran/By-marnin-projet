<?php

require_once('../../config/conexion.php');

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    // Verificar si la categoría tiene productos asociados
    $chk = $conexion->prepare("SELECT COUNT(*) as total FROM productos WHERE id_categoria = ?");
    $chk->bind_param("i", $id);
    $chk->execute();
    $total = $chk->get_result()->fetch_assoc()['total'];

    if ($total > 0) {
        header("Location: listar.php?error=fk&detalle=La+categoria+tiene+$total+producto(s)+asociado(s).+Reasignalos+o+eliminelos+primero.");
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM categorias WHERE id_categoria = ?");
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
