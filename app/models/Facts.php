<?php

use JsonSchema\Constraints\Enum;

class Facts extends Phalcon\Mvc\Model
{
    public $id;

    public $url;

    public $lang;

    public $text;
}
