<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="OdyTest - Futuristic Testing Dashboard for CodeIgniter 4">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'OdyTest') ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/css/glassmorphism.css">
    <style {csp-style-nonce}>
        /* Inline overrides for homepage-specific layout */
        .hero-divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-orange), var(--accent-purple));
            border-radius: 2px;
            margin: 1.2rem auto;
        }
        .feature-card .feature-icon {
            transition: transform 0.3s ease;
        }
        .feature-card:hover .feature-icon {
            transform: scale(1.15);
        }
        .footer-glass {
            text-align: center;
            padding: 1.5rem;
            margin-top: 3rem;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .footer-glass small {
            opacity: 0.7;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="nav-bar">
    <a href="<?= site_url('/') ?>" class="nav-link active">Home</a>
    <a href="<?= site_url('/test-report') ?>" class="nav-link">Test Report</a>
    <a href="https://github.com/OdysseyBryan/week14_tavera" target="_blank" class="nav-link">GitHub</a>
</nav>

<!-- Hero Section -->
<div class="hero">
    <h1 class="logo-text">OdyTest</h1>
    <p class="logo-sub">CodeIgniter 4 · Unit Testing Dashboard</p>

    <!-- Status Badge -->
    <?php if (isset($testStatus) && $testStatus === 'pass'): ?>
        <div class="status-badge pass">
            <span class="icon">✅</span>
            <span>PASS — All Tests Passing</span>
        </div>
    <?php else: ?>
        <div class="status-badge fail">
            <span class="icon">❌</span>
            <span>FAIL — Tests Not Passing</span>
        </div>
    <?php endif; ?>

    <div class="hero-divider"></div>
</div>

<!-- Features Section -->
<div class="container">
    <div class="features">
        <div class="glass-card feature-card">
            <span class="feature-icon">⚡</span>
            <h3>Fast Testing</h3>
            <p>Run PHPUnit tests with a single command. Results cached for 60 seconds for instant feedback.</p>
        </div>

        <div class="glass-card feature-card">
            <span class="feature-icon">📊</span>
            <h3>Live Reports</h3>
            <p>Visit the <a href="<?= site_url('/test-report') ?>" style="color: var(--accent-orange);">Test Report</a> page to see detailed results including assertions, failures, and raw output.</p>
        </div>

        <div class="glass-card feature-card">
            <span class="feature-icon">🧪</span>
            <h3>PHPUnit Powered</h3>
            <p>Built on CodeIgniter 4 with PHPUnit. Custom assertions and CI-friendly testing utilities included.</p>
        </div>
    </div>

    <!-- Quick Info -->
    <div class="glass-card" style="margin-top: 2rem; text-align: center;">
        <p style="color: var(--text-muted);">
            CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> &middot;
            PHP <?= PHP_VERSION ?> &middot;
            Environment: <?= ENVIRONMENT ?>
        </p>
        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.5rem;">
            Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.
        </p>
    </div>
</div>

<!-- Footer -->
<div class="footer-glass">
    <small>&copy; <?= date('Y') ?> OdyTest &middot; Built with CodeIgniter 4 &middot; Week 14 Assignment</small>
</div>

</body>
</html>