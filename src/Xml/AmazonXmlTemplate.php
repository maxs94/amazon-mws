<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Xml;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AmazonXmlTemplate 
{

    /**
     * @var string
     */
    private $XmlPath = __DIR__ . '/../Xml/';

    /**
     * Twig Environment
     *
     * @var Environment
     */
    private $twig;

    public function __construct()
    {
        // twig 
        $twigLoader = new FilesystemLoader($this->XmlPath);
        $this->twig = new Environment($twigLoader);
    }

    /**
     * load xml template and render it 
     *
     * @param array $data
     * @return string
     */
    public function loadXmlTemplate(string $templateFile, array $data=[]) : string
    {


        if ($templateFile === '') {
            throw new Exception('No template provided to load.');
        }

        if (!file_exists($this->XmlPath . $templateFile)) {
            throw New Exception(sprintf('Template not found: %s', $this->XmlPath . $templateFile));
        }

        $template = $this->twig->load($templateFile);

        // render view 
        return $template->render($data);

    }

}