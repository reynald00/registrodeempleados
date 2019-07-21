<?php

  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
  $txtApellidoP=(isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
  $txtApellidoM=(isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
  $txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
  $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
  $txtFoto=(isset($_POST['txtFoto']))?$_POST['txtFoto']:"";


  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  include ("../Conexion/conexion.php");

  switch($accion){
      case "btnAgregar":

          $sentencia=$pdo->prepare("INSERT INTO empleados(Nombre,ApellidoPaterno,ApellidoMaterno,Cedula,Correo,Foto)
            VALUES (:Nombre,:ApellidoPaterno,:ApellidoMaterno,:Cedula,:Correo,:Foto)");

            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':ApellidoPaterno',$txtApellidoP);
            $sentencia->bindParam(':ApellidoMaterno',$txtApellidoM);
            $sentencia->bindParam(':Cedula',$txtCedula);
            $sentencia->bindParam(':Correo',$txtCorreo);
            $sentencia->bindParam(':Foto',$txtFoto);

            $sentencia->execute();

        echo "Presionaste el btnAgregar";
      break;
      case "btnModificar":

          $sentencia=$pdo->prepare("UPDATE empleados SET
            Nombre=:Nombre,
            ApellidoPaterno=:ApellidoPaterno,
            ApellidoMaterno=:ApellidoMaterno,
            Cedula=:Cedula,
            Correo=:Correo,
            Foto=:Foto WHERE
            id=:id");
                

            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':ApellidoPaterno',$txtApellidoP);
            $sentencia->bindParam(':ApellidoMaterno',$txtApellidoM);
            $sentencia->bindParam(':Cedula',$txtCedula);
            $sentencia->bindParam(':Correo',$txtCorreo);
            $sentencia->bindParam(':Foto',$txtFoto);
            $sentencia->bindParam(':id',$txtID);

            $sentencia->execute();

            header("Location: index.php");

       echo "Presionaste el btnModificar";
      break;
      case "btnEliminar":
        $sentencia=$pdo->prepare("DELETE FROM empleados WHERE id=:id");
          
           $sentencia->bindParam(':id',$txtID);

            $sentencia->execute();

            header("Location: index.php");

        echo "Presionaste el btnEliminar";
      break;
      case "btnCancelar":
        echo "Presionaste el btnCancelar";
      break;
  }

    $sentencia=$pdo->prepare("SELECT * FROM  `empleados` WHERE 1");

    $sentencia->execute();

    $listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Registro de Empleados</title>
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </head>
  <body>

    <div class="container">

    <form action="" method="post" enctype="multipart/form-data">
      
      <label for="">ID:</label>
      <input type="text" name="txtID" value="<?php echo $txtID;?>" placeholder="" id="txtID" required="">
      <br>

      <label for="">Nombres:</label>
      <input type="text" name="txtNombre" value="<?php echo $txtNombre;?>" placeholder="" id="txtNombre" required="">
      <br>

      <label for="">Apellido Paterno:</label>
      <input type="text" name="txtApellidoP" value="<?php echo $txtApellidoP;?>" placeholder="" id="txtApellidoP" required="">
      <br>

      <label for="">Apellido Materno:</label>
      <input type="text" name="txtApellidoM" value="<?php echo $txtApellidoM;?>" placeholder="" id="txtApellidoM" required="">
      <br>

      <label for="">Cédula:</label>
      <input type="text" name="txtCedula" value="<?php echo $txtCedula;?>" placeholder="" id="txtCedula" required="">
      <br>

      <label for="">Correo:</label>
      <input type="text" name="txtCorreo" value="<?php echo $txtCorreo;?>" placeholder="" id="txtCorreo" required="">
      <br>

      <label for="">Foto:</label>
      <input type="text" name="txtFoto" value="<?php echo $txtFoto;?>" placeholder="" id="txtFoto" required="">
      <br>

      <button value="btnAgregar" type="submit" name="accion">Agregar</button>
      <button value="btnModificar" type="submit" name="accion">Modificar</button>
      <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
      <button value="btnCancelar" type="submit" name="accion">Cancelar</button>
      
    </form>

    <div class="row">
        
        <table class="table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nombre Completo</th>
              <th>Cédula o Pasaporte</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <?php foreach($listaEmpleados as $empleado){ ?>
            <tr>
              <td><?php echo $empleado['Foto']; ?></td>
              <td><?php echo $empleado['Nombre']; ?> <?php echo $empleado['ApellidoPaterno']; ?> <?php echo $empleado['ApellidoMaterno']; ?></td>
              <td><?php echo $empleado['Cedula']; ?></td>
              <td><?php echo $empleado['Correo']; ?></td>
              
              <td>

                <form action="" method="post">

                  <input type="hidden" name="txtID" value="<?php echo $empleado['ID']; ?>">
                  <input type="hidden" name="txtNombre" value="<?php echo $empleado['Nombre']; ?>">
                  <input type="hidden" name="txtApellidoP" value="<?php echo $empleado['ApellidoPaterno']; ?>">
                  <input type="hidden" name="txtApellidoM" value="<?php echo $empleado['ApellidoMaterno']; ?>">
                  <input type="hidden" name="txtCedula" value="<?php echo $empleado['Cedula']; ?>">
                  <input type="hidden" name="txtCorreo" value="<?php echo $empleado['Correo']; ?>">
                  <input type="hidden" name="txtFoto" value="<?php echo $empleado['Foto']; ?>">

                  <input type="submit" value="Seleccionar" name="accion ">
                   <button value="btnEliminar" type="submit" name="accion">Eliminar</button>

                </form>
                

              </td>

            </tr>
          <?php } ?>
          
        </table>
    </div>
  </div>

  </body>
</html>