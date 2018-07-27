<?php

namespace App\Controller;

class ErrorsController extends Controller
{
    /**
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        header('HTTP/1.1 404 Not Found');

        echo $this->getTwig()->render('errors.html.twig', array(
        'session' => $_SESSION
        ));
    }
}