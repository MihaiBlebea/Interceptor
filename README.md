# Interceptor Router

## Install

Run **`composer require mihaiblebea/interceptor`**


## Usage

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Interceptor\Request;
use Interceptor\Route;
use Interceptor\Router;
use Interceptor\Response;


$request = new Request();
$router  = new Router($request);

$router->add(Route::post('user/register', function($request) {
    ...
    Response::asJson([
        'response' => 'User has been registered'
    ]);
}));

$router->add(Route::get('users/all', function($request) {
    ...
    Response::asJson([
        'users' => $users
    ]);
}));


try {
    $router->run();
} catch(\Exception $e) {
    ...
    print($e->getMessage());
    return var_dump(404);
}

```
