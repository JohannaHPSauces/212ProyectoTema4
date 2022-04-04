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
             * Created on: 04/04/2022
             * Exportar. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml.
             */
       
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php';     
        
        try{
            $miDB = new PDO(HOST,USER,PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $consulta = "SELECT * FROM T02_Departamento";
            $resultadoConsulta = $miDB->prepare($consulta);//Preparamos la consulta
            $resultadoConsulta->execute();//Ejecutamos la consulta
           
            //Array que contendra el array de deparatamentos
            $aDepartamentos=[];
            
            $oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                while ($oDepartamento){ 
                    $aDepartamento=[ "CodDepartamento" => $oDepartamento->T02_CodDepartamento,
                                      "DescDepartamento" => $oDepartamento->T02_DescDepartamento,
                                      "VolumenNegocio" => $oDepartamento->T02_VolumenNegocio];
                    array_push($aDepartamentos, $aDepartamento);//sirve para meter erl array de departamentos en otro array
                    $oDepartamento = $resultadoConsulta->fetchObject();
                }
            //Guarda lo del segundo parametro en el primero
            file_put_contents('../tmp/Departamentos.json', json_encode($aDepartamentos));
           
            echo "<p style='color: green;'>Exportación exitosa <p>";
            
        }catch (PDOException $excepcion){
            $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
            $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
            echo "<p style='background-color:pink;'>LOS DEPARTAMENTOS PUEDEN ESTAR YA INSERTADOS</p>";
        }finally {
            unset($miDB);
        }
?>
  
    </body>
</html>