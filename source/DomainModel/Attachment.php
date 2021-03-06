<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

final class Attachment
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
    public function __construct(
        string $name,
        string $path,
        string $contentType
    ) {
        $this->contentType  = $contentType;
        $this->name         = $name;
        $this->path         = $path;

        if (!is_readable($path)) {
            throw new InvalidArgumentException(
                'provided path is not readable: ' . $path
            );
        }
    }

    public function contentType(): string
    {
        return $this->contentType;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function path(): string
    {
        return $this->path;
    }
}