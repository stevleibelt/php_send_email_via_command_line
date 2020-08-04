<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\Service;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\DomainModel\HtmlMail;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;
use Swift_SmtpTransport;

class SwiftShipper extends AbstractShipper
{
    /**
     * @param AbstractMail $mail
     * @see: http://swiftmailer.org/docs/messages.html
     */
    public function ship(AbstractMail $mail)
    {
        $message    = new Swift_Message();
        $transport  = new Swift_SendmailTransport('/usr/lib/sendmail -t');
        $mailer     = new Swift_Mailer($transport);

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
        $message->setTo(array($mail->to()));
        $message->setFrom(array($mail->from()));
        $message->setSubject($mail->subject());

        $mailer->send($message);
    }
}
