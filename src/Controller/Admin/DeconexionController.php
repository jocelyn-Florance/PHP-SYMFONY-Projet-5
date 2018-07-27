<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DeconexionController
 * @package App\Controller\Admin
 */
class DeconexionController
{

    /**
     * @return RedirectResponse
     */
    public function index()
    {
        session_destroy();
        $response = new RedirectResponse('/');
        return $response->send();
    }

}