<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 5:23 PM
 */

require 'vendor/autoload.php';

require 'DatabaseConn.php';

foreach (glob('Controllers/*.php') as $filename)
{
    include $filename;
}
foreach (glob('Entities/*.php') as $filename)
{
    include $filename;
}
foreach (glob('ValueObjects/Interfaces/*.php') as $filename)
{
    include $filename;
}
foreach (glob('ValueObjects/*.php') as $filename)
{
    include $filename;
}
foreach (glob('Repositories/*.php') as $filename)
{
    include $filename;
}
foreach (glob('Services/*.php') as $filename)
{
    include $filename;
}

$klein = new \Klein\Klein();

$klein->respond(['POST','GET'], '/response', static function ($request) {
    return (new PaymentsController)->getResponse($request);
});
$klein->respond(['POST','GET'], '/all-payments', static function () {
    return (new PaymentsController)->getAllPayments();
});
$klein->respond(['POST','GET'], '/use-promo', static function ($request) {
    return (new PaymentsController)->usePromo($request);
});

$klein->respond('GET', '/hello-world', function () {
    return 'Hello World!';
});

$klein->dispatch();



//include_once ('Router.php');
//include_once ('Controllers/PaymentsController.php');
//
//Router::route('/response', static function(){
//    return (new PaymentsController)->getResponse();
//});
//
//Router::execute($_SERVER['REQUEST_URI']);