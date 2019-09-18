<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("America/Mexico_City");
?>


<?php
	require 'phpmailer/PHPMailerAutoload.php';
	require 'phpmailer/class.phpmailer.php';
	require 'phpmailer/class.smtp.php';

	$name=$_POST['Nombre'];
	$email=$_POST['Correo'];
	$phone=$_POST['Telefono'];
	$message=$_POST['mensaje'];
    $hora=$_POST['hora'];
	$cita=$_POST['cita'];
	//in your php ignore any submissions that inlcude this field
	if(!empty($_POST['website'])) die();
		
    // $contenido = "Nombre:". $name. "\nCorreo:". $email. "\nTélefono:". $phone. "\nmensaje:".$message;
	// print_r($_POST);

	$template = file_get_contents('../correo/template.html');
	$template = str_replace('%name%', $name, $template);
	$template = str_replace('%email%', $email, $template);
	$template = str_replace('%phone%', $phone, $template);
	$template = str_replace('%message%', $message, $template);
	$template = str_replace('%hora%', $hora, $template);
	$template = str_replace('%cita%', $cita, $template);

        $mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
	    $mail->Mailer = 'smtp';
		$mail->Username = 'cclusterc@gmail.com'; // Correo completo a utilizar
		$mail->Password = 'zA422/*1x'; // Contraseña
        $mail->SMTPSecure = 'tls';
		$mail->Port = 587; // Puerto a utilizar
		$mail->From = 'cclusterc@gmail.com';
		$mail->FromName = 'CSC | Nuevo correo';
		$mail->AddAddress('informescscspa@cscwellnesscenter.com.mx'); // Esta es la dirección a donde enviamos
		$mail->isHTML(true);
	    $mail->CharSet = 'UTF-8';
        $mail->MsgHTML($message);
        $mail->SetFrom('********************************************', 'CSC');
		$mail->Subject = 'Nuevo Correo'; 
		$mail->Body = $template;
    

	 if(!$mail->Send()) {
		 header('Location: ../index.html');
		/*echo 'Mailer Error: ' . $mail->ErrorInfo;*/ 
	} else{
		 header('Location: ../correo.html');
		
	 }


?>

