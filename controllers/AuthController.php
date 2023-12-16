<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $errors = [];

        $user = new User();

        if ($request->isPost()){  // is POST
            $user->loadData($request->getBody());


            if ($user->validate() && $user->save()){
                return "SUCCESS";
            }
            //var_dump($user->errors);

            return $this->render('register',[
                'model' => $user,
            ]);

        }
        $this->setLayout('auth');
        return $this->render('register',[
        'model' => $user,
    ]);
    }



}