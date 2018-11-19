# Interceptor Router

## Install

Run **`composer require mihaiblebea/interceptor`**


## Simple Usage

Example:

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Interceptor\Request;
use Interceptor\Route;
use Interceptor\Router;
use Interceptor\Response;


$request = new Request();
$router  = new Router($request);

// Register user route
$router->add(Route::post('user/register', function($request) {
    ...
    Response::asJson([
        'response' => 'User has been registered'
    ]);
}));

// Get all users route
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

### You can also define routes by init of the Route class

Example:

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Interceptor\Request;
use Interceptor\Route;
use Interceptor\Router;
use Interceptor\Response;


$request = new Request();
$router  = new Router($request);

$register_route = new Route('user/register', function($request) {
    ...
}, 'POST');

router->add(register_route);

try {
    $router->run();
} catch(\Exception $e) {
    ...
    return var_dump(404);
}

```

### Usage of global middleware

Example:

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Interceptor\Request;
use Interceptor\Route;
use Interceptor\Router;
use Interceptor\Response;
use Interceptor\Middleware;


$request = new Request();
$router  = new Router($request);

$auth_middleware = Middleware::apply(function($request) {
    ...
    return $next;
});

// Bind the middleware to the Router object
$router->before(auth_middleware);

// OR

$router->before(Middleware::apply(function($request) {
    ...
    return $next;
}));

// Login user route
$router->add(Route::post('users', function($request) {
    ...
}));


try {
    $router->run();
} catch(\Exception $e) {
    ...
    return var_dump(404);
}

```

### Usage of route specific middleware

Example:

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Interceptor\Request;
use Interceptor\Route;
use Interceptor\Router;
use Interceptor\Response;
use Interceptor\Middleware;


$request = new Request();
$router  = new Router($request);

$middleware = Middleware::apply(function($request) {
    ...
    $next;
});

// Login user route
$router->add(Route::post('users', function($request) {
    ...
}, middleware));


try {
    $router->run();
} catch(\Exception $e) {
    ...
    return var_dump(404);
}

```


## Request Object

** Get GET or POST params from the request object **

Example:

*** "/users/MihaiBlebea?age=28" ***

```
$router->add(Route::post('users/:user', function($request, $user) {
    ...
    // Get the age from the request: '28'
    var_dump($request->retrive('age'));

    // OR
    var_dump($request->dump()['age']);


    // Get the username from the request: 'MihaiBlebea'
    var_dump($request->getUrlArray()[1]);

    // OR
    var_dump($user);
}));
```
