<?php

	header('Content-Type: text/html; charset=UTF-8'); //para poder visualizar los caracteres especiales

	//set_time_limit(3000);

	/*
	r
	Abre el archivo sólo para lectura. La lectura comienza al inicio del archivo.
	r+
	Abre el archivo para lectura y escritura. La lectura o escritura comienza al inicio del archivo.
	w
	Abre el archivo sólo para escritura. La escritura comienza al inicio del archivo, y elimina el contenido previo. Si el archivo no existe, intenta crearlo.
	w+
	Abre el archivo para escritura y lectura. La lectura o escritura comienza al inicio del archivo, y elimina el contenido previo. Si el archivo no existe, intenta crearlo.
	a
	Abre el archivo para sólo escritura. La escritura comenzará al final del archivo, sin afectar al contenido previo. Si el fichero no existe se intenta crear.
	a+
	Abre el archivo para lectura y escritura. La lectura o escritura comenzará al final del fichero, sin afectar al contenido previo. Si el fichero no existe se intenta crear.
	*/
	$fp = fopen("SGD280RPED20150930NI0008915002692N01.txt", "r");
	if (!$fp)
	{
		echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.';
		exit;
	}


	$cont = 0; // contador de líneas
	$error = false;
	while (!feof($fp))
	{ // contador hasta que se llegue al final del archivo
		$line = fgets($fp); // guardamos toda la línea en $line como un string
		// dividimos $line en sus celdas, separadas por el caracter |
		// e incorporamos la línea a la matriz $field
		$datos[$cont] = explode ('|', $line);
		$cont++;
		$fp++; // necesitamos llevar el puntero del archivo a la siguiente línea
	}
	$filas = count($datos)-1; //Se utiliza el método count para contar las filas y se resta 1 porque cuenta la fila siguiente al final del archivo
	$columnas = count($datos[0]);// Se utiliza el método count y se le pasa el parámetro 0(cero) para cuente las columnas

	//echo $filas;
	//echo $columnas;
	for($i=0;$i<$filas;$i++) //for para revisar el tipo de registro o la columna 0
	{
		//echo $datos[$i][$j]."|";
		if($datos[$i][0]!=2)
		{
			echo "Revisar el tipo de registro del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el consecutivo o la columna 1
	{
		if($datos[$i][1]!=($i+1))
		{
			echo "Revisar el consecutivo del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el código de habilitación o la columna 2
	{
		if($datos[$i][2]!=196980002601 && $datos[$i][2]!=196980001601 && $datos[$i][2]!=99)
		{
			echo "Revisar el código de habilitación del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el tipo de documento o la columna 3
	{
		if($datos[$i][3]!="RC" && $datos[$i][3]!="TI" && $datos[$i][3]!="CC" && $datos[$i][3]!="PA" && $datos[$i][3]!="MS" && $datos[$i][3]!="AS" && $datos[$i][3]!="NV")
		{
			echo "Revisar el tipo de documento del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	//for para revisar el documento o la columna 4

	for($i=0;$i<$filas;$i++) //for para revisar el primer apellido o la columna 5
	{
		if($datos[$i][5]=="")
		{
			echo "Debe ingresar el primer apellido del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el segundo apellido o la columna 6
	{
		if($datos[$i][6]=="")
		{
			echo "Debe ingresar el segundo apellido del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el primer nombre o la columna 7
	{
		if($datos[$i][7]=="")
		{
			echo "Debe ingresar el primer nombre del paciente con identificación ".$datos[$i][4]."<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar el segundo apellido o la columna 8
	{
		if($datos[$i][8]=="")
		{
			echo "Debe ingresar el segundo nombre del paciente con identificación ".$datos[$i][4]."<br>";
			echo "En el caso de que no tenga segundo nombre, debe ingresar la palabra 'NONE'<br>";
			$error = true;
		}
	}
	for($i=0;$i<$filas;$i++) //for para revisar la fecha o la columna 9
	{
		if (0==preg_match('/\d{4}-\d{2}-\d{2}/',$datos[$i][9]))
		{ 
			echo "Debe revisar la fecha de nacimiento del paciente con identificación ".$datos[$i][4]."<br>";
	 		$error = true;
		} 
	}
	for($i=0;$i<$filas;$i++) //for para revisar el sexo o la columna 10
	{
		if ($datos[$i][10]!="M" && $datos[$i][10]!="F")
		{ 
			echo "Debe revisar el sexo del paciente con identificación ".$datos[$i][4]."<br>";
	 		$error = true;
		} 
	}
	for($i=0;$i<$filas;$i++) //for para revisar el código de pertenencia étnica o la columna 11
	{
		if ($datos[$i][11]!=1 && $datos[$i][11]!=2 && $datos[$i][11]!=3 && $datos[$i][11]!=4 && $datos[$i][11]!=5 && $datos[$i][11]!=6)
		{ 
			echo "Debe revisar el código de pertenencia étnica del paciente con identificación ".$datos[$i][4]."<br>";
	 		$error = true;
		} 
	}
	for($i=0;$i<$filas;$i++) //for para revisar el código de ocupación o la columna 12
	{
		if ($datos[$i][12]!=9999 && $datos[$i][12]!=9998)
		{ 
			echo "Debe revisar el código de ocupación del paciente con identificación ".$datos[$i][4]."<br>";
	 		$error = true;
		} 
	}
	for($i=0;$i<$filas;$i++) //for para revisar el código de nivel educativo o la columna 13
	{
		if ($datos[$i][13]!=1 && $datos[$i][13]!=2 && $datos[$i][13]!=3 && $datos[$i][13]!=4 && $datos[$i][13]!=5 && $datos[$i][13]!=6 && $datos[$i][13]!=7 && $datos[$i][13]!=8 && $datos[$i][13]!=9 && $datos[$i][13]!=10 && $datos[$i][13]!=11 && $datos[$i][13]!=12 && $datos[$i][13]!=13)
		{ 
			echo "Debe revisar el código de nivel educativo del paciente con identificación ".$datos[$i][4]."<br>";
	 		$error = true;
		} 
	}
	if($error==false) //Si no se muestra ningún error, le notifica al usuario que el archivo está correcto
	{
		echo "El archivo está perfecto!";
	}
	fclose($fp);
?>