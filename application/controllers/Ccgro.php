<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ccgro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("RegistroBi");
        $this->bi = $this->registrobi;   
        require_once(APPPATH."/mailer/PHPMailerAutoload.php");   
    }

    public function load(){
        require_once(APPPATH."/mailer/PHPMailerAutoload.php");
    }

    public function index()
    {
        $this->load->view('ccgro');
    }

    function sendMail($registro) {
        $success = false;
        $mail = new PHPMailer();
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'servidor1143.il.controladordns.com';
        $mail->Port = 465;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'ssl';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "admin@ccgro.com.mx";
        //Password to use for SMTP authentication
        $mail->Password = "*mZlhZU!yaw[";
        //Set who the message is to be sent from
        $mail->setFrom("admin@ccgro.com.mx", 'http://ccgro.com.mx/');
        //Set an alternative reply-to address
       // $mail->addReplyTo('sacorus@gmail.com', 'http://cami.mx/');
        //Set who the message is to be sent to
        $mail->addAddress($registro['email'], 'Solicitante');
        #//$mail->addAddress('juan.martinez@cami.mx', 'Admin');
        $mail->addCC('admin@ccgro.com.mx');
        $mail->addCC('ana.guerrero@ccgro.com.mx');
        //Set the subject line
        $mail->Subject = 'Informacion sobre planes de redes. '.$registro['fullname'] ;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        $mail->isHTML(true);
        $mailContent = "<h3>Solicitud de informacion desde la pagina http://ccgro.com.mx/</h3> <br>". 
        "<b>Nombre:</b> ". $registro['fullname']." <br>".
        "<b>Email:</b> ". $registro['email'] . " <br>".
        "<b>Telefono:</b> ". $registro['telefono']." <br>".
        "<b>Mensaje:</b> ". $registro['mensaje']." <br> <br>".
        "<h3>Tu mensaje se ha enviado al administrador.</h3> <br>";
        $mail->Body = $mailContent;

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
           // echo "Mailer Error: " . $mail->ErrorInfo;
           echo "{success:false}"; 
        } else {
            //echo "Message sent!";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
            echo "{success:true}";
        }            
    }

    public function agregarRegistro()
    {    
        $registro = array(
            "fullname" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "telefono" => $this->input->post('telefono'),
            "mensaje" => $this->input->post('mensaje'),
        );
      $this->sendMail($registro);            
	}

}
