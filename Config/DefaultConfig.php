<?php
namespace Tick\Config\DefaultConfig;

define("Address", "");
define("User", "");
define("Password", "");
define("Database", "");
define("MainListen", "");
define("LocalListen", "");
define("PortListen", "");
define("PortReserved", "");
define("SMTPServer", "");
define("VerificationEmail", "");
define("VerificationTitle", "");
function RetunConf()
{
    return (object)array(
        'IsDebug' => true,
        'Session' => true,
        'IsSMTP'  => false
    );
}
