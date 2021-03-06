<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\Service\DumpLogTrigger;
use De\Leibelt\SendMail\Service\SwiftShipper;
use InvalidArgumentException;
use Net\Bazzline\Component\Cli\Environment\CommandLineEnvironment;
use RuntimeException;
use Swift_Mailer;
use Swift_Plugins_Logger;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;
use Swift_Plugins_Loggers_EchoLogger;
use Swift_SendmailTransport;
use Swift_SmtpTransport;
use Swift_Transport;

class CommandBuilderFactory
{
    public function create(CommandLineEnvironment  $commandLineEnvironment): CommandBuilder
    {
        if (class_exists('Swift_Mailer')) {
            $configuration = $this->loadConfiguration();
            $transport = $this->buildTransport($configuration['transporter']);
            $loggerPluginOrNull = $this->buildLoggerPlugin($configuration['mailer']);
            $mailer = $this->buildMailer($transport, $loggerPluginOrNull);

            return new CommandBuilder(
                $commandLineEnvironment,
                new SwiftShipper(
                    new DumpLogTrigger(
                        $configuration['mailer']['debug']['log_file_path'],
                        $loggerPluginOrNull
                    ),
                    $mailer
                )
            );
        } else {
            throw new RuntimeException(
                'could not create a shipper, no need and supported library installed'
            );
        }
    }

    private function buildLoggerPlugin(array $configuration):?Swift_Plugins_Logger
    {
        $loggerOrNull = null;

        if ($configuration['debug']['enabled'] === true) {
            if ($configuration['debug']['log_to_file']) {
                $loggerOrNull = new Swift_Plugins_Loggers_ArrayLogger(100);
            } else {
                $loggerOrNull = new Swift_Plugins_Loggers_EchoLogger(false);
            }
        }

        return $loggerOrNull;
    }

    private function buildMailer(
        Swift_Transport $transport,
        ?Swift_Plugins_Logger $loggerOrNull
    ): Swift_Mailer {
        $mailer = new Swift_Mailer($transport);

        if ($loggerOrNull instanceof Swift_Plugins_Logger) {
            $mailer->registerPlugin(
                new Swift_Plugins_LoggerPlugin(
                    $loggerOrNull
                )
            );
        }

        return $mailer;
    }

    private function buildTransport(array $configuration): Swift_Transport
    {
        switch ($configuration['active_transporter_class_name']) {
            case Swift_SendmailTransport::class:
                $transport  = new Swift_SendmailTransport(
                    $configuration['list_of_transporter_to_arguments'][Swift_SendmailTransport::class]['command']
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
