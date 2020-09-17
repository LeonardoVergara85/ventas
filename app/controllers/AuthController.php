<?php

namespace App\Controller;

use Core\Controller;
use Core\View; 
use App\Model\AuthJWT;

class AuthController extends Controller
{

    public function login()
    {
        $vista = new View('auth/login');
        return $vista->render();
    }

    public function home()
    {
        $vista = new View('home');
        return $vista->render();
    }


    public function auth()
    {
        $resultado = new \stdClass();
        $error = new \stdClass();

        try {
            $usuario = new \App\Model\Usuario();
            $usuario->_username = $this->request->usuario;
            $usuario->_password = $this->request->contrasenia;

            $perfil = $usuario->obtenerUsuario();

            if ($perfil == null) {

                $error->mensaje = 'No tiene permiso para acceder al sistema';
                throw new \Exception('No tiene permiso para acceder al sistema');

            }else{

               //echo password_hash('contraseña', PASSWORD_BCRYPT);
               // traemos el hash de la base con la contraseña encriptada
               $hashBase = $perfil[0]['pass'];
               // verificamos el hash con la constraseña ingresada
               $verifica = password_verify($this->request->contrasenia, $hashBase);
             
               // si coincide accedemos, sino damos un error
                if($verifica == true){

                    $resultado->usuario = $perfil;

                }else{

                    $error->mensaje = 'No tiene permiso para acceder al sistema';
                    throw new \Exception('No tiene permiso para acceder al sistema');
                }
                

            }

            // $menu = new \App\Model\Menu();
            
             session()->set('usuario_id', $perfil[0]['id']);
             session()->set('usuario', $perfil[0]['username']);
             session()->set('nombre_usuario', $perfil[0]['nombre']);
             session()->set('apellido_usuario', $perfil[0]['apellido']);
             session()->set('tipo_usuario', $perfil[0]['tipo']);
             session()->set('sistema','SISTEMA JENZO');
             session()->set('logueado', true);  

             $resultado->exito = true;
            

        } catch (\Exception $e) {

            if (!isset($error->mensaje))

                $error->mensaje = 'Error al iniciar sesión.';
                $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

            $resultado->exito = false;
            $resultado->error = $error;
        }

        return json_encode($resultado);
    }

    public function logout()
    {
        if (session()->exists('logueado')) {
            session()->close();
            return redirect('/login');
        }
    }

 
}
