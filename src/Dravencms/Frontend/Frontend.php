<?php declare(strict_types = 1);

namespace Dravencms\Frontend;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class Frontend
{
    private $templateProviders = [];

    public function addTemplateProvider(ITemplate $template): void
    {
        $this->templateProviders[$template->getName()] = $template;
    }

    /**
     * @param $name
     * @return ITemplate|null
     */
    public function findTemplate(string $name): ?ITemplate
    {
        if (array_key_exists($name, $this->templateProviders))
        {
            return $this->templateProviders[$name];
        }

        return null;
    }

}