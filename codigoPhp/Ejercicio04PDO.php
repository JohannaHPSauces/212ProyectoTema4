<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 3</title>
        <meta charset="UTF-8">
        <style>
            h3{
                font-weight: bold;
            }
            table{
                border: 2px white solid;
                background: lightgoldenrodyellow;
            }
            td{
                text-align: center;
                border: 4px black solid;
            }
            th{
                border: 4px black solid;
                background: yellow;
            }
            fieldset{
                margin:auto;
                width: 320px;height: 210px;
                text-align: center;
                font-size: 20px;
                 font-weight: bold;
                border: 4px solid black;
                color: black;
                position: relative;
            }
            input{
                font-size: 16px;
                border-radius:5px;
            }
            input:nth-of-type(2),input:nth-of-type(3){
                font-size: 20px;
                border-radius:5px;
            }
        </style>

    </head>
    <body>
        
       <?php 
        /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 02/04/2022
             *  Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).
             */
       
        //Importamos la libreria de validacion
        require_once '../core/210322ValidacionFormularios.php'; 
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php'; 
        
        if(isset($_REQUEST['volver'])){ //Si el usuario pulsa cancelar
            header('Location: ../index.php');// le manda a la pagina del programa
            exit;
        }
         echo "<h3>*Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).*</h3>";   
        
         //Array respuestas
        $aErrores = [
            'DescDepartamento' => null];
        
            try {
               //Establecer una conexión con la base de datos 
                $miDB = new PDO(HOST,USER,PASSWORD);                            
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                
                //Si ha dado al boton de buscar
                if (isset($_REQUEST['enviar'])) {                                      
                    
                    //consulta buscar el departamento
                    $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%{$_REQUEST['DescDepartamento']}%';";     //Guardamos en la variable la consulta que queremos hacer
                    //Preparamos la consulta
                    $resultadoConsulta = $miDB->prepare($consulta); 
                    //Ejecutamos la consulta
                    $resultadoConsulta->execute();
                    
                    //Si no ha buscado ningun departamento mostramos todos
                    if($resultadoConsulta->rowCount()>0){
                        echo "<table>";
                        echo "<tr>";
                            echo "<th> CODIGO DEPARTAMENTO</th>";
                            echo "<th> DESCRIPCION DEPARTAMENTO</th>";
                            echo "<th> VOLUMEN DEPARTAMENTO </th>";
                        echo "</tr>";

                        $oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                        while ($oDepartamento){   
                            echo "<tr>";
                            echo "<td><p>$oDepartamento->T02_CodDepartamento </td>";           
                            echo "<td> $oDepartamento->T02_DescDepartamento </td>";
                            echo "<td> $oDepartamento->T02_VolumenNegocio </td></p>";
                            echo "</tr>";
                            $oDepartamento = $resultadoConsulta->fetchObject();
                        } 
                    }else{
                        //Si el departamento no existe le decimos que no existe
                       echo "<p style='background-color: red;'>NO EXISTE ESE DEPARTAMENTO!!</p><br>";
                    }
                }  
            }catch (PDOException $excepcion){
                    $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                    $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

                    echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
                    echo "<br>";
                    echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
                } finally {
                    //Cerramos conexion
                    unset($miDB);
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                        <h3>BUSCAR DEPARTAMENTO</h3>
                        <label>Descripción Departamento </label>
                        <input type = "text" name = "DescDepartamento" value="<?php echo(isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : null); ?>"> <?php echo($aErrores['DescDepartamento']!=null ? "<span style='color:red'>".$aErrores['DescDepartamento']."</span>" : null); ?>
                        <br><br>

                        <input type="submit" name="enviar" value="Buscar">
                        <input type="submit" value="Volver" name="volver">
                </fieldset>
            </form>
  
    </body>
</html>