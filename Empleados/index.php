<?php

  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
  $txtApellidoP=(isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
  $txtApellidoM=(isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
  $txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
  $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
  $txtFoto=(isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";


  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  $accionAgregar="";
  $accionModificar=$accionEliminar=$accionCancelar="disabled";
  $mostrarModal=false;

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

            $Fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";

            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];

            if ($tmpFoto!="") {
              move_uploaded_file($tmpFoto,"../Imagenes/".$nombreArchivo);
            }

            $sentencia->bindParam(':Foto',$nombreArchivo);

            $sentencia->execute();

            header("Location: index.php");
       
      break;
      case "btnModificar":
            $sentencia=$pdo->prepare("UPDATE empleados SET
            Nombre=:Nombre,
            ApellidoPaterno=:ApellidoPaterno,
            ApellidoMaterno=:ApellidoMaterno,
            Cedula=:Cedula,
            Correo=:Correo WHERE id=:id");
            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':ApellidoPaterno',$txtApellidoP);
            $sentencia->bindParam(':ApellidoMaterno',$txtApellidoM);
            $sentencia->bindParam(':Cedula',$txtCedula);
            $sentencia->bindParam(':Correo',$txtCorreo);
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $Fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
            if ($tmpFoto!="") {
              move_uploaded_file($tmpFoto,"../Imagenes/".$nombreArchivo);
              $sentencia=$pdo->prepare("SELECT Foto FROM empleados WHERE id=:id");
              $sentencia->bindParam(':id',$txtID);
              $sentencia->execute();
              $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
              if(isset($empleado["Foto"])){
                if(file_exists("../Imagenes/".$empleado["Foto"])){

                  if($item['Foto']!="imagen.jpg"){

                     unlink("../Imagenes/".$empleado["Foto"]);

                  }
                }
              }

              $sentencia=$pdo->prepare("UPDATE empleados SET
              Foto=:Foto WHERE id=:id");
              $sentencia->bindParam(':Foto',$nombreArchivo);
              $sentencia->bindParam(':id',$txtID);
              $sentencia->execute();
            }

            header("Location: index.php");

       
      break;

      case "btnEliminar":

        $sentencia=$pdo->prepare("SELECT Foto FROM empleados WHERE id=:id");
        $sentencia->bindParam(':id',$txtID);
        $sentencia->execute();

        $empleado=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($empleado["Foto"])&&($item['Foto']!="imagen.jpg")){

          if(file_exists("../Imagenes/".$empleado["Foto"])){
            unlink("../Imagenes/".$empleado["Foto"]);
          }
        }

        $sentencia=$pdo->prepare("DELETE FROM empleados WHERE id=:id");
        $sentencia->bindParam(':id',$txtID);
        $sentencia->execute();

            header("Location: index.php");
      break;

      case "btnCancelar":
        
        header("Location: index.php");

      break;

      case "Seleccionar":

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";

        $mostrarModal=true;

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
      <br>
    <form action="" method="post" enctype="multipart/form-data">
      <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Empleado</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-row">
                    <input type="hidden" name="txtID" value="<?php echo $txtID;?>" placeholder="" id="txtID" required="">

                    <div class="form-group col-md-4">
                      <label for="">Nombres:</label>
                    <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre;?>" placeholder="" id="txtNombre" required="">
                    <br>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">Apellido Paterno:</label>
                    <input type="text" class="form-control" name="txtApellidoP" value="<?php echo $txtApellidoP;?>" placeholder="" id="txtApellidoP" required="">
                    <br>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="">Apellido Materno:</label>
                    <input type="text" class="form-control" name="txtApellidoM" value="<?php echo $txtApellidoM;?>" placeholder="" id="txtApellidoM" required="">
                    <br>
                    </div>
      
                    <div class="form-group col-md-6">
                    <label for="">Cédula:</label>
                    <input type="text" class="form-control" name="txtCedula" value="<?php echo $txtCedula;?>" placeholder="" id="txtCedula" required="">
                    <br>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="">Correo:</label>
                    <input type="email" class="form-control" name="txtCorreo" value="<?php echo $txtCorreo;?>" placeholder="" id="txtCorreo" required="">
                    <br>
                    </div>

                    <label for="">Foto:</label>
                    <input type="file" class="form-control" accept="image/*" name="txtFoto" value="<?php echo $txtFoto;?>" placeholder="" id="txtFoto">
                    <br>

                  </div>
                </div>
              <div class="modal-footer">

                <button value="btnAgregar" <?php echo $accionAgregar;?> class="btn btn-success" type="submit" name="accion">Agregar</button>
                <button value="btnModificar" <?php echo $accionModificar;?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
                <button value="btnEliminar" <?php echo $accionEliminar;?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                <button value="btnCancelar" <?php echo $accionCancelar;?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>

                </div>
              </div>
            </div>
          </div>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Nuevo Registro
          </button>



      
    </form>
    <br>

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
              <td><img class="img-thumbnail" width="100px" src="../Imagenes/<?php echo $empleado['Foto']; ?>"/> </td>
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

                  <input type="submit" value="Seleccionar" name="accion">
                   <button value="btnEliminar" type="submit" name="accion">Eliminar</button>

                </form>
                

              </td>

            </tr>
          <?php } ?>
          
        </table>
    </div>

  <?php if($mostrarModal){?>
      <script>
        $('#exampleModal').modal('show');
      </script>
   <?php }?>

  </div>

  </body>
</html>