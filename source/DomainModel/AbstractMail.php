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
    private $attachments;

    /** @var array|Address[] */
    private $bccs;

    /** @var array|Address[] */
    private $ccs;

    /** @var string */
    private $content;

    /** @var Address */
    private $from;

    /** @var string */
    private $subject;

    /** @var Address */
    private $to;

    /**
     * AbstractMail constructor.
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $content
     * @param array|Address[] $attachments
     * @param array|Address[] $ccs
     * @param array|Address[] $bccs
     * @throws InvalidArgumentException
     */
    public function __construct($from, $to, $subject, $content, array $attachments, array $ccs, array $bccs)
    {
        $this->attachments  = $attachments;
        $this->bccs         = $bccs;
        $this->ccs          = $ccs;
        $this->content      = $content;
        $this->from         = $from;
        $this->subject      = $subject;
        $this->to           = $to;

        if (strlen($subject) < 1) {
            throw new InvalidArgumentException(
                'invalid subject provided'
            );
        }
    }

    /**
     * @return array|Address[]|Attachment[]
     */
    public function attachments()
    {
        return $this->attachments;
    }

    /**
     * @return array|Address[]
     */
    public function bccs()
    {
        return $this->bccs;
    }

    /**
     * @return array|Address[]
     */
    public function ccs()
    {
        return $this->ccs;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * @return Address|string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function subject()
    {
        return $this->subject;
    }

    /**
     * @return Address|string
     */
    public function to()
    {
        return $this->to;
    }
}