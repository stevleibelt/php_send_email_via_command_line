# Send Mail Via Command Line

This free as in freedom command line tool to easy up sending mails from the command line.
Thanks to [Swiftmailer](https://swiftmailer.symfony.com/). This is just a command line frontend using the great swiftmailer.

The current change log can be found [here](CHANGELOG.md).

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
