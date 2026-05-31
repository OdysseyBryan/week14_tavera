<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="OdyTest - PHPUnit Test Report">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'OdyTest - Test Report') ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/css/glassmorphism.css">
    <style {csp-style-nonce}>
        .report-refresh-note {
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="nav-bar">
    <a href="<?= site_url('/') ?>" class="nav-link">Home</a>
    <a href="<?= site_url('/test-report') ?>" class="nav-link active">Test Report</a>
    <a href="https://github.com/OdysseyBryan/week14_tavera" target="_blank" class="nav-link">GitHub</a>
</nav>

<div class="container">

    <!-- Report Header -->
    <div class="report-header">
        <h1>Test Report</h1>
        <p>PHPUnit execution results &mdash; cached for 60 seconds</p>
    </div>

    <!-- Status & Last Run -->
    <div style="text-align: center; margin-bottom: 2rem;">
        <?php if ($status === 'pass'): ?>
            <div class="status-badge pass">
                <span class="icon">✅</span>
                <span>PASS</span>
            </div>
        <?php else: ?>
            <div class="status-badge fail">
                <span class="icon">❌</span>
                <span>FAIL</span>
            </div>
        <?php endif; ?>
        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.5rem;">
            Last run: <?= esc($lastRun) ?>
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="report-stats">
        <div class="glass-card stat-card">
            <div class="stat-value <?= $status === 'pass' ? 'pass' : 'fail' ?>"><?= (int) $tests ?></div>
            <div class="stat-label">Tests</div>
        </div>
        <div class="glass-card stat-card">
            <div class="stat-value" style="color: var(--accent-yellow);"><?= (int) $assertions ?></div>
            <div class="stat-label">Assertions</div>
        </div>
        <div class="glass-card stat-card">
            <div class="stat-value <?= ($failures > 0 || $errors > 0) ? 'fail' : 'pass' ?>"><?= (int) $failures ?></div>
            <div class="stat-label">Failures</div>
        </div>
        <div class="glass-card stat-card">
            <div class="stat-value <?= ($errors > 0) ? 'fail' : 'pass' ?>"><?= (int) $errors ?></div>
            <div class="stat-label">Errors</div>
        </div>
    </div>

    <!-- Raw Output -->
    <div class="glass-card report-output">
        <h3 style="margin-bottom: 1rem; font-weight: 600; color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
            📋 PHPUnit Output
        </h3>
        <pre><?= esc($output) ?></pre>
    </div>

    <!-- Actions -->
    <div class="report-actions">
        <a href="<?= site_url('/test-report') ?>" class="glass-btn glass-btn-primary">
            🔄 Refresh Report
        </a>
        <a href="<?= site_url('/') ?>" class="glass-btn">
            🏠 Back to Home
        </a>
    </div>

    <!-- Footer -->
    <div class="report-footer">
        <small>OdyTest &middot; Week 14 Assignment &middot; <?= date('Y') ?></small>
    </div>

</div>

</body>
</html>