<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors',0);
if ( 
    $_POST['uid'] && 
    $_POST['ou'] && 
    $_POST['uidNumber'] && 
    $_POST['gidNumber'] && 
    $_POST['homeDirectory'] &&
    $_POST['shell'] && 
    $_POST['cn'] && 
    $_POST['sn'] && 
    $_POST['givenName'] && 
    $_POST['postalAdress'] && 
    $_POST['mobile'] && 
    $_POST['telephoneNumber'] && 
    $_POST['title'] && 
    $_POST['description']
){
    #Dades de la nova entrada
    #
    $uid=$_POST['uid'];
    $unorg=$_POST['ou'];
    $num_id=$_POST['uidNumber'];
    $grup=$_POST['gidNumber'];
    $dir_pers=$_POST['homeDirectory'];
    $sh=$_POST['shell'];
    $cn=$_POST['cn'];
    $sn=$_POST['sn'];
    $nom=$_POST['givenName'];
    $mobil=$_POST['mobile'];
    $adressa=$_POST['postalAdress'];
    $telefon=$_POST['telephoneNumber'];
    $titol=$_POST['title'];
    $descripcio=$_POST['description'];
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    #
    #Afegint la nova entrada
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-majiiz',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";	
}
?>
<html>
<head>
<title>
Afegir usuari per mitjà d'un formulari.
</title>
</head>
<body>
<h2>Formulari de creació d'usuari</h2>
<form action="afegirUsuari.php" method="POST">
uid: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="ou"><br>
uidNumber: <input type="number" name="uidNumber"><br>
gidNumber: <input type="number" name="gidNumber"><br>
Directori Personal: <input type="text" name="homeDirectory"><br>
Shell: <input type="text" name="shell"><br>
cn: <input type="text" name="cn"><br>
sn: <input type="text" name="sn"><br>
givenName: <input type="text" name="givenName"><br>
Postal Adress: <input type="text" name="postalAdress"><br>
Mobile: <input type="number" name="mobile"><br>
Telephone Number: <input type="number" name="telephoneNumber"><br>
Title: <input type="text" name="title"><br>
Description: <input type="text" name="description"><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
</html>