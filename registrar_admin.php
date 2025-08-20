<?php
// Script para registrar el primer admin en la API

$url = 'http://api.builder.com/admins?register=true&suffix=admin';
$data = [
	'email_admin' => 'senpro@mail.com',
	'password_admin' => '123456'
];

$options = [
	'http' => [
		'header'  => [
			"Authorization: sfsagwshsGRgsXFJDF46234SDGSrtery",
			"Content-type: application/x-www-form-urlencoded"
		],
		'method'  => 'POST',
		'content' => http_build_query($data),
		'ignore_errors' => true
	]
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
	echo "Error al registrar admin.";
} else {
	echo "Respuesta de la API:\n";
	echo $result;
}
