<?php declare(strict_types = 1);
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\FrontModule;


use Dravencms\Frontend\Frontend;
use Dravencms\Frontend\ITemplate;

class BasePresenter extends \Dravencms\BasePresenter
{
    /** @var Frontend */
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
    }

    /**
     * @return \Dravencms\Base\ITemplate|null
     */
    public function getCurrentTemplate(): ?ITemplate
    {
        return $this->frontend->findTemplate($this->getLayoutName());
    }
}