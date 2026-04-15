<?php
include("../../includes/header.php");
include('../../config/conexion.php');

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $numero_documento = $_POST['numero_documento'];
    $ciudad = $_POST['ciudad'];
    $id_tipo_documento = $_POST['id_tipo_documento'];

    $sql = "INSERT INTO clientes(nombre, correo, telefono, numero_documento, ciudad, id_tipo_documento)
    VALUES('$nombre', '$correo', '$telefono', '$numero_documento', '$ciudad', '$id_tipo_documento')";

    if ($conexion->query($sql)) {
        
        $mensaje = "<div class='alert alert-success'>Cliente registrado correctamente.</div>";
    } else {
        
        $mensaje = "<div class='alert alert-danger'>Error: " . $conexion->error . "</div>";
    }
}
?>

<section class="content mt-3">
    <div class="container-fluid">
        
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar Nuevo Cliente</h3>
            </div>
            
            <div class="card-body">
                
                <?= $mensaje ?>

                <form method="POST">
                
                    <div class="row">

                        
                        <div class="col-md-6 form-group">
                            <label for="nombre">Nombre Completo</label>
                            
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="correo">Correo Electrónico</label>
                        
                            <input type="email" name="correo" class="form-control" placeholder="Ej: juan@mail.com" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="id_tipo_documento">Tipo de Documento</label>
                            <select name="id_tipo_documento" class="form-control" required>
                                <option value="">Seleccione un tipo...</option>
                                <option value="1">(CC) Cédula de Ciudadanía</option>
                                <option value="2">(TI) Tarjeta de Identidad</option>
                                <option value="3">(CE) Cédula Extranjera</option>
                                <option value="4">(PAS) Pasaporte</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="numero_documento">Número de Documento</label>
                            <input type="number" name="numero_documento" class="form-control" required>
                        </div>

                    </div>

                    <br>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cliente
                    </button>

                </form>
            </div>
        </div>

    </div>
</section>

<?php include("../../includes/footer.php"); ?>