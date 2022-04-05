<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 5</title>
        <meta charset="UTF-8">
        <style>
            table{
                border: 2px white solid;
                background: lightgoldenrodyellow;
            }
            td{
                text-align: center;
                border: 2px black solid;
            }
            th{
                border: 2px black solid;
                background: darkorchid;
            }
        </style>

    </head>
    <body>
        
       <?php 
        /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 02/04/2022
             * Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
             */
       
        //Importamos la libreria de validacion
        require_once '../core/210322ValidacionFormularios.php'; 
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php';     
        
        echo "<h3>*Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.*</h3>";   
        
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Desactiva el modo 'autocommit'. Mientras el modo 'autocommit' esté desactivado, no se consignarán los cambios realizados en la base de datos
            $miDB->beginTransaction();
            
            //BORRAR SI EXISTEN ESOS CODIGOS
            $consultaB1=$miDB->prepare("DELETE FROM T02_Departamento WHERE T02_CodDepartamento='COC'");
            $consultaB2=$miDB->prepare("DELETE FROM T02_Departamento WHERE T02_CodDepartamento='FLO'");
            $consultaB3=$miDB->prepare("DELETE FROM T02_Departamento WHERE T02_CodDepartamento='ODO'");
            
            $consultaB1->execute();
            $consultaB2->execute();       
            $consultaB3->execute();
            
            //Insertar 1
            $consulta1=$miDB->prepare("INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio) VALUES ('COC', 'Departamento de cocina',now(), 7)");
            
            //Insertar 2
            $consulta2=$miDB->prepare("INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio) VALUES ('FLO', 'Departamento de floristeria',now(), 9)"); 
            
            //Insertar 3
            $consulta3=$miDB->prepare("INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio) VALUES ('ODO', 'Departamento de odontologia',now(), 10)");
            
            //Ejecutamos las consultas
            $consulta1->execute();
            $consulta2->execute();       
            $consulta3->execute();
            
            //Hacemos commit para subir los cambios
            $miDB->commit();
            
            //Mensaje de todo correcto
            echo "<p style='background-color:lime;'>DEPARTAMENTOS INSERTADOS CORRECTAMENTE</p>";
                
            //consulta mostrar la tabla con los inserts hechos
            $consulta = "SELECT * FROM T02_Departamento"; 
            $resultadoConsulta = $miDB->prepare($consulta); 
            $resultadoConsulta->execute();//Ejecutamos la consulta

                echo "<table>";
                echo "<tr>";
                    echo "<th> CODIGO DEPARTAMENTO</th>";
                    echo "<th> DESCRIPCION DEPARTAMENTO</th>";
                    echo "<th> FECHA CREACION DEPARTAMENTO</th>";
                    echo "<th> VOLUMEN DEPARTAMENTO </th>";
                echo "</tr>";
                
                $oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                while ($oDepartamento){   
                    echo "<tr>";
                    echo "<td><p>$oDepartamento->T02_CodDepartamento </td>";           
                    echo "<td> $oDepartamento->T02_DescDepartamento </td>";
                    echo "<td> $oDepartamento->T02_FechaCreacionDepartamento </td>";
                    echo "<td> $oDepartamento->T02_VolumenNegocio </td></p>";
                    echo "</tr>";
                    $oDepartamento = $resultadoConsulta->fetchObject();
                }       
                    //Fin de la tabla
                    echo "</table>";
                    echo "<br>";
                    //Mostrar el numero de registros
                    $numeroRegistros=$resultadoConsulta->rowCount();
                    echo "<h2>Número de registros en la tabla Departamento: ".$numeroRegistros."</h2>";
                    
                }catch (PDOException $excepcion){
                    $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                    $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

                    echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
                    echo "<br>";
                    echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
                    echo "<p style='background-color:pink;'>LOS DEPARTAMENTOS PUEDEN ESTAR YA INSERTADOS</p>";
                } finally {
                    unset($miDB);
                }
            ?>
  
    </body>
</html>