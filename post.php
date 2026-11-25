<?php
require_once __DIR__ . '/config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT p.*, c.name AS category_name FROM posts p JOIN categories c ON c.id=p.category_id WHERE p.id=? AND p.status='published'");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) { http_response_code(404); die("Post not found."); }
$pageTitle = $post['title'];
include __DIR__ . '/includes/header.php';
?>
<section class="detail-hero">
<div class="container">
  <div class="kicker text-info"><?= htmlspecialchars($post['category_name']) ?></div>
  <h1 class="display-4 fw-bold mt-2"><?= htmlspecialchars($post['title']) ?></h1>
  <p class="lead text-white-50"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($post['location']) ?></p>
</div>
</section>
<section class="section pt-5">
<div class="container">
 <div class="row g-5">
  <div class="col-lg-7">
   <div class="detail-visual <?= htmlspecialchars($post['visual_class']) ?>"><i class="bi <?= htmlspecialchars($post['icon']) ?>"></i></div>
  </div>
  <div class="col-lg-5">
   <div class="content-card h-100">
    <div class="kicker">Destination story</div>
    <p class="mt-3 fs-5 lh-lg text-secondary"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <hr>
    <div class="d-flex justify-content-between text-secondary small"><span><i class="bi bi-tag"></i> <?= htmlspecialchars($post['category_name']) ?></span><span>Discover Egypt</span></div>
   </div>
  </div>
 </div>
 <a href="places.php" class="btn btn-dark rounded-pill mt-5"><i class="bi bi-arrow-left"></i> Back to places</a>
</div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
