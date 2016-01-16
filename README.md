# Send Mail Via Command Line

## Usage

```
send_mail "<email address of the sender>" "<email address of the recipient>" "<subject>" "<path/to/the/file.txt|html>" [--bcc=<email address of an blind carbon copy - can be used multiple times>] [--cc=<email address of a carbon copy - can be used multiple times>][-v|--verbose]
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

# History

* upcomming
    * @todo
* [1.0.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.0) - released at 16.01.2016
    * initial release
