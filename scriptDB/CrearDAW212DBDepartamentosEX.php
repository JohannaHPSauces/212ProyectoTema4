<?php

require_once '../config/confDBPDO.php';

try{
    
    $DB212DWESProyectoTema4= new PDO(HOST, USER, PASSWORD);
    // Establecer los atributos
        $DB212DWESProyectoTema4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Consulta para realizar la insercion de los datos a partir del archivo xml
        $consulta = <<<CONSULTA
                        USE dbs4868809;
                
                        CREATE TABLE IF NOT EXISTS T01_Usuario(
                            T01_CodUsuario varchar(20) PRIMARY KEY,
                            T01_Password varchar(64) NOT NULL,
                            T01_DescUsuario varchar(255) NOT NULL,
                            T01_NumConexiones int DEFAULT 0,
                            T01_FechaHoraUltimaConexion int,
                            T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario',
                            T01_ImagenUsuario mediumblob NULL
                        )engine=innodb;

                        CREATE TABLE IF NOT EXISTS T02_Departamento(
                            T02_CodDepartamento varchar(3) PRIMARY KEY,
                            T02_DescDepartamento varchar(255) NOT NULL,
                            T02_FechaCreacionDepartamento INT NOT NULL,
                            T02_VolumenNegocio float NOT NULL,
                            T02_FechaBajaDepartamento int NULL
                        )engine=innodb;
                
                        CREATE TABLE IF NOT EXISTS T03_Cuestion(
                            T03_CodCuestion varchar(3) PRIMARY KEY,
                            T03_DescCuestion varchar(500) NOT NULL,
                            T03_NumOrden int,
                            T03_TipoRespuesta enum('si','no') DEFAULT 'no'
                        )engine=innodb;
                
                        CREATE TABLE IF NOT EXISTS T04_Opinion(
                            T04_CodUsuario varchar(20),
                            T04_CodCuestion varchar(3),
                            T04_ValorOpinionTipo1 varchar(3) NOT NULL,
                            PRIMARY KEY(T04_CodUsuario, T04_CodCuestion),
                            FOREIGN KEY (T04_CodUsuario) REFERENCES T01_Usuario(T01_CodUsuario),
                            FOREIGN KEY (T04_CodCuestion) REFERENCES T03_Cuestion(T03_CodCuestion)
                        )engine=innodb;
                    CONSULTA;

        $DB212DWESProyectoTema4->exec($consulta); //Ejecuto la consulta

        echo"<p style='background-color:lime;'>CONEXION ESTABLECIDA</p>";
        echo"<p style='background-color:lime;'>CREACION EXITOSA</p>";
        
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