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
            $aDepartamentos= json_decode($archivoJSON);//Descdificar el json
            
            
            //$oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                foreach ($aDepartamentos as $valorDepartamento) {//Recorro el array de departamentos
                    $resultadoConsulta->bindParam(':CodDepartamento', $valorDepartamento->  T02_CodDepartamento);
                    $resultadoConsulta->bindParam(':DescDepartamento', $valorDepartamento->T02_DescDepartamento);
                    $resultadoConsulta->bindParam(':FechaCreacionDepartamento', $valorDepartamento->T02_FechaCreacionDepartamento);
                    $resultadoConsulta->bindParam(':VolumenNegocio', $valorDepartamento->T02_VolumenNegocio);
                    
                    $resultadoConsulta->execute();//Ejecutamos la consulta
                }
                var_dump($resultadoConsulta);
            //Hacemos commit para subir los cambios
            $miDB->commit();
           
            echo "<h3 style='color: green;'>Exportación exitosa </h3>";
        }catch (PDOException $excepcion){
            $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
            $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
        }finally {
            unset($miDB);
        }
?>
  
    </body>
</html>