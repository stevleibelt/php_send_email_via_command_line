<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\Service\AbstractShipper;

final class Command
{
    /** @var AbstractMail */
    private $mail;

    /** @var AbstractShipper */
    private $shipper;

    public function __construct(
        AbstractMail $mail,
        AbstractShipper $shipper
    ) {
        $this->mail     = $mail;
        $this->shipper  = $shipper;
    }

    public function execute()
    {
        $this->shipper->ship($this->mail);
    }
}