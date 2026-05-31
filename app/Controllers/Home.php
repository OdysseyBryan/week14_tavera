<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'pageTitle' => 'OdyTest - Futuristic Testing Dashboard',
            'testStatus' => $this->getTestStatus(),
        ];

        return view('welcome_message', $data);
    }

    /**
     * Get the test status from cached PHPUnit result.
     * Returns 'pass' or 'fail'.
     */
    private function getTestStatus(): string
    {
        $cacheFile = WRITEPATH . 'cache/test_status.json';

        if (!is_file($cacheFile)) {
            return 'pass';
        }

        $cached = json_decode(file_get_contents($cacheFile), true);

        if (!$cached || !isset($cached['status'])) {
            return 'pass';
        }

        return $cached['status'];
    }
}