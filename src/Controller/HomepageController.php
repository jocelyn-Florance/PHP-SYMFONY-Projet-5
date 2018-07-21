<?php
namespace App\Controller;

/**
 * Class HomepageController
 * @package App\Controller
 */
class HomepageController extends Controller
{

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        echo $this->getTwig()->render('homepage.html.twig', [
        ]);
    }

}