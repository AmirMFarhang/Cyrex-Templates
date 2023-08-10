<?php
//Initiate
require_once("./Initiate.php"); //for libs
//load swoole http libs

use Swoole\HTTP\Server;
use Swoole\HTTP\Request;
use Swoole\HTTP\Response;
$sch = new Swoole\Coroutine\Scheduler();
$sch->set(['hook_flags' => SWOOLE_HOOK_ALL]); //mysqli client and PDO
//define server object and config
$server = new Swoole\WebSocket\Server(MainListen, PortListen);
$server->set([
               'upload_tmp_dir' => '/TempF/',
               'daemonize' => 0,
               'log_file' => "./App.log",
               'open_http_protocol' => 0
           ]);
$server->on("start", function($server)
{ 
    echo "Tick App server is running... (BY COMPO.TEAM)";
});
$server->on("request", function(Request $request, Response $response) use ($HD, $SM, $Tick, $Conf)
{
    $var = $request->post['action'];
    $response->header("Access-Control-Allow-Origin", "*");
    $response->header("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
    $response->header("Access-Control-Allow-Headers","Content-Type, Authorization");
    $response->setheader("Access-Control-Allow-Origin", "*");
    $response->setheader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
    $response->setheader("Access-Control-Allow-Headers","Content-Type, Authorization");
    $Tick->request = $request;
    $Tick->response = $response;
    if($Conf->IsDebug)
    {
        var_dump($request);
        var_dump($request->files);
    }
    switch ($var)
    {
        //APIS COME HERE
    }

});
$server->on("message", function (swoole_websocket_server $server, $frame)
{
});
$server->on("open", function (swoole_websocket_server $server, $request)
{
});

$server->start();


