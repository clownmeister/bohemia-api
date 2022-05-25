<?php declare(strict_types=1);

namespace ClownMeister\QualityAssurance\PHPCodeSniffer\Report;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Reports\Report;

final class FullReport implements Report
{
    private string $root;

    public function __construct()
    {
        $this->root = sprintf('%s/', getcwd());
    }

    /**
     * @param mixed $report
     * @param File $phpcsFile
     * @param mixed $showSources
     * @param mixed $width
     *
     * @return bool
     */
    public function generateFileReport($report, File $phpcsFile, $showSources = FALSE, $width = 80): bool
    {
        if (count($report['messages']) > 0) {
            $path = str_replace($this->root, '', $report['filename']);

            foreach ($report['messages'] as $rowNumber => $rows) {
                foreach ($rows as $cols) {
                    foreach ($cols as $message) {
                        $type = "\033[33mWARNING\033[0m";
                        if ($message['type'] === 'ERROR') {
                            $type = "\033[31mERROR\033[0m";
                        }

                        $fixable = ' ';
                        if ($message['fixable'] === true) {
                            $fixable = 'X';
                        }


                        echo sprintf('%s | [%s] | %s:%s | %s%s', $type, $fixable, $path, $rowNumber, $message['message'], PHP_EOL);
                    }
                }
            }
        }

        return true;
    }

    /**
     * Generate the actual report.
     *
     * @param string $cachedData    Any partial report data that was returned from
     *                              generateFileReport during the run.
     * @param int    $totalFiles    Total number of files processed during the run.
     * @param int    $totalErrors   Total number of errors found during the run.
     * @param int    $totalWarnings Total number of warnings found during the run.
     * @param int    $totalFixable  Total number of problems that can be fixed.
     * @param bool   $showSources   Show sources?
     * @param int    $width         Maximum allowed line width.
     * @param bool   $interactive   Are we running in interactive mode?
     * @param bool   $toScreen      Is the report being printed to screen?
     *
     * @return void
     */
    public function generate(
        $cachedData,
        $totalFiles,
        $totalErrors,
        $totalWarnings,
        $totalFixable,
        $showSources = FALSE,
        $width = 80,
        $interactive = FALSE,
        $toScreen = TRUE,
    ): void {
        if (strlen($cachedData) !== 0) {
            echo sprintf('%s%s', $cachedData, PHP_EOL);
            echo sprintf("\033[31mErrors\033[0m: %s | ", $totalErrors);
            echo sprintf("\033[33mWarnings\033[0m: %s | ", $totalWarnings);
            echo sprintf("\033[0;32mFixable\033[0m: %s%s", $totalFixable, PHP_EOL);
            echo sprintf("\033[1;37mTotal\033[0m: %s%s%s", $totalErrors + $totalWarnings, PHP_EOL, PHP_EOL);
        }
    }

}
