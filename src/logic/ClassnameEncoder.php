<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 01.01.2018
 * Time: 13:28
 */

namespace rickstalker\files\logic;

/**
 * Class ClassnameEncoder
 * @package rickstalker\files\logic
 */
class ClassnameEncoder
{
    /**
     * @var string
     */
    private $encoded = "";

    /**
     * ClassnameEncoder constructor.
     * @param $className
     */
    public function __construct($className)
    {
        $this->encoded = str_replace("\\", "\\\\", $className);
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->encoded;
    }
}
