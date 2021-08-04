<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
setlocale(LC_MONETARY, 'pt_BR');
date_default_timezone_set('America/Sao_Paulo');
mb_internal_encoding("UTF-8");

// Configuraçoes BD
define("DATABASE_DRIVE","mysql");
define("DATABASE_HOST","localhost");
define("DATABASE_BD","proeficiencia");
define("DATABASE_USER","root");
define("DATABASE_SENHA","");
define("DATABASE_PORTA","3306");

function pdo_connect_bd(){
	$dsn        = DATABASE_DRIVE;
	$host       = DATABASE_HOST;
	$database   = DATABASE_BD; 
	$user       = DATABASE_USER; 
	$password   = DATABASE_SENHA;  
	$porta_BD   = DATABASE_PORTA;

	try {
		$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
		$pdo = new PDO("{$dsn}:host={$host};port={$porta_BD};dbname={$database}", $user, $password, $opcoes);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	} catch (PDOException $e) {
		echo $e->getCode()."<br>";
		echo $e->getMessage();
		exit("Erro no Banco de Dados");
	}
}

function retornaJsonLocalizacao(){
    $PublicIP = get_client_ip();
    $url = "https://ipinfo.io/$PublicIP/geo";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "User-Agent: curl/7.68.0",
    "Authorization: Bearer bde69808a03b4d",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    json_encode($resp);
}
