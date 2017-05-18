<?php

namespace Framework\Application;

use Framework\Request\Request;
use Framework\Response\Response;

class Application
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        try {
            $routes      = yaml_parse_file(dirname(__FILE__) . '/../../app/config/routing.yml');
            $environment = yaml_parse_file(dirname(__FILE__) . '/../../app/config/environment.yml');

            $route  = $request->getRequestUri();
            $method = $request->getRequestMethod();
            $query  = $request->getQueryString();

            $db = $environment['db'];

            $dsn      = "mysql:dbname=" . $db['name'] . ";host=" . $db['host'];
            $user     = $db['user'];
            $password = $db['password'];

            $pdo = new \PDO($dsn, $user, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            foreach ($routes as $params) {
                if (preg_match($params['route'], $route, $tokens) && in_array($method, $params['methods'])) {
                    list ($controller, $action) = explode('::', $params['callback']);

                    array_shift($tokens);

                    /** @var $controller \Framework\Controller\Controller */
                    $controller = new $controller;
                    $controller->setPdo($pdo);
                    $controller->setRequest($request);



                    if (!empty($query)) {
                        parse_str($query, $values);

                        $tokens[] = $values;
                    }

                    return call_user_func_array([$controller, $action], $tokens);
                }
            }

            return new Response(null, 404);
        } catch (\Exception $exception) {
            return new Response(null, 500);
        }
    }
}