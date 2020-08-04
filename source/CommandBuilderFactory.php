<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\Service\SwiftShipper;
use InvalidArgumentException;
use RuntimeException;
use Swift_Mailer;
use Swift_SendmailTransport;
use Swift_SmtpTransport;
use Swift_Transport;

class CommandBuilderFactory
{
    /**
     * @return CommandBuilder
     */
    public function create()
    {
        return new CommandBuilder(
            $this->buildShipper()
        );
    }

    private function buildTransport(array $configuration): Swift_Transport
    {
        switch ($configuration['active_transporter_class_name']) {
            case Swift_SendmailTransport::class:
                $transport  = new Swift_SendmailTransport(
                    $configuration[Swift_SendmailTransport::class]['command']
                );
                break;
            case Swift_SmtpTransport::class:
                $transport  = new Swift_SmtpTransport(
                    $configuration['list_of_transporter_to_arguments'][Swift_SmtpTransport::class]['hostname'],
                    $configuration['list_of_transporter_to_arguments'][Swift_SmtpTransport::class]['port']
                );
                break;
            default:
                throw new InvalidArgumentException(
                    sprintf(
                        '[%s]: unsupported swift transporter.', __METHOD__
                    )
                );
        }

        return $transport;
    }

    private function buildShipper(): SwiftShipper
    {
        if (class_exists('Swift_Mailer')) {
            $configuration = $this->loadConfiguration();
            $transport = $this->buildTransport($configuration['transporter']);

            return new SwiftShipper(
                new Swift_Mailer(
                    $transport
                )
            );
        } else {
            throw new RuntimeException(
                'could not create a shipper, no need and supported library installed'
            );
        }
    }

    private function loadConfiguration(): array
    {
        $configurationPath  = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'configuration';

        $localConfigurationFilePath = $configurationPath . DIRECTORY_SEPARATOR . 'local.php';
        $distConfigurationFilePath  = $configurationPath . DIRECTORY_SEPARATOR . 'local.dist.php';

        if (file_exists($localConfigurationFilePath)) {
            $configuration = require_once $localConfigurationFilePath;
        } else if (file_exists($distConfigurationFilePath)) {
            $configuration = require_once $distConfigurationFilePath;
        } else {
            throw new RuntimeException(
                sprintf(
                    '[%s] Neither local nor distribution configuration found in path >>%s<<.',
                    __METHOD__,
                    $configurationPath
                )
            );
        }

        return $configuration;
    }
}