<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

final class Address
{
    private string $address;
    private null|string $name;

    /**
     * Address constructor.
     * @param string $address
     * @param null|string $name
     * @throws InvalidArgumentException
     * @todo validate address
     */
    public function __construct(
        string $address,
        string $name = null
    ) {
        $this->address  = $address;
        $this->name     = $name;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function hasName(): bool
    {
        return (!is_null($this->name));
    }
}