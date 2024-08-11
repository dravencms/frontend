<?php declare(strict_types = 1);
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\FrontModule;


use Dravencms\Frontend\Frontend;
use Dravencms\Frontend\ITemplate;
use WebLoader\Nette\CssLoader;
use WebLoader\Nette\JavaScriptLoader;

class BasePresenter extends \Dravencms\BasePresenter
{
    /** @var Frontend @inject */
    public $frontend;

    public function startup(): void
    {
        $this->getUser()->getStorage()->setNamespace('Front');
        parent::startup();
    }

    public function formatLayoutTemplateFiles(): array
    {
        $list = parent::formatLayoutTemplateFiles();
        $layout = $this->getLayoutName();
        if ($found = $this->frontend->findTemplate($layout)) {
            $list[] = $found->getPath();
        }

        return $list;
    }

    /**
     * @return \Dravencms\Base\ITemplate|null
     */
    public function getCurrentTemplate(): ?ITemplate
    {
        return $this->frontend->findTemplate($this->getLayoutName());
    }

       /**
     * @return \WebLoader\Nette\CssLoader
     */
    public function createComponentCss(): CssLoader
    {
        return $this->webLoader->createCssLoader('frontend');
    }

    /**
     * @return JavaScriptLoader
     */
    public function createComponentJs(): JavaScriptLoader
    {
        return $this->webLoader->createJavaScriptLoader('frontend');
    }

}