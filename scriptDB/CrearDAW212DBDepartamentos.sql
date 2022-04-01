    /*
    * @author: Johanna Herrero Pozuelo
    * Created on: 01/04/2022
    * Script creacion de base de datos y usuario
    */

-- Crear base de datos Departamentos
CREATE DATABASE IF NOT EXISTS DB212DWESProyectoTema4;

-- Usar base de datos Departamentos
USE DB212DWESProyectoTema4;

-- CREAR Tabla Departamento dentro de la base de datos DAW207DBDepartamentos

CREATE TABLE IF NOT EXISTS DB212DWESProyectoTema4.T01_Usuario(
    T01_CodUsuario varchar(20) PRIMARY KEY,
    T01_Password varchar(64) NOT NULL,
    T01_DescUsuario varchar(255) NOT NULL,
    T01_NumConexiones int DEFAULT 0,
    T01_FechaHoraUltimaConexion int,
    T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario',
    T01_ImagenUsuario mediumblob NULL
)engine=innodb;

CREATE TABLE IF NOT EXISTS DB212DWESProyectoTema4.T02_Departamento(
    T02_CodDepartamento varchar(3) PRIMARY KEY,
    T02_DescDepartamento varchar(255) NOT NULL,
    T02_FechaCreacionDepartamento int NOT NULL,
    T02_VolumenNegocio float NULL,
    T02_FechaBajaDepartamento int NULL
)engine=innodb;

CREATE TABLE IF NOT EXISTS DB212DWESProyectoTema4.T03_Cuestion(
    T03_CodCuestion varchar(3) PRIMARY KEY,
    T03_DescCuestion varchar(500) NOT NULL,
    T03_NumOrden int,
    T03_TipoRespuesta enum('si','no') DEFAULT 'no'
)engine=innodb;

CREATE TABLE IF NOT EXISTS DB212DWESProyectoTema4.T04_Opinion(
    T04_CodUsuario varchar(20),
    T04_CodCuestion varchar(3),
    T04_ValorOpinionTipo1 varchar(3) NOT NULL,
    PRIMARY KEY(T04_CodUsuario, T04_CodCuestion),
    FOREIGN KEY (T04_CodUsuario) REFERENCES T01_Usuario(T01_CodUsuario),
    FOREIGN KEY (T04_CodCuestion) REFERENCES T03_Cuestion(T03_CodCuestion)
)engine=innodb;


-- Crear usuario
CREATE USER 'User212DWESProyectoTema42'@'%' IDENTIFIED BY 'P@ssw0rd';

-- Dar permisos al usuario
GRANT ALL PRIVILEGES ON DB212DWESProyectoTema4.* TO 'User212DWESProyectoTema42'@'%';
