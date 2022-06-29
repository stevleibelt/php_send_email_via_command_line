<?php

namespace De\Leibelt\SendMail\Service;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\DomainModel\HtmlMail;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class SymfonyMailShipper extends AbstractShipper
{
    private LoggerInterface  $logger;

    private Mailer $mailer;

    public function __construct(
        LoggerInterface  $logger,
        Mailer  $symfonyMailer
    ) {
        $this->logger   = $logger;
        $this->mailer   = $symfonyMailer;
    }

    public function ship(AbstractMail $mail): void
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

        try {
            $this->mailer->send($email);;
        } catch (TransportExceptionInterface $exception) {
            $this->logger->error(
                $exception->getMessage(),
                [
                    'debug'             => $exception->getDebug(),
                    'trace_as_string'   => $exception->getTraceAsString()
                ]
            );
        }
    }
}