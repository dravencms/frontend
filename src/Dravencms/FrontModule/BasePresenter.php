<?php declare(strict_types = 1);
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\FrontModule;


class BasePresenter extends \Dravencms\BasePresenter
{
    public function startup()
    {
        $this->getUser()->getStorage()->setNamespace('Front');
        parent::startup();
    }
}