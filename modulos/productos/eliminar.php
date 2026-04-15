<?php
include('../../config/conexion.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "DELETE FROM productos WHERE id_producto = $id";

    
    if ($conexion->query($sql)) {
        
        header("Location: listar.php");
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }
} else {
    echo "Error: No se recibio el ID del producto a eliminar.";
}
?>