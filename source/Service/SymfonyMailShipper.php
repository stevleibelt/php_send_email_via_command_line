<?php

namespace De\Leibelt\SendMail\Service;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\DomainModel\HtmlMail;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class SymfonyMailShipper extends AbstractShipper
{
    /** @var Mailer */
    private $mailer;

    public function __construct(
        Mailer  $symfonyMailer
    ) {
        $this->mailer    = $symfonyMailer;
    }

    /**
     * @param AbstractMail $mail
     * @return void
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function ship(AbstractMail $mail)
    {
        $email = new Email();

        foreach ($mail->attachments() as $attachment) {
            $email->attachFromPath(
                $attachment->path(),
                $attachment->name(),
                $attachment->contentType()
            );
        }

        foreach ($mail->bccs() as $bcc) {
            $email->addBcc($bcc->address());
        }

        foreach ($mail->ccs() as $cc) {
            $email->addCc($cc->address());
        }

        if ($mail instanceof HtmlMail) {
            $email->html($mail->content());
        } else {
            $email->text($mail->content());
        }

        $email->from($mail->from());
        $email->subject($mail->subject());
        $email->to($mail->to());

        $this->mailer->send($email);;
    }
}