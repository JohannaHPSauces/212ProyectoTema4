<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 7</title>
        <meta charset="UTF-8">
        <style>
        </style>

    </head>
    <body>
        
       <?php 
        /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 06/04/2022
             * Exportar. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml.
             * CODIGO DE ALBERTO
             */
       
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php';     
        
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $consulta = <<<EOD
                            INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio)
                            VALUES (:CodDepartamento, :DescDepartamento, :FechaCreacionDepartamento, :VolumenNegocio);
                        EOD;
            $resultadoConsulta = $miDB->prepare($consulta);//Preparamos la consulta
           
           
            //Desactiva el modo 'autocommit'. Mientras el modo 'autocommit' esté desactivado, no se consignarán los cambios realizados en la base de datos
            $miDB->beginTransaction();
            
            $archivoJSON= file_get_contents("../tmp/Departamentos.json");//obtener el fichero de la carpeta tmp
            $aDepartamentos= json_decode($archivoJSON);//Descodificar el fichero json
            
            
            //$oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                foreach ($aDepartamentos as $valorDepartamento) {//Recorro el array de departamentos y guardo la informacion de cada uno de los datos del array
                    $resultadoConsulta->bindParam(':CodDepartamento',$valorDepartamento->CodDepartamento);
                    $resultadoConsulta->bindParam(':DescDepartamento',$valorDepartamento->DescDepartamento);
                    $resultadoConsulta->bindParam(':FechaCreacionDepartamento',$valorDepartamento->FechaCreacionDepartamento);
                    $resultadoConsulta->bindParam(':VolumenNegocio',$valorDepartamento->VolumenNegocio);
                    
                    $resultadoConsulta->execute();//Ejecutamos la consulta
                }
            //Hacemos commit para subir los cambios
            $miDB->commit();
            
            //Si todo ha ido bien mostramos un mensaje de exito
            echo "<h3 style='color: green;'>Importacion exitosa </h3>";
        }catch (PDOException $excepcion){
            $miDB->rollBack();//Revierte los cambios si hay algun error
            
            $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
            $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
        }finally {
            unset($miDB);//Cerramos la conexion con la base de datos
        }
?>
    </body>
</html>