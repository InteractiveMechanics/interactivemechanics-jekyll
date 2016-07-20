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
    //$mail->addAddress('amelia@interactivemechanics.com', 'Amelia Longo');     // Add a recipient
    $mail->addReplyTo('no-reply@interactivemechanics.com', 'No-Reply');
    $mail->isHTML(true);
    
    $mail->Subject = 'Contact Form Submission from ' . $_REQUEST['email'];
    $mail->Body    = '<h3 style="font-weight: 300;">Contact Form Submission</h3><br>' . 
                     '<b>Name</b>: '    . $_REQUEST['fname'] . ' ' . $_REQUEST['lname'] . '<br>' .
                     '<b>Email</b>: '   . $_REQUEST['email'] . '<br>' .
                     '<b>Subject</b>: ' . $_REQUEST['topic'] . '<br>' .
                     '<b>Message</b>: ' . $_REQUEST['message'] . '<br>' .
                     '<b>Date</b>: '    . $date;
          
    syncMailchimp();
    if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) === false) {
        if(!$mail->send()) {
            header('Location: /contact?failed');
            die();
        } else {
            header('Location: /contact?success');
            die();
        }
    } else {
        header('Location: /contact?failed');
        die();
    }


    function syncMailchimp() {
        $apiKey = 'fa143f704fb8e17cddbde31c6bec6900-us4';
        $auth = base64_encode( 'user:'.$apiKey );
    
        $json = json_encode(array(
            'apikey' => $apiKey,
            'email_address' => $_REQUEST['email'],
            'status' => 'subscribed',
            'merge_fields'  => array(
                'FNAME' => $_REQUEST['fname'],
                'LNAME' => $_REQUEST['lname']
            ),
            'interests' => array(
                '77706338b2' => true,
                '75d214e116' => true
            )
        ));
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://us4.api.mailchimp.com/3.0/lists/185fdc2b87/members/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                        'Authorization: Basic '.$auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 
    
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        return $httpCode;
    }
?>