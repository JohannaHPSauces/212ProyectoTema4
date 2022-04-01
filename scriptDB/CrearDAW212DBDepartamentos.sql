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
CREATE TABLE IF NOT EXISTS DB212DWESProyectoTema4.Departamento(
    CodDepartamento varchar(3) PRIMARY KEY,
    DescDepartamento varchar(255) NOT NULL,
    FechaBaja date NULL,
    VolumenNegocio float NULL
)engine=innodb;

-- Crear usuario
CREATE USER 'User212DWESProyectoTema42'@'%' IDENTIFIED BY 'P@ssw0rd';

-- Dar permisos al usuario
GRANT ALL PRIVILEGES ON DB212DWESProyectoTema4.* TO 'User212DWESProyectoTema42'@'%';
