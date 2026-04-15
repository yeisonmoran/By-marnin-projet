<?php

include('../../includes/header.php');
include('../../config/conexion.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql_consultar = "SELECT * FROM productos WHERE id_producto = $id";
    $resultado = $conexion->query($sql_consultar);
    
    
    $producto = $resultado->fetch_assoc();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_oculto = $_POST['id_producto'];
    $codigo    = $_POST['codigo'];
    $nombre    = $_POST['nombre'];
    $precio    = $_POST['precio'];
    $stock     = $_POST['stock'];


    $sql_actualizar = "UPDATE productos SET 
                        codigo = '$codigo', 
                        nombre = '$nombre', 
                        precio = $precio, 
                        stock = $stock 
                       WHERE id_producto = $id_oculto";
            
    if ($conexion->query($sql_actualizar)) {
        header("Location: listar.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}
?>


<section class="content mt-3">
    <div class="container-fluid">
        
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Editar Producto</h3>
            </div>
            
            <div class="card-body">
                
                <form method="POST">
                    
                    
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

                    <div class="form-group">
                        <label>Código</label>
                        
                        <input type="text" name="codigo" class="form-control" value="<?php echo $producto['codigo']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $producto['nombre']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $producto['precio']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" value="<?php echo $producto['stock']; ?>" required>
                    </div>

                    <br>
            
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                    
                    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</section>

<?php 

include('../../includes/footer.php'); 
?>
