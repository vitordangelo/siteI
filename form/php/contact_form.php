<?php

// Fetching Values from URL.

$name = $_POST['name1'];
$email = $_POST['email1'];
$message = $_POST['message1'];
$contact = $_POST['contact1'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing E-mail.

// After sanitization Validation is performed

if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	if (!preg_match("/^[0-9]{10}$/", $contact))
		{
		echo "<span>* Por favor, confira seu número de telefone! *</span>";
		}
	  else
		{
		$subject = $name;

		// To send HTML mail, the Content-type header must be set.

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= 'From:' . $email . "\r\n"; // Sender's Email
		$headers.= 'Cc:' . $email . "\r\n"; // Carbon copy to Sender
		$template = '<div style="padding:50px; color:black;">Olá ' . $name . ',<br/>' . '<br/>Obrigado pelo contato!<br/><br/>' . 'Nome: ' . $name . '<br/>' . 'Email: ' . $email . '<br/>' . 'Número de Telefone: ' . $contact . '<br/>' . 'Mensagem: ' . '<br/>' . $message . '<br/><br/>' . 'Esta é a confirmação do seu email.' . '<br/>' . 'Em breve entraremos em contato. .</div>';
		$sendmessage = "<div style=\"background-color:white; color:white;\">" . $template . "</div>";

		// Message lines should not exceed 70 characters (PHP rule), so wrap it.

		$sendmessage = wordwrap($sendmessage, 70);

		// Send mail by PHP Mail Function.

		mail("contato@spin.agr.br", $subject, $sendmessage, $headers);
		echo "Sua mensagem foi enviada. Em breve entraremos em contato.";
		}
	}
  else
	{
	echo "<span>* Email inválido *</span>";
	}

?>