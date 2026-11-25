<?php
require_once __DIR__ . '/config.php';
$pageTitle = "Places";
$cat = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
if ($cat) {
  $stmt = $pdo->prepare("SELECT p.*, c.name AS category_name FROM posts p JOIN categories c ON c.id=p.category_id WHERE p.status='published' AND p.category_id=? ORDER BY p.id DESC");
  $stmt->execute([$cat]);
} else {
  $stmt = $pdo->query("SELECT p.*, c.name AS category_name FROM posts p JOIN categories c ON c.id=p.category_id WHERE p.status='published' ORDER BY p.id DESC");
}
$posts = $stmt->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="detail-hero"><div class="container"><div class="kicker text-info">Explore Egypt</div><h1 class="display-4 fw-bold mt-2">Choose your next <span class="text-info">destination.</span></h1><p class="lead text-white-50">Browse our growing collection of Egyptian destinations.</p></div></section>
<section class="section">
<div class="container">
 <div class="d-flex flex-wrap gap-2 mb-5">
   <a class="btn <?= !$cat ? 'btn-dark':'btn-outline-dark' ?> rounded-pill" href="places.php">All places</a>
   <?php foreach($categories as $c): ?>
     <a class="btn <?= $cat==$c['id'] ? 'btn-dark':'btn-outline-dark' ?> rounded-pill" href="?category=<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['name']) ?></a>
   <?php endforeach; ?>
 </div>
 <div class="row g-4">
 <?php if (!$posts): ?><div class="col-12"><div class="alert alert-info">No places found in this category.</div></div><?php endif; ?>
 <?php foreach($posts as $post): ?>
  <div class="col-md-6 col-lg-4">
   <article class="place-card">
    <div class="place-visual <?= htmlspecialchars($post['visual_class']) ?>">
      <span class="place-badge"><?= htmlspecialchars($post['category_name']) ?></span>
      <div class="place-icon"><i class="bi <?= htmlspecialchars($post['icon']) ?>"></i></div>
    </div>
    <div class="card-body">
      <div class="meta mb-2"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($post['location']) ?></div>
      <h3><?= htmlspecialchars($post['title']) ?></h3>
      <p><?= htmlspecialchars(mb_strimwidth($post['content'],0,145,'...')) ?></p>
      <a class="text-decoration-none fw-bold" href="post.php?id=<?= (int)$post['id'] ?>">View details <i class="bi bi-arrow-right"></i></a>
    </div>
   </article>
  </div>
 <?php endforeach; ?>
 </div>
</div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
