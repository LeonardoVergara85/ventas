<?php

namespace App\Middleware;

use Closure;
use Core\MiddlewareInterface;
use stdClass;
use App\Model\AuthJWT;

class AuthJWTMiddleware implements MiddlewareInterface
{
    public function handle($object, Closure $next)
    {
        $headers = getallheaders();
        $jwt = new AuthJWT();
        $error = new stdClass;

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            $error->success = false;
            $error->message = 'No autorizado';
            echo json_encode($error);
            return;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            if (!$jwt->check($token)) {
                http_response_code(401);
                $error->success = false;
                $error->message = 'Token inválido';
                echo json_encode($error);
                return;
            }
        } catch (\Exception $e) {
            http_response_code(500);
            $error->success = false;
            $error->message = 'Error';
            echo json_encode($error);
            return;
        }


        return $next($object);
    }
}
