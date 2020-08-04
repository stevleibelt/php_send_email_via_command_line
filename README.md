# Send Mail Via Command Line

## Usage

```
send_mail "<email address of the sender>" "<email address of the recipient>" "<subject>" "<path/to/the/file.txt|html>" [--bcc=<email address of an blind carbon copy - can be used multiple times>] [--cc=<email address of a carbon copy - can be used multiple times>][-v|--verbose] [--attachment=<path to a file you want to attach> - can be used multiple times]
```

## Manual

### NAME

send_mail - send an email via the command line

### SYNOPSIS

send_mail [FROM] [TO] [SUBJECT] [PATH TO THE CONTENT FILE] [OPTIONS]

### DESCRIPTION

Send an email via the command line. The content is stored inside a file to easy up usage. Text or html is detected automatically.

### AUTHOR

Written by Stev Leibelt.

### REPORTING BUGS

Report bugs to <https://github.com/stevleibelt/php_send_email_via_command_line/issues>

### COPYRIGHT

Copyright © 2015 Free Software Foundation, Inc.  License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>.

This is free software: you are free to change and redistribute it.  There is NO WARRANTY, to the extent permitted by law.

# Install

## By Hand

```
mkdir -p /opt/stevleibelt
cd /opt/stevleibelt
git clone https://github.com/stevleibelt/php_send_email_via_command_line
composer install
```

## With [Packagist](https://packagist.org/packages/stevleibelt/php_send_email_via_command_line)

```
composer require stevleibelt/php_send_email_via_command_line
```

## Configuration

Currently, there is no merging of `local.dist.php` and `local.php`.
If you create a `local.php`, you have to copy the whole configuration section.

```
#only do it if you really need it.
cp configuration/local.dist.php configuration/local.php
#adapt it to your needs
vim configuration/local.php
```

# Links

# History

* upcomming
    * @todo
        * add flag "--add-sender-to-bcc" or "--send-it-to-me-also"
        * add "--content-as-text" and "--content-as-html" as optional lists
        * create install script that does the steps in the "by hand" section
        * create shell script to do a step by step selection
        * combine --verbose with EchoLogger
    * added suggests
    * fixed license spelling issue
    * removed unused use statements
* [1.6.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.1) - released at 2020-08-04
    * fixed issue when using SendmailTransporter
* [1.6.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.0) - released at 2020-08-04
    * added logging support (file based logging and cli output)
* [1.5.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.5.0) - released at 2020-08-04
    * support for `configuration/local.dist.php` and `configuration/local.php` to add capability to modify the supported transporters (currently `sendmail` and `smtp`)
* [1.4.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.1) - released at 2020-08-04
    * fixed missing migration code
* [1.4.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.0) - released at 2020-08-04
    * bumped version of php von 5.3 to 7.2
    * bumped version of swiftmailer von 5.4 to 6.0
* [1.3.2](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.2) - released at 04.11.2016
    * fixed issue [--attachment does not work with relative paths](https://github.com/stevleibelt/php_send_email_via_command_line/issues/1)
* [1.3.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.1) - released at 18.02.2016
    * created Builder to easy up switching between different mail libraries
* [1.3.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.0) - released at 18.02.2016
    * created basic domain models and services
    * move code into small classes (like "ValidateEmail" etc.)
* [1.2.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.2.0) - released at 04.02.2016
    * added content type detection
* [1.1.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.1.0) - released at 04.02.2016
    * added "--attachment"
* [1.0.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.1) - released at 17.01.2016
    * added packagist
    * fixed issue when using optional "--bcc"
    * made send_mail executable
* [1.0.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.0) - released at 16.01.2016
    * initial release
