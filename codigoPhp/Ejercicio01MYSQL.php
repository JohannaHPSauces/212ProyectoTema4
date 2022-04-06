<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <?php
         /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 01/04/2022
             * Conexión a la base de datos con la cuenta usuario y tratamiento de errores
             */
            echo "<h3> Conexión a la base de datos con la cuenta usuario y tratamiento de errores</h3>";
            
           
            require_once '../config/confDBMySQLi.php';
            
            //Establecer una conexión con la base de datos 
            $miDB = new mysqli();
            $miDB->connect(HOST,USER,PASSWORD,DB);//Conexion con la base de datos
           
            try{    
                
            
            echo"<p style='background-color:lime;'>CONEXION ESTABLECIDA</p>";
               
          
            } catch (Exception $exception) {
                $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error
            
            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";

            }finally{
                $miDB->close(); // Cierra la conexion con la base de datos 
                
            }
                
       
        ?> 
    </body>
</html>
