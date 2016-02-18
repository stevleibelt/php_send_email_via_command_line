<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\Service\SwiftShipper;
use RuntimeException;

class CommandBuilderFactory
{
    /**
     * @return CommandBuilder
     */
    public function create()
    {
        if (class_exists('Swift_Mailer')) {
            $shipper = new SwiftShipper();
        } else {
            throw new RuntimeException(
                'could not create a shipper, no need and supported library installed'
            );
        }

        return new CommandBuilder($shipper);
    }
}