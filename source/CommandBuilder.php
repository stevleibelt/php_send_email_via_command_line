<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\DomainModel\Address;
use De\Leibelt\SendMail\DomainModel\Attachment;
use De\Leibelt\SendMail\DomainModel\HtmlMail;
use De\Leibelt\SendMail\DomainModel\TextMail;
use De\Leibelt\SendMail\Service\AbstractShipper;
use De\Leibelt\SendMail\Service\SwiftShipper;
use SplFileInfo;
use SplFileObject;

class CommandBuilder
{
    /** @var array */
    private $listOfAttachments;

    /** @var array */
    private $listOfBlindCarbonCopy;

    /** @var array */
    private $listOfCarbonCopy;

    /** @var string */
    private $pathToTheContentFile;

    /** @var string */
    private $recipient;

    /** @var string */
    private $sender;

    /** @var AbstractShipper */
    private $shipper;

    /** @var string */
    private $subject;

    /**
     * CommandBuilder constructor.
     * @param AbstractShipper $shipper
     */
    public function __construct(AbstractShipper $shipper)
    {
        $this->shipper = $shipper;
    }

    /**
     * @return $this
     */
    public function start()
    {
        $this->reset();

        return $this;
    }

    /**
     * @param array $list
     * @return $this
     */
    public function withListOfAttachments(array $list)
    {
        $this->listOfAttachments = $list;

        return $this;
    }

    /**
     * @param array $list
     * @return $this
     */
    public function withListOfBlindCarbonCopy(array $list)
    {
        $this->listOfBlindCarbonCopy = $list;

        return $this;
    }

    /**
     * @param array $list
     * @return $this
     */
    public function withListOfCarbonCopy(array $list)
    {
        $this->listOfCarbonCopy = $list;

        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function withPathToTheContentFile($path)
    {
        $this->pathToTheContentFile = $path;

        return $this;
    }

    /**
     * @param string $recipient
     * @return $this
     */
    public function withRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @param string $sender
     * @return $this
     */
    public function withSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function withSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Command
     */
    public function build()
    {
        //begin of dependencies
        $attachments    = array();
        $bccs           = array();
        $ccs            = array();
        $file           = new SplFileObject($this->pathToTheContentFile);
        $content        = $file->fread($file->getSize());
        $isHtml         = (strtolower($file->getExtension()) === 'html');
        $recipient      = $this->recipient;
        $sender         = $this->sender;
        $shipper        = $this->shipper;
        $subject        = $this->subject;
        //end of dependencies

        //begin of attachment handling
        foreach ($this->listOfAttachments as $filePath) {
            $file = new SplFileInfo($filePath);

            switch (strtolower($file->getExtension())) {
                case 'jpeg':
                case 'jpg':
                    $contentType = 'image/jpeg';
                    break;
                case 'pdf':
                    $contentType = 'application/pdf';
                    break;
                default:
                    $contentType = null;
            }

            $attachments[] = new Attachment(
                $file->getPathname(),
                $file->getRealPath(),
                $contentType
            );
        }
        //end of attachment handling

        //begin of bcc
        foreach ($this->listOfBlindCarbonCopy as $blindCarbonCopy) {
            $bccs[] = new Address($blindCarbonCopy);
        }
        //end of bcc

        //begin of cc
        foreach ($this->listOfCarbonCopy as $carbonCopy) {
            $ccs[] = new Address($carbonCopy);
        }
        //end of cc

        //begin of mail
        if ($isHtml) {
            $mail = new HtmlMail(
                $sender,
                $recipient,
                $subject,
                $content,
                $attachments,
                $ccs,
                $bccs
            );
        } else {
            $mail = new TextMail(
                $sender,
                $recipient,
                $subject,
                $content,
                $attachments,
                $ccs,
                $bccs
            );
        }
        //end of mail

        return new Command($mail, $shipper);
    }

    private function reset()
    {
        $this->listOfAttachments        = array();
        $this->listOfBlindCarbonCopy    = array();
        $this->listOfCarbonCopy         = array();
        $this->pathToTheContentFile     = '';
        $this->recipient                = '';
        $this->sender                   = '';
        $this->subject                  = '';
    }
}
