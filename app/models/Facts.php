<?php

use JsonSchema\Constraints\Enum;

class Facts extends Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $text;
}
