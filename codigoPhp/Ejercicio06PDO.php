<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 6</title>
        <meta charset="UTF-8">
        <style>
        </style>

    </head>
    <body>
        
       <?php 
        /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 02/04/2022
             * Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada
             */
       
        //Importamos la libreria de validacion
        require_once '../core/210322ValidacionFormularios.php'; 
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php';     
        
        $aDepartamentos = [["T02_CodDepartamento" => "PRO", "T02_DescDepartamento" => "Departamento de programacion", "T02_VolumenNegocio" => 12],
                            ["T02_CodDepartamento" => "PLA", "T02_DescDepartamento" => "Departamento de plastica", "T02_VolumenNegocio" => 20],
                            ["T02_CodDepartamento" => "MUS", "T02_DescDepartamento" => "Departamento de musica", "T02_VolumenNegocio" => 13]];
                
        echo "<h3>*Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada*</h3>";   
        //Departamentos a insertar
        
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Desactiva el modo 'autocommit'. Mientras el modo 'autocommit' esté desactivado, no se consignarán los cambios realizados en la base de datos
            $miDB->beginTransaction();
            $consultaB3=$miDB->prepare("DELETE FROM T02_Departamento WHERE T02_CodDepartamento='ODO'");
            
            $consulta = <<<EOD
                        INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenNegocio) VALUES 
                        (:CodDepartamento, :DescDepartamento, :VolumenNegocio);
                    EOD;
            //Preparamos la consulta
            $resultadoConsulta = $miDB ->prepare($consulta);
                
           
            //Recorremos los registros que vamos a insertar    
            foreach($aDepartamentos as $departamento){
                    $parametros = [":CodDepartamento" => $departamento["T02_CodDepartamento"], 
                                   ":DescDepartamento" => $departamento["T02_DescDepartamento"], 
                                   ":VolumenNegocio" => $departamento["T02_VolumenNegocio"]];
                    $resultadoConsulta->execute($parametros);//Ejecutamos la consulta
            }
            
            //Haceos commit para subir los cambios
            $miDB->commit();
            
            //Mensaje de todo correcto
            echo "<p style='background-color:lime;'>DEPARTAMENTOS INSERTADOS CORRECTAMENTE</p>";
                
            //consulta mostrar la tabla con los inserts hechos
            $consulta = "SELECT * FROM Departamento"; 
            $resultadoConsulta = $miDB->prepare($consulta); 
            $resultadoConsulta->execute();//Ejecutamos la consulta

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