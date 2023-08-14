<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

final class Attachment
{
    private null|string $contentType;
    private string $name;
    private string $path;

    /**
     * Attachment constructor.
     * @param string $name
     * @param string $path
     * @param null|string $contentType
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $name,
        string $path,
        string $contentType = null
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

    public function contentType(): null|string
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
