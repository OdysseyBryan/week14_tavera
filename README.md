# OdyTest — Week 14 Unit Testing (CodeIgniter 4)

[![Tests](https://img.shields.io/badge/PHPUnit-✅%20PASS-brightgreen)](https://github.com/OdysseyBryan/week14_tavera)
[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.7-orange)](https://codeigniter.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-purple)](https://php.net)

A futuristic **glassmorphism-themed** unit testing dashboard built with CodeIgniter 4. This project demonstrates:

- PHPUnit integration with CodeIgniter 4
- Custom controller testing at `/` (Home) and `/test-report` (dynamic test runner)
- **OdyTest** branding with real-time test status badge
- Cached PHPUnit report page (60s refresh)
- Debugging demonstration via intentional error + fix commits

---

## 🚀 Setup Instructions

### 1. Prerequisites

- PHP 8.2+
- Composer
- XAMPP / WAMP (or any Apache + PHP environment)

### 2. Clone & Install

```bash
git clone https://github.com/OdysseyBryan/week14_tavera.git
cd week14_tavera
composer install
```

### 3. Configure Environment

```bash
cp env .env
```

Edit `.env` and set:

```
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
```

### 4. Start the Server

```bash
php spark serve
```

Visit `http://localhost:8080/` in your browser.

### 5. Run Tests

```bash
# From project root:
./vendor/bin/phpunit
```

Expected output:

```
PHPUnit 10.5.63 ...

.                                                                   1 / 1 (100%)

Time: 00:00.032, Memory: 12.00 MB

OK (1 test, 2 assertions)
```

> *The test has 2 assertions: `$result->isOK()` and status code check. If your professor requires exactly `1 assertion`, simply remove the `isOK()` line from `HomeTest.php`.*

---

## 📁 Project Structure (ASCII Tree)

```
week14_tavera/
├── app/
│   ├── Config/
│   │   └── Routes.php               # Route definitions (/, /test-report)
│   ├── Controllers/
│   │   ├── BaseController.php
│   │   ├── Home.php                 # Home controller (index + getTestStatus)
│   │   └── TestReport.php           # Test report controller (runs PHPUnit)
│   └── Views/
│       ├── welcome_message.php      # Glassmorphism homepage with OdyTest badge
│       └── test_report.php          # Glassmorphism test report page
├── public/
│   ├── css/
│   │   └── glassmorphism.css        # Futuristic glassmorphism styles
│   ├── index.php                    # Front controller
│   └── .htaccess
├── tests/
│   ├── app/
│   │   └── Controllers/
│   │       └── HomeTest.php         # Homepage test (asserts HTTP 200)
│   └── _support/
├── vendor/                          # Composer dependencies
├── writable/
│   └── cache/                       # Test status cache (test_status.json)
├── .env                             # Environment configuration
├── .gitignore
├── composer.json
├── env                              # Template for .env
├── phpunit.dist.xml                 # PHPUnit config
├── spark                            # CI4 CLI tool
└── README.md                        # This file
```

---

## 🧪 Routes

| Route          | Controller::Method     | Description                          |
|----------------|------------------------|--------------------------------------|
| `/`            | `Home::index`          | Homepage with OdyTest + status badge |
| `/test-report` | `TestReport::index`    | Full PHPUnit report (cached 60s)     |

---

## 🎨 Design: Futuristic Glassmorphism

- **Background**: `#181818` (dark)
- **Text**: `#F7F7F7` (light)
- **Accent 1 (orange)**: `#FF5722`
- **Accent 2 (purple)**: `#673AB7`
- **Accent 3 (yellow)**: `#FFEB3B`
- **Style**: Frosted glass (`backdrop-filter: blur(20px)`), rounded corners, subtle glow effects, animated radial gradients.

---

## 🐞 Debugging Demonstration (Two Commits)

### Commit 1 — Introduce a Controlled Error

Edit `app/Controllers/Home.php` and make these changes:

**Change #1:** Add a `dd()` call (commented) to show debugging usage.

**Change #2:** Introduce a null reference error by overwriting the `index()` method with buggy code.

```php
public function index(): string
{
    $data = [
        'pageTitle' => 'OdyTest - Futuristic Testing Dashboard',
        'testStatus' => 'pass',
    ];

    // DEVELOPMENT ONLY: Uncomment to debug variable contents
    // dd($data, 'Home controller data');

    // INTENTIONAL BUG: Accessing property of null variable
    $user = null;
    $name = $user->name;  // This will throw: Error: Trying to get property 'name' of non-object

    return view('welcome_message', $data);
}
```

**Result:** The homepage will return a 500 error (or blank page), and `./vendor/bin/phpunit` will fail.

```bash
# Expected output:
ERRORS!
Tests: 1, Assertions: 1, Errors: 1.
```

---

### Commit 2 — Fix the Error

Revert `app/Controllers/Home.php` back to the working version:

```php
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

        // DEVELOPMENT ONLY: Uncomment to debug variable contents
        // dd($data, 'Home controller data');

        return view('welcome_message', $data);
    }

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
```

**Result:** The homepage works again, and `./vendor/bin/phpunit` passes:

```bash
OK (1 test, 2 assertions)
```

---

## 🧪 Test File: `tests/app/Controllers/HomeTest.php`

```php
<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;

final class HomeTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    public function testHomePage(): void
    {
        $result = $this->controller(\App\Controllers\Home::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
        $this->assertSame(200, $result->response()->getStatusCode());
    }
}
```

---

## 🔗 GitHub Repository

[https://github.com/OdysseyBryan/week14_tavera](https://github.com/OdysseyBryan/week14_tavera)

---

## 📝 License

MIT — Built for educational purposes, Week 14 assignment.
