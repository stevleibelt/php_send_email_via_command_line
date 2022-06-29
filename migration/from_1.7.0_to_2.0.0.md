# Migration from 1.7.0 to 2.0.0

The version [1.7.0](https://github.com/stevleibelt/php_send_email_via_command_line/releases/tag/1.7.0) is the last version using the `Swift_Mailer` component

## Tasks

### Adapt your local.php

#### Mandatory

* Update configuration section in path `transporter`
  * Change 'active_transporter_class_name' to
    * `\Symfony\Component\Mailer\Transport::class`
    * Or `\Symfony\Component\Mailer\Transport\SendmailTransporter::class`
  * Migrate your configuration section from the `Swift_Mailers`
    * Have a look to the `local.dist.php`, since this is a very situational section, we can not give your all fitting advices

#### Optional

* You can now define the log level via the configuration path `mailer -> debug -> log_level`
  * Supported values are log levels from `\Psr\Log\LogLevel`
