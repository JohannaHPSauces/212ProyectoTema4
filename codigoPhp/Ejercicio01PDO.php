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
             * Conexión a la base de datos PDO con la cuenta usuario y tratamiento de errores
             */
            echo "<h3>  Conexión a la base de datos PDO con la cuenta usuario y tratamiento de errores</h3>";
            
           
            require_once '../config/confDBPDO.php';
            
            //Establecer una conexión con la base de datos 
            $miDB = new PDO(HOST,USER,PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        try {
            $aAtributos=[
                        "AUTOCOMMIT",
                        "CASE",
                        "CLIENT_VERSION",
                        "CONNECTION_STATUS",
                        "DRIVER_NAME",
                        "ERRMODE",
                        "ORACLE_NULLS",
                        "PERSISTENT",
                        "SERVER_INFO",
                        "SERVER_VERSION",
                        "CLIENT_VERSION",
                        "ERRMODE",
                        ];
        
            foreach( $aAtributos as $resultado){//Recorremos el array de atributos
                echo "<strong> PDO::ATTR_$resultado </strong>";//Enucuiamos el atributo que vamos a mostrar
                echo $miDB->getAttribute(constant("PDO::ATTR_$resultado"))."<br>";//Lo mostramos
            }
        
            echo "<p style='background-color: lime;'> SE HA ESTABLECIDO LA CONEXION </p><br>";  //Si no ha habido ningun error se muestra la conexion establecida
        
        
        } 
        catch(PDOException $excepcion) {     //Pero se no se ha podido ejecutar saltara la excepcion
            $codigoError = $excepcion->getCode();      //guardamos en la variable error el error que salta
            $mensajeError = $excepcion->getMessage(); //guardamos en la variable mensaje el mensaje del error que salta

            echo "Codigo de error: ".$codigoError;        //Mostramos el error
            echo "<p style='background-color: coral;'>SMensaje de error:". $mensajeError; //Mostramos el mensaje de error
        
        }finally{//Para finalizar cerramos la base de datos
            unset($miDB);
        }
        
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        echo "<br>";
        echo "<br>";
        
        
        
        
        
        
        
        
        echo "<h1>------CONEXIÓN ERRONEA------</h1>";
        
        try {
           
            //Establecer una conexión con la base de datos 
            $miDB = new PDO(HOST,USER,'PASSWORD');
            //La clase PDO permite definir la fórmula que usará cuando se produzca un error, utilizando el atributo PDO::ATTR_ERRMODE
            //Le ponemos de parametro - > PDO::ERRMODE_EXCEPTION. Cuando se produce un error lanza una excepción utilizando el manejador propio PDOException.
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Creamos el array con los posibles atributos de PDO   
            $aAtributos=[
                    "AUTOCOMMIT",
                    "CASE",
                    "CLIENT_VERSION",
                    "CONNECTION_STATUS",
                    "DRIVER_NAME",
                    "ERRMODE",
                    "ORACLE_NULLS",
                    "PERSISTENT",
                    "SERVER_INFO",
                    "SERVER_VERSION",
                    "CLIENT_VERSION",
                    "TIMEOUT",
                    "ERRMODE",
            ];
        
            foreach( $aAtributos as $resultado){
                echo "<strong> PDO::ATTR_$resultado </strong>";
                echo $miDB->getAttribute(constant("PDO::ATTR_$resultado"))."<br>";
            }
        
            echo "<p style='background-color:lime;'> SE HA ESTABLECIDO LA CONEXION </p>";
        
        
        } 
        catch(PDOException $excepcion) {     //Pero se no se ha podido ejecutar saltara la excepcion
            $codigoError = $excepcion->getCode();      //guardamos en la variable error el error que salta
            $mensajeError = $excepcion->getMessage(); //guardamos en la variable mensaje el mensaje del error que salta

            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";        //Mostramos el error
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>"; //Mostramos el mensaje de error
        
        }finally{
            unset($miDB);//Cerrar conexion
        }   
       ?>
        
    </body>
</html>