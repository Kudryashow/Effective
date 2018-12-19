<?php

namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller
{
    public function before() 
    {
        $this->view->layout = 'custom';
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            $this->view->redirect('/');
        }
        $this->view->render('Sign');
    }
    public function registerAction() 
    {
        $this->view->render('Register');
    }
}