<?php
namespace App\Traits;

use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
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

        $csrfTokenManager = new CsrfTokenManager();
        $defaultFormTheme = 'bootstrap_4_layout.html.twig';

        $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
        $vendorTwigBridgeDirectory = dirname($appVariableReflection->getFileName());

        $loader = new Environment(new FilesystemLoader(array(
            $this->parameters['views_folder'],
            $vendorTwigBridgeDirectory.'/Resources/views/Form'
        )));
        $formEngine = new TwigRendererEngine(array($defaultFormTheme), $loader);
        $loader->addRuntimeLoader(new FactoryRuntimeLoader(array(
            FormRenderer::class => function () use ($formEngine, $csrfTokenManager) {
                return new FormRenderer($formEngine, $csrfTokenManager);
            }
        )));

        $translator = new Translator('fr_FR');

        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource(
            'xlf',
            '/translations/messages.fr.xlf',
            'fr_FR'
        );

        $loader->addExtension(new FormExtension());
        $loader->addExtension(new TranslationExtension($translator));


        return $loader;

    }
}

