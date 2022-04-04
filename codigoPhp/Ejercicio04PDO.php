<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 3</title>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
        <style>
            h3{
                font-weight: bold;
            }
            table{
                border: 2px white solid;
                background: lightgoldenrodyellow;
            }
            td{
                text-align: center;
                border: 4px black solid;
            }
            th{
                border: 4px black solid;
                background: yellow;
            }
            fieldset{
                margin:auto;
                width: 320px;height: 210px;
                text-align: center;
                font-size: 20px;
                 font-weight: bold;
                border: 4px solid black;
                color: black;
                position: relative;
            }
            input{
                font-size: 16px;
                border-radius:5px;
            }
            input:nth-of-type(2),input:nth-of-type(3){
                font-size: 20px;
                border-radius:5px;
            }
        </style>

    </head>
    <body>
        
       <?php 
        /*
             * @author: Johanna Herrero Pozuelo
             * Created on: 02/04/2022
             *  Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).
             */
       
        //Importamos la libreria de validacion
        require_once '../core/210322ValidacionFormularios.php'; 
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php'; 
        
        //SI EL USUARIO HA DADO AL BOTON CANCELAR LE DEVUELVE AL INDEX
        if(isset($_REQUEST['volver'])){ 
            header('Location: ../index.php');// le manda a la pagina del programa
            exit;
        }
        //Definicion de variable de entrada
        $entradaOK=true;
        
        //Array para guardar los errores
        $aErrores = ['DescDepartamento' => null];
        
        echo "<h3>*Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).*</h3>";   
        
        //SI SE HA PULSADO EL BOTON DE ENVIAR
        if (isset($_REQUEST['enviar'])) { 
            $aErrores['DescDepartamento']= validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepartamento'], 100, 1, 1);

            $descDepartamento= $_REQUEST['DescDepartamento'];
                foreach($aErrores as $campo =>$error){//Recorro el array de errores buscando si hay
                    if($error ==null){// Si hay algun error 
                        $entradaOk=false; //Ponemos la entrada a false
                        $_REQUEST[$campo]="";//Vacia los campos
                    }
                }
        }else{
            //$entradaOK=false;
            $descDepartamento=null;
        }
        if(!is_null($descDepartamento)){
            $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%".$descDepartamento."%'";
        }else{
            //Mostrado de todas la filas
            $consulta = "SELECT * FROM T02_Departamento";
        }
            if($entradaOK){
                try {  
                    //Establecer una conexión con la base de datos 
                    $miDB = new PDO(HOST,USER,PASSWORD);                            
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

                    //Preparamos la consulta
                    $resultadoConsulta = $miDB->prepare($consulta); 
                    //Ejecutamos la consulta
                    $resultadoConsulta->execute();

                        //Tanto si ha encontrado el departamento como si no se ha encontrado, mostramos la tabla
                        if($resultadoConsulta->rowCount()>=0){
                            echo "<table>";
                            echo "<tr>";
                                echo "<th> CODIGO DEPARTAMENTO</th>";
                                echo "<th> DESCRIPCION DEPARTAMENTO</th>";
                                echo "<th> VOLUMEN DEPARTAMENTO </th>";
                            echo "</tr>";

                            $oDepartamento = $resultadoConsulta->fetchObject();  //obtiene la siguiente fila y la devuelve como objeto. 
                            while ($oDepartamento){   
                                echo "<tr>";
                                echo "<td><p>$oDepartamento->T02_CodDepartamento </td>";           
                                echo "<td> $oDepartamento->T02_DescDepartamento </td>";
                                echo "<td> $oDepartamento->T02_VolumenNegocio </td></p>";
                                echo "</tr>";
                                $oDepartamento = $resultadoConsulta->fetchObject();
                            } 
                        }
                    }catch (PDOException $excepcion){
                        $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                        $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

                        echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
                        echo "<br>";
                        echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
                    }finally {
                        //Cerramos conexion
                        unset($miDB);
                    }
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                        <h3>BUSCAR DEPARTAMENTO</h3>
                        <label>Descripción Departamento </label>
                        <input type = "text" name = "DescDepartamento" value="<?php echo(isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : null); ?>"> <br><?php echo($aErrores['DescDepartamento']!=null ? "<span style='color:red'>".$aErrores['DescDepartamento']."</span>" : null); ?>
                        <br><br>

                        <input type="submit" name="enviar" value="Buscar">
                        <input type="submit" value="Volver" name="volver">
                </fieldset>
            </form>
  
    </body>
</html>