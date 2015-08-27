<?php
require "vendor/autoload.php";
$app = new \Slim\Slim(array(
    'debug' => true
));


// Der Querystring wird ignoriert
$app->environment['PATH_INFO'] = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');


$app->GET("/led/:LED", function ($LED) use ($app) {

    $daten = file_get_contents("ledGpioZugehörigkeit.php");
    $result = json_decode($daten);



    if ($LED == 1 or $LED == 2 or $LED == 3 or $LED == 4 or $LED == 5) {
        $gpio = $result->LED->$LED->gpio->input;
        $status = trim(@shell_exec("/usr/local/bin/gpio -g read $gpio"));
        if($status == 1) {
            echo "LED $LED ist an";
        } elseif($status == 0) {
            echo "LED $LED ist aus";
        }
    } else {
        $app->response()->status(404);
        echo "LED $LED existiert nicht";
    }
});







$app->GET("/led/:LED/:Befehl", function ($LED, $Befehl) use ($app) {


    $daten = file_get_contents("ledGpioZugehörigkeit.php");
    $result = json_decode($daten);


    if($Befehl == "an" and ($LED == 1 or $LED == 2 or $LED == 3 or $LED == 4 or $LED == 5)) {
        $gpio = $result->LED->$LED->gpio->output;
        shell_exec("/usr/local/bin/gpio -g write $gpio 1");
    } elseif($Befehl == "aus" and ($LED == 1 or $LED == 2 or $LED == 3 or $LED == 4 or $LED == 5)) {
        $gpio = $result->LED->$LED->gpio->output;
        shell_exec("/usr/local/bin/gpio -g write $gpio 0");
    } else {
        $app->response()->status(404);
    }
});






$app->run();
