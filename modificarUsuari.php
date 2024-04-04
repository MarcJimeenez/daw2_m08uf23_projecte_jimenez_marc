<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

    if ( isset($_POST['usr']) && isset($_POST['ou']) && isset($_POST['atribut']) && isset($_POST['nouValor']) ){
        $uid = $_POST['usr'];
        $unorg = $_POST['ou'];
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        
        $atributModificar = $_POST['atribut']; # Atribut a modificar
        $nouValor = $_POST['nouValor']; # Nou valor
        
        $opcions = [
            'host' => 'zend-majiiz',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $entrada = $ldap->getEntry($dn);
        if ($entrada){
            Attribute::setAttribute($entrada,$atributModificar,$nouValor);
            $ldap->update($dn, $entrada);
            echo "Atribut modificat";
        } else echo "<b>Aquesta entrada no existeix</b><br><br>"; 
    }
?>
<html>
<head>
<title>
MODIFICANT DADES D'USUARIS DE LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari de modificiació d'un atribut a un usuari</h2>
<form action="https://zend-majiiz/zendldap6/modificarUsuari.php" method="POST">
Unitat organitzativa: <input type="text" name="ou"><br>
Usuari: <input type="text" name="usr"><br>

	<p>Selecciona un atribut a modificar</p>
  	<input type="radio" id="uidNumber" name="atribut" value="uidNumber">
  	<label for="uidNumber">uidNumber</label><br>
  	<input type="radio" id="gidNumber" name="atribut" value="gidNumber">
  	<label for="gidNumber">gidNumber</label><br>
  	<input type="radio" id="homeDirectory" name="atribut" value="homeDirectory">
  	<label for="homeDirectory">homeDirectory</label><br>
	<input type="radio" id="loginShell" name="atribut" value="loginShell">
  	<label for="loginShell">shell</label><br>
	<input type="radio" id="cn" name="atribut" value="cn">
  	<label for="cn">cn</label><br>
	<input type="radio" id="sn" name="atribut" value="sn">
  	<label for="sn">sn</label><br>
	<input type="radio" id="givenName" name="atribut" value="givenName">
  	<label for="givenName">givenName</label><br>
	<input type="radio" id="postalAddress" name="atribut" value="postalAddress">
  	<label for="postalAddress">PostalAddress</label><br>
	<input type="radio" id="mobile" name="atribut" value="mobile">
  	<label for="mobile">mobile</label><br>
	<input type="radio" id="telephoneNumber" name="atribut" value="telephoneNumber">
  	<label for="telephoneNumber">telephoneNumber</label><br>
	<input type="radio" id="title" name="atribut" value="title">
  	<label for="title">title</label><br>
	<input type="radio" id="description" name="atribut" value="description">
  	<label for="description">description</label><br><br>
	<input type="text" placeholder="nou valor" name="nouValor">

<input type="submit"/>
<input type="reset"/>
</form>
</body>
</html>