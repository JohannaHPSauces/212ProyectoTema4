    /*
    * @author: Johanna Herrero Pozuelo
    * Created on: 01/04/2022
    * Script carga de base de datos y usuario
    */
/*Usar base de datos*/
USE DB212DWESProyectoTema4;

-- Insertar datos en la tabla Departamento de la base de datos DAW207DBDepartamentos
INSERT INTO T01_Usuario(T01_CodUsuario, T01_Password, T01_DescUsuario) VALUES
    ('albertoF',SHA2('albertoFpaso',256),'AlbertoF'),
    ('outmane',SHA2('outmanepaso',256),'Outmane'),
    ('rodrigo',SHA2('rodrigopaso',256),'Rodrigo'),
    ('isabel',SHA2('isabelpaso',256),'Isabel'),
    ('david',SHA2('davidpaso',256),'David'),
    ('aroa',SHA2('aroapaso',256),'Aroa'),
    ('johanna',SHA2('johannapaso',256),'Johanna'),
    ('oscar',SHA2('oscarpaso',256),'Oscar'),
    ('sonia',SHA2('soniapaso',256),'Sonia'),
    ('heraclio',SHA2('heracliopaso',256),'Heraclio'),
    ('amor',SHA2('amorpaso',256),'Amor'),
    ('antonio',SHA2('antoniopaso',256),'Antonio'),
    ('albertoB',SHA2('albertoBpaso',256),'AlbertoB');

-- Usuario administrador con el rol de administrador
INSERT INTO T01_Usuario(T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil) VALUES
    ('admin',SHA2('adminpaso',256),'Admin','administrador');

-- Insertar datos en la tabla T02_Departamento de la base de datos DB207DWESProyectoTema5
-- 1637700241 = 23-noviembre-2021 21:44:00
INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio) VALUES
    ('INF','Departamento de Informatica',1637700241,1.5),
    ('BIO','Departamento de Biologia',1637700241,2.5),
    ('ING','Departamento de Inglés',1637700241,3.5),
    ('LEN','Departamento de Lengua',1637700241,4.5),
    ('MUS','Departamento de Musica',1637700241,1.5);

INSERT INTO T03_Cuestion ( T03_CodCuestion, T03_DescCuestion, T03_NumOrden) VALUES
    ('001','¿Te gusta la informatica?',1),
    ('002','¿Te gusta viajar?',2),
    ('003','¿Tienes hermanos o hermanas?',3);

INSERT INTO T04_Opinion ( T04_CodUsuario, T04_CodCuestion, T04_ValorOpinionTipo1) VALUES
    ('david','002','si'),
    ('sonia','001','no'),
    ('johanna','003','no');

