<?php


namespace App;
use Meso\Meso;
use PHPMailer\PHPMailer\Exception;
use HezarDastan\HezarDastan;
use \stdClass;


class AppController
{
    use auth;
    use consultant;
    use student;
    use payment;
    use quiz;
    use admin;
    use guide;
    public $HD;
    public $SM;
    public $Meso;
    public $request;
    public $response;
    public function __construct($hezardastan, $meso, $sessionmanager)
    {
        $this->Meso = $meso;
        $this->HD = $hezardastan;
        $this->SM = $sessionmanager;
    }
}