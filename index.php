<?php
require_once __DIR__ . '/config.php';
$pageTitle = "Home";
$stmt = $pdo->query("SELECT p.*, c.name AS category_name FROM posts p JOIN categories c ON c.id=p.category_id WHERE p.status='published' ORDER BY p.id DESC LIMIT 6");
$posts = $stmt->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="container hero-content">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <span class="eyebrow"><i class="bi bi-stars"></i> Your journey starts here</span>
        <h1>Discover<br><span>Egypt.</span></h1>
        <p>From ancient wonders carved in stone to turquoise seas and golden deserts — explore the places that make Egypt extraordinary.</p>
        <div class="d-flex gap-3 flex-wrap mt-4">
          <a href="places.php" class="btn btn-explore">Explore destinations <i class="bi bi-arrow-right ms-1"></i></a>
          <a href="about.php" class="btn btn-outline-light rounded-pill px-4">About the project</a>
        </div>
        <div class="stat-card">
          <div class="stat"><strong>7,000+</strong><small>years of history</small></div>
          <div class="stat"><strong>30+</strong><small>protected sites</small></div>
          <div class="stat"><strong>∞</strong><small>stories to discover</small></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
<div class="container">
  <div class="d-flex justify-content-between align-items-end mb-5 gap-3">
    <div><div class="kicker">Featured destinations</div><h2 class="section-title mt-2">Places worth <span>remembering.</span></h2></div>
    <a href="places.php" class="btn btn-outline-dark rounded-pill d-none d-md-inline-block">View all <i class="bi bi-arrow-right"></i></a>
  </div>
  <div class="row g-4">
  <?php foreach ($posts as $post): ?>
    <div class="col-md-6 col-lg-4">
      <article class="place-card">
        <div class="place-visual <?= htmlspecialchars($post['visual_class']) ?>">
          <span class="place-badge"><?= htmlspecialchars($post['category_name']) ?></span>
          <div class="place-icon"><i class="bi <?= htmlspecialchars($post['icon']) ?>"></i></div>
        </div>
        <div class="card-body">
          <div class="meta mb-2"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($post['location']) ?></div>
          <h3><?= htmlspecialchars($post['title']) ?></h3>
          <p><?= htmlspecialchars(mb_strimwidth($post['content'],0,120,'...')) ?></p>
          <a class="text-decoration-none fw-bold" href="post.php?id=<?= (int)$post['id'] ?>">Discover story <i class="bi bi-arrow-up-right"></i></a>
        </div>
      </article>
    </div>
  <?php endforeach; ?>
  </div>
</div>
</section>

<section class="section section-soft">
<div class="container">
 <div class="row g-4 align-items-center">
  <div class="col-lg-6">
   <div class="kicker">Why Egypt?</div>
   <h2 class="section-title mt-2">One country.<br><span>Endless worlds.</span></h2>
   <p class="lead text-secondary mt-3">Egypt brings together history, nature, architecture and culture in one unforgettable journey.</p>
   <a href="places.php" class="btn btn-dark rounded-pill px-4">Start exploring</a>
  </div>
  <div class="col-lg-6">
   <div class="row g-3">
    <div class="col-6"><div class="feature"><i class="bi bi-bank"></i><h5 class="mt-3">Ancient history</h5><p class="text-secondary small mb-0">Temples, tombs and monuments that shaped civilization.</p></div></div>
    <div class="col-6"><div class="feature"><i class="bi bi-water"></i><h5 class="mt-3">Red Sea</h5><p class="text-secondary small mb-0">Clear waters, coral reefs and unforgettable coastlines.</p></div></div>
    <div class="col-6"><div class="feature"><i class="bi bi-brightness-high"></i><h5 class="mt-3">Deserts</h5><p class="text-secondary small mb-0">Golden landscapes stretching far beyond the horizon.</p></div></div>
    <div class="col-6"><div class="feature"><i class="bi bi-compass"></i><h5 class="mt-3">Adventure</h5><p class="text-secondary small mb-0">A new story waiting around every corner.</p></div></div>
   </div>
  </div>
 </div>
</div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
