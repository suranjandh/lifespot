<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $mail = null;
    public $settings = array(
        0 => array(
            'email' => 'info@growingyourestate.com',
            'username' => 'info@growingyourestate.com',
            'host' => 'secure166.inmotionhosting.com',
            'smtp_auth' => true,
            'password' => '%K!6K~=SnQK&',
            'smtp_secure' => 'tls',
            'port' => 465
        )
    );


    public function initiate_settings($settings)
    {
        //Server settings
        $this->mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        return false;
        $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = $settings['host'];  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = $settings['smtp_auth'];                               // Enable SMTP authentication
        $this->mail->Username = $settings['username'];                 // SMTP username
        $this->mail->Password = $settings['password'];                            // SMTP password
        $this->mail->SMTPSecure = $settings['smtp_secure'];                              // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = $settings['port'];      // TCP port to connect to
    }


    public function send_email($mail_settings)
    {

        $this->initiate_settings($this->settings[$mail_settings['setting_type']]);
        try {
            //Recipients
            $this->mail->setFrom($mail_settings['from'], $mail_settings['from_name']);
            $this->mail->addAddress($mail_settings['to'], $mail_settings['to_name']);     // Add a recipient

            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $mail_settings['subject'];

            $this->mail->Body = $this->get_email_template_for_settings($mail_settings);
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            print_r($this->mail);
            return false;
        }
    }


    public function get_welcome_email_total_settings($mail_settings)
    {
        $mail_settings = array(
            'setting_type' => 0,
            'from' => 'info@growingyourestate.com',
            'from_name' => 'LifeSpot',
            'to' => $mail_settings['to'],
            'to_name' => $mail_settings['to_name'],
            'reply_to' => '',
            'reply_to_name' => '',
            'cc' => array(),
            'bcc' => array(),
            'subject' => "Welcome to LifeSpot " . $mail_settings['to_name'],
            'template' => 'welcome_email',
            'template_bindings' => array()
        );

        return $mail_settings;
    }


    public function get_password_reset_email_total_settings($mail_settings)
    {
        $mail_settings = array(
            'setting_type' => 0,
            'from' => 'info@growingyourestate.com',
            'from_name' => 'LifeSpot',
            'to' => $mail_settings['to'],
            'to_name' => $mail_settings['to_name'],
            'reply_to' => '',
            'reply_to_name' => '',
            'cc' => array(),
            'bcc' => array(),
            'subject' => "Your LifeSpot account password reset link ",
            'template' => 'password_reset_email',
            'template_bindings' => $mail_settings['template_bindings']
        );

        return $mail_settings;
    }

    public function get_invitation_email_total_settings($mail_settings)
    {
        $mail_settings = array(
            'setting_type' => 0,
            'from' => 'info@growingyourestate.com',
            'from_name' => 'LifeSpot',
            'to' => $mail_settings['to'],
            'to_name' => $mail_settings['to_name'],
            'reply_to' => '',
            'reply_to_name' => '',
            'cc' => array(),
            'bcc' => array(),
            'subject' => "Invitation to LifeSpot " . $mail_settings['to_name'],// $mail_settings['reply_to_name']." is inviting you to LifeSpot ",
            'template' => 'invitation_email',
            'template_bindings' => $mail_settings['template_bindings']
        );

        return $mail_settings;
    }


    public function get_email_template_for_settings($mail_settings)
    {

      //  ob_start();
        // include EMAIL_FOLDER_PATH . $mail_settings['template'];
    // echo  view('project.estates.emails.' . $mail_settings['template'],$mail_settings);
     //   $out = ob_get_contents();
      //  ob_end_clean();
        return  view('project.estates.emails.' . $mail_settings['template'],compact('mail_settings'));

    }


}

