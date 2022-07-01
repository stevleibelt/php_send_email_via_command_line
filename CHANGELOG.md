# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Open]

### To Add

* Add flag "--attachments=" to ease up attaching files by regexp or by providing a directory
  * `--attachments="0*.jpg"` to attach all files in the current pwd that fits to this regepx
  * `--attachments="attachment/*"` to attach all files in the provided that fits to this regepx
* Add flag "--add-sender-to-bcc" or "--send-it-to-me-also"
* Add "--content-as-text" and "--content-as-html" as optional lists
* Create install script that does the steps in the "by hand" section
* Create shell script to do a step by step selection
* Implement [event dispatching](https://doeken.org/blog/using-symfony-mailer-without-framework)
* Setup [travisci](https://docs.travis-ci.com/user/languages/php/) (start adding unittests)
  * Or use [githubactions](https://freek.dev/1853-moving-php-and-laravel-tests-from-travis-ci-to-github-actions) since it looks like travisci is dead for open source

### To Change

* Combine --verbose with EchoLogger (inject environment or $beVerbose to AbstractShipper::ship())

## [Unreleased]

### Added

### Changed

## [2.0.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/2.0.0) - released at @todo

### Added

* Added [migration how to](migration/from_1.7.0_to_2.0.0.md)
* Added support for php 8.0

### Changed

* Changed from `Swift_Mailer` to `symfony\mailer`

## [1.7.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.7.0) - released at 2020-08-06

### Added

* Added this changelog
* Added suggests
* Added output if attachment filepath is not readable

### Changed

* Fixed license spelling issue
* Migrated history section from [README.md](README.md) to this changelog
* Migrated code to php 7.2
* Removed unused use statements
* DumpLogTrigger now only dumps if there is something in the log

## [1.6.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.1) - released at 2020-08-04

### Changed

* Fixed issue when using SendmailTransporter

## [1.6.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.6.0) - released at 2020-08-04

### Added

* Added logging support (file based logging and cli output)

## [1.5.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.5.0) - released at 2020-08-04

### Added

* Added support for `configuration/local.dist.php` and `configuration/local.php` to add capability to modify the supported transporters (currently `sendmail` and `smtp`)

## [1.4.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.1) - released at 2020-08-04

### Added

* Fixed missing migration code

## [1.4.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.4.0) - released at 2020-08-04

### Changed

* Bumped version of php von 5.3 to 7.2
* Bumped version of swiftmailer von 5.4 to 6.0

## [1.3.2](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.2) - released at 2016-11-04

### Added

* Fixed issue [--attachment does not work with relative paths](https://github.com/stevleibelt/php_send_email_via_command_line/issues/1)

## [1.3.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.1) - released at 2016-02-18

### Added

* Created Builder to easy up switching between different mail libraries

## [1.3.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.3.0) - released at 2016-02-18

### Added

* Created basic domain models and services

### Changed

* Move code into small classes (like "ValidateEmail" etc.)

## [1.2.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.2.0) - released at 2016-02-04

### Added

* Added content type detection

## [1.1.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.1.0) - released at 2016-02-04

### Added

* Added "--attachment"

## [1.0.1](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.1) - released at 2016-01-17

### Added

* Added packagist

### Changed

* Fixed issue when using optional "--bcc"
* Made send_mail executable

## [1.0.0](https://github.com/stevleibelt/php_send_email_via_command_line/tree/1.0.0) - released at 2016-01-16

### Added

* Initial release

