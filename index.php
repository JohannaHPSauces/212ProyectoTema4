<!DOCTYPE html>

<html>
    <head>
        <title>Johanna Herrero Pozuelo</title>
        <meta charset="UTF-8">
        <style>
	@import url('http://fonts.cdnfonts.com/css/04b30');
	@import url('http://www.fontsaddict.com/fontface/mario-kart-ds-regular.ttf');
			/* 
				Author     : johanna Herrero Pozuelo
				
			*/
			
body{
	font-family:OCR A Std, monospace;
	/*background-image: url(images/retro4.jpg); */
     /* background-image: url("https://acegif.com/wp-content/gif/snwflks-5.gif"); */
	background-repeat:no-repeat;
	background-color:rgb(215, 185, 250);
        background-size: cover;
	
}
/* caja titulo */
h2{ 
	font-family: '04b', sans-serif;
	text-shadow: black 0.1em 0.1em 0.2em;
	text-align:center;
	padding:10px;
	color:crimson;
	background-color:blueviolet;
	margin-top:0%;
	border: 8px dotted blue;
}
h2:nth-of-type(2){
        font-size: 18px;
        width: 140px;height: 20px;
        border: none;
        border-radius: 50%;
}
h2:nth-of-type(2) a{
    text-decoration: none;
    color:red;
}
/*caja debajo de titulo*/
			
.ver, .play{
    margin-left:25px;
    display: inline-block;
}

table {
	margin: 4rem auto;
	table-layout: fixed;
	width: 80%;
	height:100px;
	color:white;
	border-collapse: collapse;
	border: 4px solid black;
	text-align:left;
	padding:2px;
        font-weight: bold;
}
td{
        background: darkorchid;
	text-align:left;
        font-weight: bold;
	border: 4px solid black;width:90px;
}
th{
        background: darkorchid;
        border: 4px solid black;
}
footer{
       background: blueviolet;
       border-radius: 5px 5px 5px 5px;
       font-weight: bold;
       position: fixed;
       bottom: -1px;
       width: 100%;
       height: 60px;
       color: black;
       text-align: center;
       padding: 2px;
       vertical-align: middle;
}
a img{
        display: flex;
	margin:auto;
	width:35px;
	height:35px;
}
strong{
        font-size: 20px;
}
strong a{
        color:black;
        text-decoration: none;
}
strong a:hover{
        color:blue;
}
.t2{
        margin-top: 40px;
        background: darkblue;
        text-align: center;
        font-size: 32px;
}
.t2:hover{
    background:green;
    color: fuchsia;
}
#especial{
    color:yellow;
    font-size: 20px;
}
.t2{
    margin-top: 40px;
    background: darkblue;
    text-align: center;
    font-size: 32px;
}
.t2 a{
    text-decoration: none;
    color: white;
}
.t2:hover{
    background:green;
    color: fuchsia;
}
		</style>
    </head>
    <body>
        <header>
            <h2>PROYECTO TEMA4 </h2> 
            <h2><a href="../212ProyectoDWES/indexProyectoDWES.php" >VOLVER</a></h2>
	<div class="caja1"></div>
	</header> 
        <main>
		<table class="t1">
                <tr>
                    <th> Crear BD Desarrollo<a href="mostrarCodigo/mostrarSCreacion.php" ><img src="../images/codigo.png" class="ver" width="40" height="40"></a></th>
                    <th>Cargar Desarrollo<a href="mostrarCodigo/mostrarSCarga.php"><img src="../images/codigo.png" class="ver" width="40" height="40"></a></th>
                    <th>Borrar Desarrollo<a href="mostrarCodigo/mostrarSBorrado.php"><img src="../images/codigo.png" class="ver" width="40" height="40"></a></th>
                </tr>
                <tr>
                    <th>Crear BD Explotacion<a href=""><img src="../images/ver.png" class="ver" width="40" height="40"></a><a href="" ><img src="../images/codigo.png" class="play" width="30" height="30" ></td></th>
                    <th>Cargar Explotacion<a href=""><img src="../images/ver.png" class="ver" width="40" height="40"></a><a href=""><img src="../images/codigo.png" class="play" width="30" height="30" ></td></th>
                    <th>Borrar Explotacion<a href=""><img src="../images/ver.png" class="ver" width="40" height="40"></a><a href=""><img src="../images/codigo.png" class="play" width="30" height="30" ></td></th>
                    
                </tr>
            </table>
		<table class="default">
                    <tr class="c1">
                      
			<th class="p1">Configuracion<a href="mostrarCodigo/mostrarConf.php" ><img src="../images/codigo.png" class="ver" width="40" height="40"></a></th>
                        <td>PDO</td>
                        <td>Ver codigo PDO </td>
                        <td>MYSQL</td>
			<td>Ver codigo MYSQL</td>
                    </tr>
		  <tr class="c1">
			<th class="p1">1. Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</th>
                        <td><a href="codigoPhp/Ejercicio01PDO.php"  >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
                        <td><a href="mostrarCodigo/mostrar01PDO.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
                        <td><a href="codigoPhp/Ejercicio01MYSQL.php"  >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
                        <td><a href="mostrarCodigo/mostrar01MYSQL.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<th>2. Mostrar el contenido de la tabla Departamento y el número de registros.</th>
                        <td><a  href="codigoPhp/Ejercicio02PDO.php" >
                            <img src="../images/ver.png" class="ver" width="40" height="40" ></td>
                        <td><a href="mostrarCodigo/mostrar02PDO.php" >
                            <img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<th>3. Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</th>
                        <td><a  href="codigoPhp/Ejercicio03PDO.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a href="mostrarCodigo/mostrar03PDO.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<td>4. Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).</td>
                        <td><a  href="codigoPhp/Ejercicio04PDO.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a href="mostrarCodigo/mostrar04PDO.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<td>5. Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
</td>			<td><a  href="codigoPhp/Ejercicio05PDO.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a href="mostrarCodigo/mostrar05PDO.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<td>6. Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada</td>
			<td><a  href="codigoPhp/Ejercicio06PDO.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a href="mostrarCodigo/mostrar06PDO.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		  <tr>
			<td>7. Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el
directorio .../tmp/ del servidor.</td>
			<td><a  href="codigoPHP/E6.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a  href="">
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		   <tr>
			<td>8. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
fichero departamento.xml. </td>
                        <td><a  href="codigoPhp/Ejercicio08PDOJson.php" >
			<img src="../images/ver.png" class="ver" width="40" height="40" ></td>
			<td><a href="mostrarCodigo/mostrar08PDOJson.php" >
			<img src="../images/codigo.png" class="play" width="30" height="30" ></td>
		  </tr>
		</table>
                <table class="t2">
                        <tr>
                            <th><a href="../212MtoDepartamentosTema4/codigoPhp/mtoDepartamentos.php">MANTENIMIENTO DEPARTAMENTOS TEMA4</a></th>
                            <!--<th><a href="../LoginLogoffTema5/codigoPHP/LogIn.php">APLICACIÓN TEMA5</a></th>-->
                        </tr>
                </table>
        </main>
         <footer>
        2021-2022 I.E.S. Los sauces. ©Todos los derechos reservados. <strong> <a href="http://daw212.sauces.local/">Johanna Herrero Pozuelo</a></strong>
            <a href="https://github.com/JohannaHPSauces/212ProyectoTema3" target="blank"><img src="../images/git.png" alt="" class="git"></a>
        </footer>	
    </body>
</html>
