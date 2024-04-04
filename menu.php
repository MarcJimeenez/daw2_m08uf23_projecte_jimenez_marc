<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

?>

<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
		</title>
	</head>
	<body>
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
		<h3><a href="visualitza.php">Visualitzar dades</a></h3>
		<h3><a href="afegirUsuari.php">Afegeix usuari</a></h3>
		<h3><a href="esborrarUsuari.php">Esborrar usuari</a></h3>
		<h3><a href="modificarUsuari.php">Modificar usuari</a></h3>
		<h3><a href="logout.php">Tancar sessió</a></h3>
		<a href="index.php">Torna a la pàgina inicial</a>
	</body>
</html>