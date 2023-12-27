<?php
namespace App\services;
require_once  '././vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


Class MailerServices {

    public $config;

    public function __construct(){
        $this->config = json_decode(file_get_contents(__DIR__ . '/config.json'));
    }

    public function sendMail($adresse , $subject , $template){
        $mail = new PHPMailer(true);
        try {          
            $mail->isSMTP();                                           
            $mail->Host       =  $this->config->mailer->host;                     
            $mail->SMTPAuth   =  true;                                   
            $mail->Username   =  $this->config->mailer->username;                     
            $mail->Password   =  $this->config->mailer->password;                              
            $mail->SMTPSecure =  PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       =  465;                                    
            $mail->setFrom('myrecode@recode.fr', 'MyRecode');
            $mail->addAddress($adresse);    
            $mail->isHTML(true);        
            $mail->CharSet = 'UTF-8';                          
            $mail->Subject =  $subject;
            $mail->Body    = $template;
            $mail->send();
            return true ;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    public function bodyAbsence($user , $type , $motif , $date , $dateR){
        return '<style>
                .success-link{
                    padding-left: 24px;
                    padding-right: 24px;
                    padding-top: 12px;
                    padding-bottom: 12px;
                    background: #1FB447;
                    color: white;
                    border-radius: 16px;
                }
                .wrapper{
                    margin-top: 50px;
                    margin-bottom: 50px;
                }
                a:link { text-decoration: none; }
            
                a:visited { text-decoration: none; }
            
                a:hover { text-decoration: none; }
            
                a:active { text-decoration: none; }
            </style>
            <div class="wrapper">
                <p style="text-align: center;"><!--StartFragment--><span style="font-size:14px"><span style="font-weight:bold">Demande<br />
                    D absence</span></span>
                    <br/>
                    &nbsp;
                </p>
                    <p style="text-align: center;"> '.$user.' à effectué une demande d abscence pour le motif suivant : 
                    <br />
                    <br />
                        '.$type.' : '.$motif.'
                    <br />
                        Du  : '.$date.'
                    <br />
                        Au  : '.$dateR.'
                    <br />
                </p>
            </div>';
    }
}