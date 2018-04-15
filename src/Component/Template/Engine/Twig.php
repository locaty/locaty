<?php

namespace Locaty\Component\Template\Engine;

class Twig extends Basic {

    /**
     * @var string
     */
    private $_templatesDir;

    /**
     * @var null|string
     */
    private $_cacheDir;

    /**
     * @var string
     */
    private $_fileExtension;

    /**
     * @param string $templatesDir
     * @param null|string $cacheDir
     * @param string $fileExtension
     */
    public function __construct(string $templatesDir, ?string $cacheDir = null, string $fileExtension = '.twig') {
        $this->_templatesDir = $templatesDir;
        $this->_cacheDir = $cacheDir;
        $this->_fileExtension = $fileExtension;
    }

    /**
     * @param string $template
     * @param array $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $template, array $params = []): string {
        $loader = new \Twig_Loader_Filesystem([$this->_templatesDir]);
        $loader->addPath($this->_templatesDir, 'root');
        $twig = new \Twig_Environment($loader, [
            'cache' => $this->_cacheDir ?? false
        ]);
        return $twig->render($template . $this->_fileExtension, $params);
    }
}
