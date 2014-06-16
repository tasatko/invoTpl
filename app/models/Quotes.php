<?php

use JsonSchema\Constraints\Enum;

class Quotes extends Phalcon\Mvc\Model
{
    public $id;

    public $url;

    public $lang;

    public $text;

    public $author;
}
