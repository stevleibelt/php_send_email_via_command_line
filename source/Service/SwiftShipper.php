<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\Service;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\DomainModel\Configuration;
use De\Leibelt\SendMail\DomainModel\HtmlMail;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;
use Swift_SmtpTransport;

class SwiftShipper extends AbstractShipper
{
    /** @var DumpLogTrigger */
    private $dumpLogTrigger;

    /** @var Swift_Mailer */
    private $mailer;

    public function __construct(
        DumpLogTrigger $dumpLogTrigger,
        Swift_Mailer $mailer
    ) {
        $this->dumpLogTrigger   = $dumpLogTrigger;
        $this->mailer           = $mailer;
    }


    /**
     * @param AbstractMail $mail
     * @see: http://swiftmailer.org/docs/messages.html
     */
    public function ship(AbstractMail $mail)
    {
        $message = new Swift_Message();

        foreach ($mail->attachments() as $attachment) {
            $message->attach(
                Swift_Attachment::fromPath(
                    $attachment->path(),
                    $attachment->contentType()
                )
            );
        }

        foreach ($mail->bccs() as $bcc) {
            $message->addBcc($bcc->address(), $bcc->name());
        }

        foreach ($mail->ccs() as $ccs) {
            $message->addCc($ccs->address(), $ccs->name());
        }

        if ($mail instanceof HtmlMail) {
            $message->setContentType('text/html');
        } else {
            $message->setContentType('text/plain');
        }

        $message->setBody($mail->content());
        $message->setTo(
            [
                $mail->to()
            ]
        );
        $message->setFrom(
            [
                $mail->from()
            ]
        );
        $message->setSubject($mail->subject());

        $this->mailer->send($message);
        $this->dumpLogTrigger->triggerLoggerDump();
    }
}
