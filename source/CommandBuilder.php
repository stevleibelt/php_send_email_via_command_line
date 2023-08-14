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
use Net\Bazzline\Component\Cli\Environment\CommandLineEnvironment;
use SplFileInfo;
use SplFileObject;

final class CommandBuilder
{
    private CommandLineEnvironment $commandlineEnvironment;
    private array $listOfAttachments;
    private array $listOfBlindCarbonCopy;
    private array $listOfCarbonCopy;
    private string $pathToTheContentFile;
    private string $recipient;
    private string $sender;
    private AbstractShipper $shipper;
    private string $subject;

    public function __construct(
        CommandLineEnvironment  $commandLineEnvironment,
        AbstractShipper $shipper
    ) {
        $this->commandlineEnvironment   = $commandLineEnvironment;
        $this->shipper                  = $shipper;
    }

    public function start(): self
    {
        $this->reset();

        return $this;
    }

    public function withListOfAttachments(array $list): self
    {
        $this->listOfAttachments = $list;

        return $this;
    }

    public function withListOfBlindCarbonCopy(array $list): self
    {
        $this->listOfBlindCarbonCopy = $list;

        return $this;
    }

    public function withListOfCarbonCopy(array $list): self
    {
        $this->listOfCarbonCopy = $list;

        return $this;
    }

    public function withPathToTheContentFile(string $path): self
    {
        $this->pathToTheContentFile = $path;

        return $this;
    }

    public function withRecipient(string $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function withSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function withSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function build(): Command
    {
        //begin of dependencies
        $attachments    = [];
        $bccs           = [];
        $ccs            = [];
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
            if (is_readable($filePath)) {
                $file = new SplFileInfo($filePath);

                switch (strtolower($file->getExtension())) {
                    case 'jpeg':
                    case 'jpg':
                        $contentType = 'image/jpeg';
                        break;
                    case 'png':
                        $contentType = 'image/png';
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
            } else {
                $this->commandlineEnvironment->output(
                    sprintf(
                        '[%s]: Filepath >>%s<< is not readable. This attachment is not attached to this mail.',
                        __METHOD__,
                        $filePath
                    )
                );
            }
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

    private function reset(): void
    {
        $this->listOfAttachments        = [];
        $this->listOfBlindCarbonCopy    = [];
        $this->listOfCarbonCopy         = [];
        $this->pathToTheContentFile     = '';
        $this->recipient                = '';
        $this->sender                   = '';
        $this->subject                  = '';
    }
}
