<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Migration;

use CViewRenderer;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Yii;

class TwigRenderer extends CViewRenderer
{
    /** @var Twig_Environment */
    private $twig;

    /** @var string */
    public $fileExtension = 'twig';

    public function init()
    {
        $app = Yii::app();
        $loader = new Twig_Loader_Filesystem($app->getBasePath() . '/views');
        $this->twig = new Twig_Environment($loader, [
            'cache' => $app->getRuntimePath() . '/twig_cache/',
            'debug' => true,
        ]);
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->addGlobal('app', $app);

        return parent::init();
    }

    /**
     * Renders a view file.
     * This method is required by {@link IViewRenderer}.
     * @param CBaseController $context the controller or widget who is rendering the view file.
     * @param string $sourceFile the view file path
     * @param mixed $data the data to be passed to the view
     * @param boolean $return whether the rendering result should be returned
     * @return mixed the rendering result, or null if the rendering result is not needed.
     */
    public function renderFile($context, $sourceFile, $data, $return)
    {
        // current controller properties will be accessible as {{ this.property }}
        $data['this'] = $context;

        $template = $this->twig->render($sourceFile, $data);

        if ($return) {
            return $template;
        }
        echo $template;
    }

    /**
     * Parses the source view file and saves the results as another file.
     * @param string $sourceFile the source view file path
     * @param string $viewFile the resulting view file path
     */
    protected function generateViewFile($sourceFile, $viewFile)
    {
        // TODO: Implement generateViewFile() method.
    }
}
