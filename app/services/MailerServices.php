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
                    Nombre de jours d abscence : '. $this->getWorkingDays($date,$dateR ).'
                </p>
            </div>';
    }


    

    public function getWorkingDays($startDate,$endDate){
        $startYear = substr($startDate, 0, 4);
        $endYear   = substr($endDate, 0, 4);
        $holidays  = array(); 
        for ($iYear = $startYear; $iYear <= $endYear; $iYear++){
            $holidays = array_merge( $holidays, $this->getHolidays($iYear));
        }
        $nb_days = round((strtotime($endDate) - strtotime($startDate))/(60*60*24));
        for ($i = strtotime($startDate); $i < strtotime($endDate); $i += 86400){
            $iDayNum = date('N',$i); 
            if (in_array(date('Y-m-d', $i), $holidays) OR $iDayNum == 6 OR $iDayNum == 7) // Si c'est ferie ou samedi ou dimanche, on soustrait le nombre de secondes dans une journee. 
                $nb_days -= 1;
        }
        return (integer) $nb_days;
    }

    public function getHolidays($year = null){
        if ($year === null){
            $year = intval(strftime('%Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);
        $holidays = array(
            // Jours feries fixes
            date("Y-m-d",mktime(0, 0, 0, 1, 1, $year)),// 1er janvier
            date("Y-m-d",mktime(0, 0, 0, 5, 1, $year)),// Fete du travail
            date("Y-m-d",mktime(0, 0, 0, 5, 8, $year)),// Victoire des allies
            date("Y-m-d",mktime(0, 0, 0, 7, 14, $year)),// Fete nationale
            date("Y-m-d",mktime(0, 0, 0, 8, 15, $year)),// Assomption
            date("Y-m-d",mktime(0, 0, 0, 11, 1, $year)),// Toussaint
            date("Y-m-d",mktime(0, 0, 0, 11, 11, $year)),// Armistice
            date("Y-m-d",mktime(0, 0, 0, 12, 25, $year)),// Noel
            // Jour feries qui dependent de paques
            date("Y-m-d",mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear)),// Lundi de paques
            date("Y-m-d",mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear)),// Ascension
        );
        sort($holidays);
        return $holidays;
    }
}