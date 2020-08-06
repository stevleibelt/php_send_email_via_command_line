<?php

namespace De\Leibelt\SendMail\Service;

use Swift_Plugins_Logger;
use Swift_Plugins_Loggers_ArrayLogger;

final class DumpLogTrigger
{
    /** @var null|string */
    private $filePathToLogOrNull;

    /** @var null|Swift_Plugins_Logger */
    private $swiftLogger;

    /**
     * Logger constructor.
     * @param string|null $filePathToLogOrNull
     * @param Swift_Plugins_Logger|null $swiftLogger
     */
    public function __construct(
        ?string $filePathToLogOrNull,
        ?Swift_Plugins_Logger $swiftLogger
    ) {
        $this->filePathToLogOrNull  = $filePathToLogOrNull;
        $this->swiftLogger          = $swiftLogger;
    }

    public function triggerLoggerDump()
    {
        //buzz me if you don't like this variable name
        $dumpItLikeItsHot = (
            ($this->swiftLogger instanceof Swift_Plugins_Loggers_ArrayLogger)
            && (count($this->swiftLogger->dump()) > 0)
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