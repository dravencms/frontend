<?php declare(strict_types = 1);
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Frontend;


interface ITemplate
{
    public function getPath(): string;

    public function getName(): string;
}