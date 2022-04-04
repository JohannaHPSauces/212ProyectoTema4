<!Doctype HTML>
<html>
    <head>
        <title>Ejercicio 3</title>
        <meta charset="UTF-8">
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
                border: 2px black solid;
            }
            th{
                border: 2px black solid;
                background: darkorchid;
            }
            fieldset{
                margin:auto;
                width: 580px;height: 440px;
                border: 4px black solid;
                font-weight: bold;
                text-align: center;
                font-size: 20px;
                color: black;
                position: relative;
            }
            input{
                 font-size: 16px;
                border-radius:5px;
            }
            input:nth-of-type(4), input:nth-of-type(5){
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
             * Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.
             */
       
        //Importamos la libreria de validacion
        require_once '../core/210322ValidacionFormularios.php'; 
        //Importamos la configuracion a la base de datos
        require_once '../config/confDBPDO.php';     
        
        if(isset($_REQUEST['volver'])){ //Si el usuario pulsa cancelar
            header('Location: ../index.php');// le manda a la pagina del programa
            exit;
        }
        
        echo "<h3>*Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.*</h3>";   
        
        $entradaOK = true;                                     
        
        //Array para los errores
        $aErrores = [  'CodDepartamento' => null,               
                       'DescDepartamento' => null,
                       'VolumenNegocio' => null];
        
         //Array para respuestas del formulario
        $aRespuestas = [ 'CodDepartamento' => null,            
                         'DescDepartamento' => null,
                        'VolumenNegocio' => null];
        
         //SI SE HA PULSADO EL BOTON DE EVIAR
        if (isset($_REQUEST['enviar'])) {
            //Validamos las respuuestas con ayuda de la libreria de validacion
            $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, 1); 
            $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepartamento'], 255, 1, 1); 
            $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], PHP_FLOAT_MAX, PHP_FLOAT_MIN, 1);
             
            //Comprobamos que el codigo de departamento no se encuentre en la base de datos
            try{
                    $miDB = new PDO(HOST,USER,PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT T02_CodDepartamento from T02_Departamento where T02_CodDepartamento='{$_REQUEST['CodDepartamento']}'";
                    $consulta = $miDB->prepare($sql);//Preparamos la consulta
                    $consulta->execute();//Ejecutamos la consulta
                    
                    //Si el código de departamento ya existe
                    if($consulta->rowCount()>0){
                        $aErrores['CodDepartamento'] = "Uyy!! ese codigo departamento ya existe";//Añadimos un mensaje de error al array de errores
                    }
            }catch(PDOException $excepcion){ 
                    $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                    $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

                    echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
                    echo "<br>";
                    echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
            }
            
            //Recorremos el array de errores
            foreach($aErrores  as $campo => $error){
                    if ($error != null) { // Comprobamos que el campo no esté vacio
                        $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario      
                        $_REQUEST[$campo] = "";
                    }
            }
        }else{
             //SI HA HABIDO ALGUN ERROR ENTRADA LA PONEMOS A FALSE Y MOSTRAMOS EL FORMULARIO
            $entradaOK = false;
        }
        //SI TODO HA IDO BIEN, RECOGEMOS LAS RESPUESTAS
        if($entradaOK) {    
            //Guardamos las respuestas
            $aRespuestas['CodDepartamento'] = strtoupper($_REQUEST['CodDepartamento']); //strtoupper devuelve el string con todos los caracteres alfabéticos convertidos a mayúsculas.
            $aRespuestas['DescDepartamento'] =$_REQUEST['DescDepartamento'];
            $aRespuestas['VolumenNegocio'] = $_REQUEST['VolumenNegocio'];
            
            try {
                //Establecer una conexión con la base de datos 
                $miDB = new PDO(HOST,USER,PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //consulta para insertar el nuevo departamento
                $sql = <<<EOD
                       INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenNegocio)  
                            VALUES (:CodDepartamento, :DescDepartamento, :VolumenNegocio); 
EOD;
                $consulta = $miDB->prepare($sql);//Preparamos la consulta
                $parametros = [ ":CodDepartamento" => $aRespuestas['CodDepartamento'],
                                ":DescDepartamento" => $aRespuestas['DescDepartamento'],
                                ":VolumenNegocio" => $aRespuestas['VolumenNegocio'] ];
                    
                $consulta->execute($parametros);//Pasamos los parámetros a la consulta
                echo "<p style='background-color:lime;'>CAMPO AÑADIDO CORRECTAMENTE</p>";
                
                //consulta mostrar la tabla con el nuevo departamento
                $consulta = "SELECT * FROM T02_Departamento";    //Guardo la consulta en una variable
                $resultadoConsulta = $miDB->prepare($consulta);//Peparar la consulta
                $resultadoConsulta->execute(); //Ejecutar la consulta

                //Creacion de tabla
                echo "<h3>Tabla Departamentos </h3>";
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
                    //Fin de la tabla
                    echo "</table>";
                    echo "<br>";
                    //Mostrar el numero de registros
                    $numeroRegistros=$resultadoConsulta->rowCount();
                    echo "<h2>Número de registros en la tabla Departamento: ".$numeroRegistros."</h2>"; 

                }catch (PDOException $excepcion){
                    $codigoError=$excepcion->getCode();//Obtenemos y guardamos el codigo del error
                    $mensajeError=$excepcion->getMessage();//Obtenemos y guardamos el mensaje de error

                    echo "<p style='background-color:red;'>Codigo de error: $codigoError</p>";   
                    echo "<br>";
                    echo "<p style='background-color:red;'>Mensaje de error: $mensajeError </p>";
                } finally {
                    unset($miDB);
                }
        } else {  //SI EL FORMULARIO NO ESTA BIEN MOSTRAMOS EL FORMULARIO OTRA VEZ
            
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <h3>DATOS DEL NUEVO DEPARTAMENTO</h3>
                        <label>Código:</label><br>
                        <input type = "text" name = "CodDepartamento" value="<?php echo(isset($_REQUEST['CodDepartamento']) ? $_REQUEST['CodDepartamento'] : null); ?>"><br> <?php echo($aErrores['CodDepartamento']!=null ? "<span style='color:red'>".$aErrores['CodDepartamento']."</span>" : null); ?>
                        <br><br>

                        <label>Descripción:</label><br>
                        <input type = "text" name = "DescDepartamento" value="<?php echo(isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : null); ?>"><br> <?php echo($aErrores['DescDepartamento']!=null ? "<span style='color:red'>".$aErrores['DescDepartamento']."</span>" : null); ?>
                        <br><br>

                        <label>Volumen:</label><br>
                        <input type = "text" name = "VolumenNegocio" value="<?php echo(isset($_REQUEST['VolumenNegocio']) ? $_REQUEST['VolumenNegocio'] : null); ?>"><br> <?php echo($aErrores['VolumenNegocio']!=null ? "<span style='color:red'>".$aErrores['VolumenNegocio']."</span>" : null); ?>
                        <br><br>

                        <input type="submit" name="enviar" value="Insertar">
                        <input type="submit" value="Volver" name="volver">
                    </fieldset>
            </form>
        <?php } ?>  
  
    </body>
</html>