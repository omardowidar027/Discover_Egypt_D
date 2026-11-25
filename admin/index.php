<?php
require_once __DIR__ . '/../config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    $status = ($_POST['status'] ?? 'published') === 'draft' ? 'draft' : 'published';
    $visual = $_POST['visual_class'] ?? 'visual-pyramid';
    $icon = $_POST['icon'] ?? 'bi-bank';
    if ($title && $content && $location && $category_id) {
        $stmt = $pdo->prepare("INSERT INTO posts(title,content,location,category_id,status,visual_class,icon) VALUES(?,?,?,?,?,?,?)");
        $stmt->execute([$title,$content,$location,$category_id,$status,$visual,$icon]);
        $message = 'Post added successfully.';
    } else { $message = 'Please fill in all required fields.'; }
}
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id=?");
    $stmt->execute([(int)$_GET['delete']]);
    header("Location: index.php?deleted=1"); exit;
}
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
$posts = $pdo->query("SELECT p.*, c.name AS category_name FROM posts p JOIN categories c ON c.id=p.category_id ORDER BY p.id DESC")->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<div class="container admin-wrap">
 <div class="admin-hero mb-4">
  <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
   <div><div class="kicker text-info">Content management</div><h1 class="fw-bold mt-1">Admin Dashboard</h1><p class="text-white-50 mb-0">Add and manage Discover Egypt posts locally.</p></div>
   <a href="../index.php" class="btn btn-outline-light rounded-pill">View website <i class="bi bi-arrow-up-right"></i></a>
  </div>
 </div>
 <?php if($message || isset($_GET['deleted'])): ?><div class="alert alert-success"><?= htmlspecialchars($message ?: 'Post deleted successfully.') ?></div><?php endif; ?>
 <div class="row g-4">
  <div class="col-lg-5">
   <div class="admin-card">
    <div class="kicker">Create content</div><h3 class="fw-bold mt-2">Add a new place</h3>
    <form method="post" class="mt-3">
      <input type="hidden" name="add_post" value="1">
      <div class="mb-3"><label class="form-label fw-semibold">Title</label><input name="title" class="form-control" placeholder="e.g. Siwa Oasis" required></div>
      <div class="mb-3"><label class="form-label fw-semibold">Location</label><input name="location" class="form-control" placeholder="e.g. Matrouh, Egypt" required></div>
      <div class="mb-3"><label class="form-label fw-semibold">Category</label><select name="category_id" class="form-select" required><option value="">Choose...</option><?php foreach($categories as $c): ?><option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option><?php endforeach; ?></select></div>
      <div class="mb-3"><label class="form-label fw-semibold">Description</label><textarea name="content" class="form-control" rows="5" placeholder="Write a short destination story..." required></textarea></div>
      <div class="row g-2">
       <div class="col-6"><label class="form-label fw-semibold">Visual</label><select name="visual_class" class="form-select"><option value="visual-pyramid">Pyramid</option><option value="visual-sea">Sea</option><option value="visual-temple">Temple</option><option value="visual-desert">Desert</option></select></div>
       <div class="col-6"><label class="form-label fw-semibold">Icon</label><select name="icon" class="form-select"><option value="bi-bank">Temple</option><option value="bi-water">Sea</option><option value="bi-sun">Sun</option><option value="bi-compass">Compass</option></select></div>
      </div>
      <div class="mb-3 mt-3"><label class="form-label fw-semibold">Status</label><select name="status" class="form-select"><option value="published">Published</option><option value="draft">Draft</option></select></div>
      <button class="btn btn-dark rounded-pill px-4 w-100"><i class="bi bi-plus-circle"></i> Add place</button>
    </form>
   </div>
  </div>
  <div class="col-lg-7">
   <div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3"><div><div class="kicker">Database content</div><h3 class="fw-bold mt-2">All posts</h3></div><span class="badge text-bg-dark rounded-pill"><?= count($posts) ?> posts</span></div>
    <div class="table-responsive"><table class="table">
      <thead><tr><th>Place</th><th>Category</th><th>Status</th><th>Action</th></tr></thead>
      <tbody>
      <?php foreach($posts as $p): ?><tr>
        <td><strong><?= htmlspecialchars($p['title']) ?></strong><div class="small text-secondary"><?= htmlspecialchars($p['location']) ?></div></td>
        <td><?= htmlspecialchars($p['category_name']) ?></td>
        <td><span class="badge-status <?= $p['status']==='published'?'published':'draft' ?>"><?= htmlspecialchars($p['status']) ?></span></td>
        <td><a class="btn btn-sm btn-outline-danger rounded-pill confirm-delete" href="?delete=<?= (int)$p['id'] ?>">Delete</a></td>
      </tr><?php endforeach; ?>
      </tbody>
    </table></div>
   </div>
  </div>
 </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
