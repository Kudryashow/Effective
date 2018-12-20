<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.12.18
 * Time: 14:16
 */

namespace application\controllers;
use application\core\Controller;


class MainController extends Controller
{
    public function indexAction()
    {
//        $result = $this->model->getNews();
//        $vars = [
//            'news' => $result,
//        ];
//        $this->view->render('Main page', $vars);
        $this->view->render('Main page');
    }
}