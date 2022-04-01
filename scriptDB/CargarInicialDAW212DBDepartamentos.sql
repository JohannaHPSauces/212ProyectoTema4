    /*
    * @author: Johanna Herrero Pozuelo
    * Created on: 01/04/2022
    * Script carga de base de datos y usuario
    */
/*Usar base de datos*/
USE DB212DWESProyectoTema4;

-- Insertar datos en la tabla Departamento de la base de datos DAW207DBDepartamentos
INSERT INTO Departamento (CodDepartamento, DescDepartamento, FechaBaja, VolumenNegocio) VALUES
    ('INF', 'Departamento de informatica',null,1),
    ('MAT', 'Departamento de matematicas',null,2),
    ('LEN', 'Departamento de lengua',null,3),
    ('MEC', 'Departamento de mecanica',null,4);