<?php

use Meso\Meso;
use HezarDastan\HezarDastan;
use HezarDastan\Dast;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Tick\Tick;
use Tick\Config\DefaultConfig;
require_once("./Config/DefaultConfig.php");
require_once("./Resources/Meso/Meso.php");
require_once("./Resources/Meso/Base.php");
require_once("./Resources/HezarDastan/HezarDastan.php");
require_once("./Resources/SessionManager/SessionManager.php");
require_once ('./Resources/PHPMailer-master/src/Exception.php');
require_once ('./Resources/PHPMailer-master/src/PHPMailer.php');
require_once ('./Resources/PHPMailer-master/src/SMTP.php');

require_once("./Models/Controllers/AppController.php");
require_once ("./Config/DefaultConfig.php");
#region Sessiontbl
$sessions = new Swoole\Table(2024);
$sessions->column('ip', Swoole\Table::TYPE_STRING, 15);       //1,2,4,8
$sessions->column('ts', Swoole\Table::TYPE_STRING, 30);
$sessions->column('user', Swoole\Table::TYPE_STRING, 40);       //1,2,4,8
$sessions->create();
#endregiont
$Meso = new Meso(Address, User, Password, Database);
if(!$Meso->connect())
{
    print_r("Error: Service can not initialize \n reason: Database Connection Error");
    exit;
}
$Conf = DefaultConfig\RetunConf();
$HD = new HezarDastan($Meso);
$HFunc = new Dast();
$SM = new SessionManager($sessions);
$PM = new PHPMailer(true);
#region phpmailer
if($Conf->IsSMTP)
{
    $PM->isSMTP();                                            //Send using SMTP
    $PM->Host = 'smtp.focusapp.site';                           //Set the SMTP server to send through
    $PM->SMTPAuth = true;                                     //Enable SMTP authentication
    $PM->Username = 'admin@focusapp.site';                       //SMTP username
    $PM->Password = 'amir#admin';                                 //SMTP password
    $PM->Port = 25;
}
try
{
    $PM->setFrom('testmail', 'COMPEX');
}
catch (Exception $e)
{
    print_r("PHP MAILER ERROR : {$PM->ErrorInfo}");
    exit("Tick server exited in initialize phase");
}
#endregion
$Tick = new App\AppController($HD, $Meso, $SM, $PM, $sessions);
?>