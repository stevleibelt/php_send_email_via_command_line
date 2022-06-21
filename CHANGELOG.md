# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Open]

### To Add

* add flag "--attachments=" to ease up attaching files by regexp or by providing a directory
  * `--attachments="0*.jpg"` to attach all files in the current pwd that fits to this regepx
  * `--attachments="attachment/*"` to attach all files in the provided that fits to this regepx
* add flag "--add-sender-to-bcc" or "--send-it-to-me-also"
* add "--content-as-text" and "--content-as-html" as optional lists
* create install script that does the steps in the "by hand" section
* create shell script to do a step by step selection

### To Change

* update to php 8.0
* combine --verbose with EchoLogger (inject environment or $beVerbose to AbstractShipper::ship())

## [Unreleased]

### Added

### Changed

## [1.7.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.7.0) - released at 2020-08-06

### Added

* added this changelog
* added suggests
* added output if attachment filepath is not readable

### Changed

* fixed license spelling issue
* migrated history section from [README.md](README.md) to this changelog
* migrated code to php 7.2
* removed unused use statements
* DumpLogTrigger now only dumps if there is something in the log

## [1.6.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.1) - released at 2020-08-04

### Changed

* fixed issue when using SendmailTransporter

## [1.6.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.0) - released at 2020-08-04

### Added

* added logging support (file based logging and cli output)

## [1.5.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.5.0) - released at 2020-08-04

### Added

* added support for `configuration/local.dist.php` and `configuration/local.php` to add capability to modify the supported transporters (currently `sendmail` and `smtp`)

## [1.4.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.1) - released at 2020-08-04

### Added

* fixed missing migration code

## [1.4.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.0) - released at 2020-08-04

### Changed

* bumped version of php von 5.3 to 7.2
* bumped version of swiftmailer von 5.4 to 6.0

## [1.3.2](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.2) - released at 2016-11-04

### Added

* fixed issue [--attachment does not work with relative paths](https://github.com/stevleibelt/php_send_email_via_command_line/issues/1)

## [1.3.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.1) - released at 2016-02-18

### Added

* created Builder to easy up switching between different mail libraries

## [1.3.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.0) - released at 2016-02-18

### Added

* created basic domain models and services

### Changed

* move code into small classes (like "ValidateEmail" etc.)

## [1.2.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.2.0) - released at 2016-02-04

### Added

* added content type detection

## [1.1.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.1.0) - released at 2016-02-04

### Added

* added "--attachment"

## [1.0.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.1) - released at 2016-01-17

### Added

* added packagist

### Changed

* fixed issue when using optional "--bcc"
* made send_mail executable

## [1.0.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.0) - released at 2016-01-16

### Added

* initial release
