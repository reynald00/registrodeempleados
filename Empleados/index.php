<?php
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
  $txtApellidoP=(isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
  $txtApellidoM=(isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
  $txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
  $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
  $txtFoto=(isset($_POST['txtFoto']))?$_POST['txtFoto']:"";

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  switch($accion){
      case "btnAgregar":
        echo "Presionaste el btnAgregar";
      break;
      case "btnModificar":
       echo "Presionaste el btnModificar";
      break;
      case "btnEliminar":
        echo "Presionaste el btnEliminar";
      break;
      case "btnCancelar":
        echo "Presionaste el btnCancelar";
      break;
  }
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

  </div>

  </body>
</html>