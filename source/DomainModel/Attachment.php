<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

class Attachment
{
    /** @var  */
    private $contentType;

    /** @var string */
    private $name;

    /** @var string */
    private $path;

    /**
     * Attachment constructor.
     * @param string $name
     * @param string $path
     * @param string $contentType
     * @throws InvalidArgumentException
     */
    public function __construct($name, $path, $contentType)
    {
        $this->contentType  = $contentType;
        $this->name         = $name;
        $this->path         = $path;

        if (!is_readable($path)) {
            throw new InvalidArgumentException(
                'provided path is not readable: ' . $path
            );
        }
    }

    /**
     * @return string
     */
    public function contentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }
}