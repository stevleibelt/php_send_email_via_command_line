<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail\Service;

use De\Leibelt\SendMail\DomainModel\AbstractMail;
use De\Leibelt\SendMail\DomainModel\Configuration;

abstract class AbstractShipper
{
    /**
     * @param AbstractMail $mail
     */
    abstract public function ship(AbstractMail $mail);
}