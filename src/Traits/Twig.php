<?php
namespace App\Traits;

use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Trait Twig
 * @package App\Traits
 */
trait Twig
{

    /**
     * @var
     */
    private $parameters;

    /**
     * Twig constructor.
     */
    public function __construct()
    {
        $this->getParameters();
    }

    public function getParameters()
    {
        $this->parameters = require __DIR__ . './../../config/twig/Twig.php';
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        $loader = new Twig_Loader_Filesystem([
            $this->parameters['views_folder']
        ]);
        return new Twig_Environment($loader);
    }
}

