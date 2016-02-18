<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

class Address
{
    /** @var string */
    private $address;

    /** @var null|string */
    private $name;

    /**
     * Address constructor.
     * @param string $address
     * @param null|string $name
     * @throws InvalidArgumentException
     * @todo validate address
     */
    public function __construct($address, $name = null)
    {
        $this->address  = $address;
        $this->name     = $name;
    }

    /**
     * @return string
     */
    public function address()
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function hasName()
    {
        return (!is_null($this->name));
    }

    /**
     * @return null|string
     */
    public function name()
    {
        return $this->name;
    }
}