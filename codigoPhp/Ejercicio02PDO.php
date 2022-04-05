<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
        <style>
            table{
                border: 2px white solid;
                background: lightgoldenrodyellow;
            }
            td{
                text-align: center;
                border: 2px black solid;
            }
            th{
                border: 2px black solid;
                background: darkorchid;
            }
        </style>
    </head>
    <body>
        <?php
         /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 01/04/2022
             *  Mostrar el contenido de la tabla Departamento y el número de registros
             */
            echo "<h3> Mostrar el contenido de la tabla Departamento y el número de registros</h3>";   
           
            require_once '../config/confDBPDO.php';
            
            //Establecer una conexión con la base de datos 
        try{    
            $miDB = new PDO(HOST,USER,PASSWORD);//Establecer conexion
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//excepciones
            
            $consulta = "SELECT * FROM T02_Departamento";    //Guardo la consulta en una variable
            $resultadoConsulta = $miDB->prepare($consulta);//Peparar la consulta
            $resultadoConsulta->execute(); //Ejecutar la consulta
            
            //Creacion de tabla
            echo "<h3>Tabla Departamentos </h3>";
            echo "<table>";
                echo "<tr>";
                    echo "<th> CODIGO DEPARTAMENTO</th>";
                    echo "<th> DESCRIPCION DEPARTAMENTO</th>";
                    echo "<th> FECHA CREACION DEPARTAMENTO</th>";
                    echo "<th> VOLUMEN DEPARTAMENTO </th>";
                echo "</tr>";
                
            $oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
            while ($oDepartamento){   
                echo "<tr>";
                echo "<td><p>$oDepartamento->T02_CodDepartamento </td>";           
                echo "<td> $oDepartamento->T02_DescDepartamento </td>";
                echo "<td> $oDepartamento->T02_FechaCreacionDepartamento </td>";
                echo "<td> $oDepartamento->T02_VolumenNegocio </td></p>";
                echo "</tr>";
                $oDepartamento = $resultadoConsulta->fetchObject();
            }       
                //Fin de la tabla
                echo "</table>";
                echo "<br>";
                //Mostrar el numero de registros
                $numeroRegistros=$resultadoConsulta->rowCount();
                echo "<h2>Número de registros en la tabla Departamento: ".$numeroRegistros."</h2>";
                
//////////////////////////////////TABLA USUARIO///////////////////////////////////////////////////////////////////////       
            $consulta = "SELECT * FROM T01_Usuario";    //Guardo la consulta en una variable
            $resultadoConsulta = $miDB->prepare($consulta);//Peparar la consulta
            $resultadoConsulta->execute(); //Ejecutar la consulta
            
            //Creacion de tabla
            echo "<h3>Tabla Usuarios </h3>";
            echo "<table>";
                echo "<tr>";
                    echo "<th> CODIGO USUARIO</th>";
                    echo "<th> DESCRIPCION USUARIO</th>";
                    echo "<th> PASSWORD</th>";
                    echo "<th> NUMERO CONEXIONES</th>";
                    echo "<th> FECHA Y HORA ULTIMA CONEXION</th>";
                    echo "<th> PERFIL</th>";
                echo "</tr>";
                
            $oUsuario = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
            while ($oUsuario){   
                echo "<tr>";
                echo "<td><p>$oUsuario->T01_CodUsuario </td>";           
                echo "<td> $oUsuario->T01_DescUsuario </td>";
                echo "<td> $oUsuario->T01_Password </td>";
                echo "<td> $oUsuario->T01_NumConexiones </td>";
                echo "<td> $oUsuario->T01_FechaHoraUltimaConexion </td>";
                echo "<td><p>$oUsuario->T01_Perfil </td></p>";
                echo "</tr>";
                $oUsuario = $resultadoConsulta->fetchObject();
            }       
                //Fin de la tabla
                echo "</table>";
                echo "<br>";
                //Mostrar el numero de registros
                $numeroRegistros=$resultadoConsulta->rowCount();
                echo "<h2>Número de registros en la tabla Usuario: ".$numeroRegistros."</h2>";
                 
//////////////////////////////////TABLA CUESTION///////////////////////////////////////////////////////////////////////       
            $consulta = "SELECT * FROM T03_Cuestion";    //Guardo la consulta en una variable
            $resultadoConsulta = $miDB->prepare($consulta);//Peparar la consulta
            $resultadoConsulta->execute(); //Ejecutar la consulta
            
            //Creacion de tabla
            echo "<h3>Tabla Cuestion </h3>";
            echo "<table>";
                echo "<tr>";
                    echo "<th> CODIGO CUESTION</th>";
                    echo "<th> DESCRIPCION CUESTION</th>";
                    echo "<th> NUMERO DE ORDEN</th>";
                    echo "<th> TIPO RESPUESTA</th>";
                echo "</tr>";
                
            $oConexion = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
            while ($oConexion){   
                echo "<tr>";
                echo "<td><p>$oConexion->T03_CodCuestion </td>";           
                echo "<td> $oConexion->T03_DescCuestion </td>";
                echo "<td> $oConexion->T03_NumOrden </td>";
                echo "<td><p>$oConexion->T03_TipoRespuesta </td></p>";
                echo "</tr>";
                $oConexion = $resultadoConsulta->fetchObject();
            }       
                //Fin de la tabla
                echo "</table>";
                echo "<br>";
                //Mostrar el numero de registros
                $numeroRegistros=$resultadoConsulta->rowCount();
                echo "<h2>Número de registros en la tabla Cuestion: ".$numeroRegistros."</h2>";
                 
//////////////////////////////////TABLA OPINION///////////////////////////////////////////////////////////////////////       
            $consulta = "SELECT * FROM T04_Opinion";    //Guardo la consulta en una variable
            $resultadoConsulta = $miDB->prepare($consulta);//Peparar la consulta
            $resultadoConsulta->execute(); //Ejecutar la consulta
            
            //Creacion de tabla
            echo "<h3>Tabla Opinion </h3>";
            echo "<table>";
                echo "<tr>";
                    echo "<th> CODIGO USUARIO</th>";
                    echo "<th> CODIGO CUESTION</th>";
                    echo "<th> VALOR OPINION</th>";
                echo "</tr>";
                
            $oOpinion = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
            while ($oOpinion){   
                echo "<tr>";
                echo "<td><p>$oOpinion->T04_CodUsuario </td>";           
                echo "<td> $oOpinion->T04_CodCuestion </td>";
                echo "<td><p>$oOpinion->T04_ValorOpinionTipo1 </td></p>";
                echo "</tr>";
                $oOpinion = $resultadoConsulta->fetchObject();
            }       
                //Fin de la tabla
                echo "</table>";
                echo "<br>";
                //Mostrar el numero de registros
                $numeroRegistros=$resultadoConsulta->rowCount();
                echo "<h2>Número de registros en la tabla Opinion: ".$numeroRegistros."</h2>";
                 
        }catch(PDOException $excepcion){ 
            $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
            $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error
            
            echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
            echo "<br>";
            echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
            
        }finally{
            unset($miDB);//Cerramos conexion
        }
       ?>
        
    </body>
</html>