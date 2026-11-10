<?php
require __DIR__ . '/includes/bootstrap.php';
$q = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$condition = trim($_GET['condition'] ?? '');
$sql = "SELECT p.*, u.name AS seller_name FROM products p JOIN users u ON u.id=p.user_id WHERE p.status='active'";
$params = [];
if ($q !== '') { $sql .= " AND (p.title LIKE ? OR p.description LIKE ? OR p.location LIKE ?)"; $like="%$q%"; array_push($params,$like,$like,$like); }
if ($category !== '') { $sql .= " AND p.category=?"; $params[]=$category; }
if ($condition !== '') { $sql .= " AND p.condition_type=?"; $params[]=$condition; }
$sql .= " ORDER BY p.created_at DESC";
$stmt = db()->prepare($sql); $stmt->execute($params); $products=$stmt->fetchAll();
$categories = ['Phones & Tablets','Computers','Electronics','Fashion','Home & Furniture','Vehicles','Property','Jobs & Services','Other'];
?>
<?php include __DIR__.'/includes/header.php'; ?>
<section class="hero">
  <div><span class="eyebrow">BUY • SELL • CONNECT</span><h1>Find it. Sell it.<br><em>Make a deal.</em></h1><p>Your community marketplace for great finds and better deals.</p><a class="btn" href="<?= e(url('sell.php')) ?>">Post an item for sale</a></div>
  <div class="hero-art"><div class="africa-mark">✦</div><span>Made for Africa</span></div>
</section>
<form class="searchbar" method="get">
  <input name="q" value="<?= e($q) ?>" placeholder="Search products, brands or locations">
  <select name="category"><option value="">All categories</option><?php foreach($categories as $c): ?><option <?= $category===$c?'selected':'' ?>><?= e($c) ?></option><?php endforeach; ?></select>
  <select name="condition"><option value="">Any condition</option><option value="Brand New" <?= $condition==='Brand New'?'selected':'' ?>>Brand New</option><option value="Used" <?= $condition==='Used'?'selected':'' ?>>Used</option></select>
  <button class="btn" type="submit">Search</button>
</form>
<div class="section-heading"><div><span class="eyebrow">THE MARKETPLACE</span><h2>Latest listings</h2></div><span class="muted"><?= count($products) ?> items found</span></div>
<div class="product-grid">
<?php foreach($products as $p): ?>
<a class="product-card" href="<?= e(url('product.php?id='.$p['id'])) ?>">
  <div class="product-image"><?php if($p['image']): ?><img src="<?= e(url('uploads/'.$p['image'])) ?>" alt="<?= e($p['title']) ?>"><?php else: ?><div class="placeholder">K</div><?php endif; ?><span class="condition"><?= e($p['condition_type']) ?></span></div>
  <div class="product-info"><strong><?= e($p['title']) ?></strong><b>₦<?= number_format((float)$p['price']) ?></b><span><?= e($p['location']) ?></span><small>By <?= e($p['seller_name']) ?></small></div>
</a>
<?php endforeach; ?>
<?php if (!$products): ?><div class="empty">No listings found. Try another search or be the first to <a href="<?= e(url('sell.php')) ?>">post an item</a>.</div><?php endif; ?>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
