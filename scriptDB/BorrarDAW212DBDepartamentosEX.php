<?php

require_once '../config/confDBPDO.php';

try{
    
    $DB212DWESProyectoTema4= new PDO(HOST, USER, PASSWORD);
    // Establecer los atributos
        $DB212DWESProyectoTema4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Consulta para realizar la insercion de los datos a partir del archivo xml
        $consulta = <<<CONSULTA
                        SET FOREIGN_KEY_CHECKS=0; DROP TABLE dbs4868809.T03_Cuestion; DROP TABLE dbs4868809.T04_Opinion; SET FOREIGN_KEY_CHECKS=1;
                        DROP TABLE IF EXISTS dbs4868809.T01_Usuario;
                        DROP TABLE IF EXISTS dbs4868809.T02_Departamento;
                    CONSULTA;

        $DB212DWESProyectoTema4->exec($consulta); //Ejecuto la consulta

        echo"<p style='background-color:lime;'>CONEXION ESTABLECIDA</p>";
        echo"<p style='background-color:lime;'>BORRADO EXITOSO</p>";
        
    }catch (PDOException $excepcion) {//Codigo que se ejecuta si hay algun error
        $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
        $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

        echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
        echo "<br>";
        echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";

    } finally {
        //Cierro la conexion
        unset($DB212DWESProyectoTema4);
    }
?>