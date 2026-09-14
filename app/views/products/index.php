<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Tindahan ni JM</title>
    <style>
        :root { --ink:#3f2433; --muted:#8a6074; --accent:#e83e8c; --paper:#fff1f7; --line:#f3b6d2; }
        * { box-sizing:border-box; } body { margin:0; background:linear-gradient(135deg,#fff1f7 0%,#f8c8dc 100%); color:var(--ink); font:16px/1.5 Georgia,serif; } header, main { width:min(1080px,calc(100% - 2rem)); margin:auto; } header { padding:2rem 0; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--line); } h1 { margin:0; font-size:2.3rem; } .sub { color:var(--muted); } a, button { color:var(--accent); } .button, button { display:inline-block; padding:.65rem .9rem; border:1px solid var(--accent); background:transparent; font:inherit; text-decoration:none; cursor:pointer; } .button.primary { color:#fff; background:var(--accent); } main { padding:2rem 0; } .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; } .table-wrap { overflow-x:auto; background:#fffafd; border:1px solid var(--line); box-shadow:8px 8px 0 #edb4ce; } table { width:100%; border-collapse:collapse; min-width:680px; } th,td { padding:.9rem 1rem; text-align:left; border-bottom:1px solid var(--line); } th { color:var(--muted); font-size:.85rem; text-transform:uppercase; letter-spacing:.05em; } .actions { display:flex; gap:.5rem; align-items:center; } .danger { border-color:#be185d; color:#be185d; } form { display:inline; }
    </style>
</head>
<body>
<header><div><h1>Tindahan ni JM</h1><div class="sub">Signed in as <?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?></div></div><form method="post" action="/logout"><button type="submit">Log out</button></form></header>
<main>
    <div class="toolbar"><strong><?= count($products) ?> product(s)</strong><a class="button primary" href="/products/create">Add product</a></div>
    <div class="table-wrap"><table><thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr></thead><tbody>
    <?php foreach ($products as $product): ?><tr>
        <td><?= (int) $product->id ?></td><td><?= htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8') ?></td><td>₱<?= number_format((float) $product->price, 2) ?></td><td><?= (int) $product->quantity ?></td><td><?= htmlspecialchars($product->created_at, ENT_QUOTES, 'UTF-8') ?></td>
        <td class="actions"><a href="/products/edit/<?= (int) $product->id ?>">Edit</a><form method="post" action="/products/delete/<?= (int) $product->id ?>" onsubmit="return confirm('Delete this product?')"><button class="danger" type="submit">Delete</button></form></td>
    </tr><?php endforeach; ?>
    <?php if (empty($products)): ?><tr><td colspan="7">No products yet. Add the first one.</td></tr><?php endif; ?>
    </tbody></table></div>
</main>
</body>
</html>