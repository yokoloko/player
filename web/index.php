<?php

require_once dirname(__FILE__) . '/../src/autoload.php';

$request = new \Framework\Request\Request($_GET, $_POST, $_SERVER);

$application = new \Framework\Application\Application();

$response = $application->handle($request);
$response->send();
