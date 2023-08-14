<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\DomainModel;

use InvalidArgumentException;

abstract class AbstractMail
{
    /** @var array|Attachment[] */
    private array $attachments;
    /** @var array|Address[] */
    private array $bccs;
    /** @var array|Address[] */
    private array $ccs;
    private string $content;
    private Address $from;
    private string $subject;
    private Address $to;

    /**
     * AbstractMail constructor.
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $content
     * @param array|Attachment[] $attachments
     * @param array|Address[] $ccs
     * @param array|Address[] $bccs
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $from,
        string $to,
        string $subject,
        string $content,
        array $attachments,
        array $ccs,
        array $bccs
    ) {
        $this->attachments  = $attachments;
        $this->bccs         = $bccs;
        $this->ccs          = $ccs;
        $this->content      = $content;
        $this->from         = new Address($from);
        $this->subject      = $subject;
        $this->to           = new Address($to);

        if (strlen($subject) < 1) {
            throw new InvalidArgumentException(
                'invalid subject provided'
            );
        }
    }

    /**
     * @return array|Attachment[]
     */
    public function attachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return array|Address[]
     */
    public function bccs(): array
    {
        return $this->bccs;
    }

    /**
     * @return array|Address[]
     */
    public function ccs(): array
    {
        return $this->ccs;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function from(): string|Address
    {
        return $this->from;
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function to(): string|Address
    {
        return $this->to;
    }
}