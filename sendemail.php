<?php

$email = @trim(stripslashes($_POST['email']));
$para = 'stillmx@gmail.com'; // en esta línea va el mail del destinatario, puede ser una cuenta de hotmail, yahoo, gmail, etc
$asunto = @trim(stripslashes($_POST['subject'])); // acá se puede modificar el asunto del mail
if ($_POST){

  $cuerpo = "Nombre: " . @trim(stripslashes($_POST['name'])) . "\r \n";
  $cuerpo .= "Email: " . $email . "\r \n";
	$cuerpo .= "Asunto: " . $asunto . "\r\n";
	$cuerpo .= "Mensaje: " . @trim(stripslashes($_POST['message'])) . "\r\n";
	//las líneas de arriba definen el contenido del mail. Las palabras que están dentro de $_POST[""] deben coincidir con el "name" de cada campo.
	// Si se agrega un campo al formulario, hay que agregarlo acá.

    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/plain; charset=utf-8\n";
    $headers .= "X-Priority: 3\n";
    $headers .= "X-MSMail-Priority: Normal\n";
    $headers .= "X-Mailer: php\n".phpversion();


    mail($para, $asunto, $cuerpo, $headers);

    //include 'confirma.html'; //se debe crear un html que confirma el envío
}
// $name       = @trim(stripslashes($_POST['name']));
// $from       = @trim(stripslashes($_POST['email']));
// $subject    = @trim(stripslashes($_POST['subject']));
// $message    = @trim(stripslashes($_POST['message']));
// $to   	  	= 'stillmx@gmail.com';//replace with your email
//
// $headers   = array();
// //$headers[] = "MIME-Version: 1.0";
// //$headers[] = "Content-type: text/plain; charset=iso-8859-1";
// $headers[] = "From: {$name} <{$from}>";
// $headers[] = "Reply-To: <{$from}>";
// $headers[] = "Subject: {$subject}";
// $headers[] = "X-Mailer: PHP/".phpversion();
//
// mail($to, utf8_decode($subject), utf8_decode($message), implode('\r\n',$headers));
//
// die;



?>
