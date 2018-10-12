<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function __construct() {
        $this->mail = new PHPMailer(true);
        try {
            $this->mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'megazin.automat@gmail.com';
            $this->mail->Password = 'kuku1234AB';
            $this->mail->SMTPSecure = 'tsl';
            $this->mail->Port = 587;

            $this->mail->setFrom('megazin.automat@gmail.com', 'Megazin');

            $this->mail->addReplyTo('megazin.automat@gmail.com', 'Megazin');

            $this->mail->isHTML(true);
        } catch (Exception $e) {
        }
    }
    
    public function addAddress($mail) {
        $this->mail->addAddress($mail, 'Joe User');
    }
    
    public function addSubject($subject) {
        $this->mail->Subject = $subject;
    }
    
    public function addBody($body) {
        $this->mail->Body = $body;
    }
    
    public function addAltBody($altBody) {
        $this->mail->AltBody = $altBody;
    }

    public function send() {
        $this->mail->send();
    }

}
