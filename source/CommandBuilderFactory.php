<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2016-02-18
 */
namespace De\Leibelt\SendMail;

use De\Leibelt\SendMail\Service\SymfonyMailShipper;
use InvalidArgumentException;
use Monolog\Handler\PHPConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Net\Bazzline\Component\Cli\Environment\CommandLineEnvironment;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use RuntimeException;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\SendmailTransport;

class CommandBuilderFactory
{
    public function create(CommandLineEnvironment  $commandLineEnvironment): CommandBuilder
    {
        if (class_exists(Mailer::class)) {
            $configuration = $this->loadConfiguration();
            $transport = $this->buildTransport($configuration['transporter']);
            $logger = $this->buildLogger($configuration['mailer']['debug']);
            $mailer = new Mailer($transport);

            return new CommandBuilder(
                $commandLineEnvironment,
                new SymfonyMailShipper(
                    $logger,
                    $mailer
                )
            );
        } else {
            throw new RuntimeException(
                'Could not create a shipper, no need and supported library installed'
            );
        }
    }

    private function buildLogger(array $configuration): LoggerInterface
    {
        if ($configuration['enabled'] === true) {
            $logger = new Logger('php_send_email');

            if ($configuration['log_to_file']) {
                $logger->pushHandler(
                    new StreamHandler(
                        $configuration['log_file_path'],
                        $configuration['log_level']
                    )
                );
            } else {
                $logger->pushHandler(
                    new StreamHandler(
                        'php://stdout',
                        LogLevel::DEBUG
                    )
                );
            }
        } else {
            $logger = new NullLogger();
        }

        return $logger;
    }

    private function buildTransport(array $configuration): Transport\TransportInterface
    {
        switch ($configuration['active_transporter_class_name']) {
            case SendmailTransport::class:
                $transport = new SendmailTransport(
                    $configuration['list_of_transporter_to_arguments'][SendmailTransport::class]['command']
                );
                break;
            case Transport::class:
                $transport = Transport::fromDsn($configuration['list_of_transporter_to_arguments'][Transport::class]['dsn']);
                break;
            default:
                throw new InvalidArgumentException(
                    sprintf(
                        '[%s]: unsupported transporter.', __METHOD__
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
