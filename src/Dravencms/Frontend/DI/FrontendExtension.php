<?php declare(strict_types = 1);

namespace Dravencms\Frontend\DI;

use Dravencms\Frontend\Frontend;
use Dravencms\Frontend\ITemplate;
use Kdyby\Console\DI\ConsoleExtension;
use Nette;
use Nette\DI\Compiler;
use Nette\DI\Configurator;

/**
 * Class BaseExtension
 * @package Dravencms\Structure\DI
 */
class FrontendExtension extends Nette\DI\CompilerExtension
{

    protected static $prefix = 'frontend';

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix(self::$prefix))
            ->setFactory(Frontend::class);

    }

    public function beforeCompile(): void
    {
        $builder = $this->getContainerBuilder();

        /** @var ServiceDefinition $database */
        $frontend = $builder->getDefinition($this->prefix(self::$prefix));

        foreach ($builder->findByType(ITemplate::class) AS $serviceName => $service) {
            $frontend->addSetup('addTemplateProvider', ['@' . $serviceName]);
        }
    }
}
