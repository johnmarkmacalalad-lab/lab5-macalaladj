<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Product Vault</title>
    <style>
        :root { color-scheme: light; --ink: #3f2433; --muted: #8a6074; --accent: #e83e8c; --paper: #fff1f7; --line: #f3b6d2; }
        * { box-sizing: border-box; } body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: radial-gradient(circle at 15% 20%, #f7a8ca 0, transparent 34%), var(--paper); color: var(--ink); font: 16px/1.5 Georgia, serif; }
        main { width: min(440px, calc(100% - 2rem)); padding: 2.5rem; background: rgba(255,255,255,.88); border: 1px solid var(--line); box-shadow: 12px 12px 0 #edb4ce; }
        h1 { margin: 0 0 .35rem; font: 700 2.25rem/1.1 Georgia, serif; } p { color: var(--muted); margin: 0 0 2rem; }
        label { display: block; margin: 1rem 0 .35rem; font-weight: 700; } input { width: 100%; padding: .8rem; border: 1px solid var(--line); background: #fffafd; font: inherit; } button { width: 100%; margin-top: 1.5rem; padding: .85rem; border: 0; background: var(--accent); color: white; font: 700 1rem Georgia, serif; cursor: pointer; } .error { padding: .75rem; border-left: 4px solid #be185d; background: #fde2ef; color: #9d174d; }
    </style>
</head>
<body>
<main>
    <h1>Product Vault</h1>
    <p>Sign in to manage the product catalog.</p>
    <?php if (!empty($error)): ?><div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" action="/login">
        <label for="username">Username</label>
        <input id="username" name="username" required autocomplete="username">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <button type="submit">Sign in</button>
    </form>
</main>
</body>
</html>