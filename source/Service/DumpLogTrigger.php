<?php

namespace De\Leibelt\SendMail\Service;

use Swift_Plugins_Logger;
use Swift_Plugins_Loggers_ArrayLogger;

final class DumpLogTrigger
{
    private null|string $filePathToLogOrNull;
    private null|Swift_Plugins_Logger $swiftLogger;

    public function __construct(
        ?string $filePathToLogOrNull,
        ?Swift_Plugins_Logger $swiftLogger
    ) {
        $this->filePathToLogOrNull  = $filePathToLogOrNull;
        $this->swiftLogger          = $swiftLogger;
    }

    public function triggerLoggerDump(): void
    {
        //buzz me if you don't like this variable name
        $dumpItLikeItsHot = (
            ($this->swiftLogger instanceof Swift_Plugins_Loggers_ArrayLogger)
            && (strlen($this->swiftLogger->dump()) > 0)
        );

        if ($dumpItLikeItsHot) {
            if (is_string($this->filePathToLogOrNull)) {
                file_put_contents(
                    $this->filePathToLogOrNull,
                    print_r(
                        $this->swiftLogger->dump(),
                        true
                    ),
                    FILE_APPEND
                );
            } else {
                print_r(
                    $this->swiftLogger->dump()
                );
            }
        }
    }
}