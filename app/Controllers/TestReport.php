<?php

namespace App\Controllers;

class TestReport extends BaseController
{
    public function index()
    {
        $result = $this->runPhpUnit();

        $data = [
            'pageTitle' => 'OdyTest - Test Report',
            'tests'     => $result['tests'],
            'assertions'=> $result['assertions'],
            'failures'  => $result['failures'],
            'errors'    => $result['errors'],
            'status'    => $result['status'],
            'output'    => $result['output'],
            'lastRun'   => $result['last_run'],
        ];

        return view('test_report', $data);
    }

    /**
     * Run PHPUnit (with 60s cache) and return parsed results.
     */
    private function runPhpUnit(): array
    {
        $cacheFile = WRITEPATH . 'cache/test_status.json';

        // Check if cache exists and is less than 60 seconds old
        if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < 60) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        // Run PHPUnit and capture output
        $projectRoot = ROOTPATH;
        $command     = 'cd /d "' . $projectRoot . '" && .\\vendor\\bin\\phpunit 2>&1';
        $output      = shell_exec($command);

        // Default values
        $result = [
            'tests'      => 0,
            'assertions' => 0,
            'failures'   => 0,
            'errors'     => 0,
            'status'     => 'fail',
            'output'     => $output ?: 'Could not run PHPUnit.',
            'last_run'   => date('Y-m-d H:i:s'),
        ];

        // Parse PHPUnit output
        if ($output) {
            // Match "OK (N tests, M assertions)"
            if (preg_match('/OK\s+\((\d+)\s+test[s]?,\s+(\d+)\s+assertion[s]?\)/', $output, $m)) {
                $result['tests']      = (int) $m[1];
                $result['assertions'] = (int) $m[2];
                $result['failures']   = 0;
                $result['errors']     = 0;
                $result['status']     = 'pass';
            }

            // Match "FAILURES!" / "Tests: N, Assertions: M, Failures: F."
            if (preg_match('/FAILURES!/', $output)) {
                $result['status'] = 'fail';

                if (preg_match('/Tests:\s+(\d+),\s+Assertions:\s+(\d+)(?:,\s+Failures:\s+(\d+))?(?:,\s+Errors:\s+(\d+))?/', $output, $m)) {
                    $result['tests']      = (int) ($m[1] ?? 0);
                    $result['assertions'] = (int) ($m[2] ?? 0);
                    $result['failures']   = (int) ($m[3] ?? 0);
                    $result['errors']     = (int) ($m[4] ?? 0);
                }
            }

            // Match "ERROR!" (like parse errors)
            if (preg_match('/ERROR!/', $output)) {
                $result['status'] = 'fail';
            }
        }

        // Cache the result
        file_put_contents($cacheFile, json_encode($result, JSON_PRETTY_PRINT));

        return $result;
    }
}