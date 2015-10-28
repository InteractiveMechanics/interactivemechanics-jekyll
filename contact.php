<?php
    date_default_timezone_set('America/New_York');
    require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

    $date = date("F j, Y, g:i a");
    $mail = new PHPMailer;
    
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mike@interactivemechanics.com';    // SMTP username
    $mail->Password = 'mike john gmail work';             // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    
    $mail->setFrom('hello@interacivemechanics.com', 'Auto Sender');
    $mail->addAddress('mike@interactivemechanics.com', 'Michael Tedeschi');     // Add a recipient
    $mail->addAddress('amelia@interactivemechanics.com', 'Amelia Longo');     // Add a recipient
    $mail->addReplyTo('no-reply@interactivemechanics.com', 'No-Reply');
    $mail->isHTML(true);
    
    $mail->Subject = 'Contact Form Submission from ' . $_REQUEST['email'];
    $mail->Body    = '<h3 style="font-weight: 300;">Contact Form Submission</h3><br>' . 
                     '<b>Name</b>: '    . $_REQUEST['name'] . '<br>' .
                     '<b>Email</b>: '   . $_REQUEST['email'] . '<br>' .
                     '<b>Subject</b>: ' . $_REQUEST['topic'] . '<br>' .
                     '<b>Message</b>: ' . $_REQUEST['message'] . '<br>' .
                     '<b>Date</b>: '    . $date;
    
    if(!$mail->send()) {
        header('Location: /contact?failed');
        die();
    } else {
        header('Location: /contact?success');
        die();
    }
?>