<?php
require_once __DIR__ . '/auth.php';
requireAdmin();
require_once __DIR__ . '/../php/db.php';

$db = Database::getInstance();
$msg = '';

// Handle Delete
if (isset($_POST['delete_id'])) {
    $stmt = $db->prepare("SELECT cover_image, image2, image3 FROM knowledge WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    $imgs = $stmt->fetch();
    if ($imgs) {
        foreach (['cover_image', 'image2', 'image3'] as $field) {
            if (!empty($imgs[$field]) && file_exists(__DIR__ . '/../' . $imgs[$field])) {
                unlink(__DIR__ . '/../' . $imgs[$field]);
            }
        }
    }
    $stmt = $db->prepare("DELETE FROM knowledge WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    header('Location: knowledge.php?msg=Article deleted');
    exit;
}

// Handle Toggle Status
if (isset($_POST['toggle_id'])) {
    $stmt = $db->prepare("UPDATE knowledge SET status = CASE WHEN status = 'published' THEN 'draft' ELSE 'published' END WHERE id = ?");
    $stmt->execute([$_POST['toggle_id']]);
    header('Location: knowledge.php?msg=Status updated');
    exit;
}

// Handle Create / Edit
if (isset($_POST['save_article'])) {
    $title = trim($_POST['title'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $videoUrl = trim($_POST['video_url'] ?? '');
    $status = $_POST['status'] ?? 'published';
    $editId = $_POST['edit_id'] ?? '';

    if (empty($title) || empty($content)) {
        $msg = 'Title and content are required.';
    } else {
        // Generate slug
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $title), '-'));
        $slug = substr($slug, 0, 80);

        // Ensure unique slug
        $checkSlug = $slug;
        $counter = 1;
        while (true) {
            $stmt = $db->prepare("SELECT id FROM knowledge WHERE slug = ? AND id != ?");
            $stmt->execute([$checkSlug, $editId ?: 0]);
            if (!$stmt->fetch()) break;
            $checkSlug = $slug . '-' . $counter++;
        }
        $slug = $checkSlug;

        // Handle image uploads
        $uploadDir = __DIR__ . '/../uploads/knowledge/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageFields = ['cover_image', 'image2', 'image3'];
        $imagePaths = [];

        foreach ($imageFields as $field) {
            if (!empty($_FILES[$field]['name']) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed)) {
                    $filename = $slug . '-' . $field . '-' . time() . '.' . $ext;
                    $dest = $uploadDir . $filename;
                    if (move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) {
                        $imagePaths[$field] = 'uploads/knowledge/' . $filename;
                    }
                }
            }
        }

        if (!empty($editId)) {
            // Update existing
            $existing = $db->prepare("SELECT cover_image, image2, image3 FROM knowledge WHERE id = ?");
            $existing->execute([$editId]);
            $existingData = $existing->fetch();

            foreach ($imageFields as $field) {
                if (!isset($imagePaths[$field])) {
                    $imagePaths[$field] = $existingData[$field] ?? '';
                }
            }

            $stmt = $db->prepare("UPDATE knowledge SET slug=?, title=?, summary=?, content=?, cover_image=?, image2=?, image3=?, video_url=?, status=? WHERE id=?");
            $stmt->execute([$slug, $title, $summary, $content, $imagePaths['cover_image'], $imagePaths['image2'], $imagePaths['image3'], $videoUrl, $status, $editId]);
            header('Location: knowledge.php?msg=Article updated');
        } else {
            // Insert new
            $stmt = $db->prepare("INSERT INTO knowledge (slug, title, summary, content, cover_image, image2, image3, video_url, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$slug, $title, $summary, $content, $imagePaths['cover_image'] ?? '', $imagePaths['image2'] ?? '', $imagePaths['image3'] ?? '', $videoUrl, $status]);
            header('Location: knowledge.php?msg=Article created');
        }
        exit;
    }
}

// Load article for editing
$editArticle = null;
if (isset($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM knowledge WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editArticle = $stmt->fetch();
}

// Fetch all articles
$articles = $db->query("SELECT * FROM knowledge ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Knowledge - TAS Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --sidebar-width: 250px; }
        body { background-color: #f4f6f9; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: #2c3e50; color: #fff; padding-top: 20px; }
        .sidebar .nav-link { color: #bdc3c7; padding: 15px 25px; border-left: 4px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: #34495e; border-left-color: #e31e24; }
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        .card-stats { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .thumb-preview { width: 80px; height: 55px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="px-4 mb-4">
            <h4 class="text-danger"><i class="fa fa-car me-2"></i>TAS Admin</h4>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="index.php"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
            <a class="nav-link" href="bookings.php"><i class="fa fa-calendar-check me-2"></i> Bookings</a>
            <a class="nav-link" href="contacts.php"><i class="fa fa-envelope me-2"></i> Contact Messages</a>
            <a class="nav-link" href="newsletter.php"><i class="fa fa-users me-2"></i> Newsletter</a>
            <a class="nav-link active" href="knowledge.php"><i class="fa fa-blog me-2"></i> Car Knowledge</a>
            <hr class="bg-secondary mx-3">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><?php echo $editArticle ? 'Edit Article' : 'Car Knowledge'; ?></h3>
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success py-1 px-3 mb-0"><?php echo htmlspecialchars($_GET['msg']); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <!-- Article Form -->
        <div class="card card-stats bg-white p-4 mb-4">
            <h5 class="mb-3"><?php echo $editArticle ? 'Edit Article' : 'Add New Article'; ?></h5>
            <form method="POST" enctype="multipart/form-data">
                <?php if ($editArticle): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $editArticle['id']; ?>">
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($editArticle['title'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="published" <?php echo ($editArticle['status'] ?? '') === 'published' ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?php echo ($editArticle['status'] ?? '') === 'draft' ? 'selected' : ''; ?>>Draft</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Summary <small class="text-muted">(short preview text for the card)</small></label>
                        <input type="text" name="summary" class="form-control" maxlength="200" value="<?php echo htmlspecialchars($editArticle['summary'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="8" required><?php echo htmlspecialchars($editArticle['content'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cover Image</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                        <?php if (!empty($editArticle['cover_image'])): ?>
                            <img src="../<?php echo htmlspecialchars($editArticle['cover_image']); ?>" class="thumb-preview mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Photo 2 <small class="text-muted">(optional)</small></label>
                        <input type="file" name="image2" class="form-control" accept="image/*">
                        <?php if (!empty($editArticle['image2'])): ?>
                            <img src="../<?php echo htmlspecialchars($editArticle['image2']); ?>" class="thumb-preview mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Photo 3 <small class="text-muted">(optional)</small></label>
                        <input type="file" name="image3" class="form-control" accept="image/*">
                        <?php if (!empty($editArticle['image3'])): ?>
                            <img src="../<?php echo htmlspecialchars($editArticle['image3']); ?>" class="thumb-preview mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Video URL <small class="text-muted">(YouTube link)</small></label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="<?php echo htmlspecialchars($editArticle['video_url'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" name="save_article" class="btn btn-danger w-100"><?php echo $editArticle ? 'Update Article' : 'Publish Article'; ?></button>
                    </div>
                </div>
            </form>
            <?php if ($editArticle): ?>
                <a href="knowledge.php" class="btn btn-outline-secondary mt-3">Cancel Editing</a>
            <?php endif; ?>
        </div>

        <!-- Articles List -->
        <div class="card card-stats bg-white p-4">
            <h5 class="mb-3">All Articles (<?php echo count($articles); ?>)</h5>
            <?php if (empty($articles)): ?>
                <p class="text-muted">No articles yet. Create your first one above.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $a): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($a['cover_image'])): ?>
                                        <img src="../<?php echo htmlspecialchars($a['cover_image']); ?>" class="thumb-preview">
                                    <?php else: ?>
                                        <div class="thumb-preview bg-light d-flex align-items-center justify-content-center"><i class="fa fa-image text-muted"></i></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($a['title']); ?></strong>
                                    <?php if (!empty($a['video_url'])): ?>
                                        <i class="fa fa-play-circle text-danger ms-1" title="Has video"></i>
                                    <?php endif; ?>
                                </td>
                                <td><small><?php echo date('M j, Y', strtotime($a['created_at'])); ?></small></td>
                                <td>
                                    <span class="badge bg-<?php echo $a['status'] === 'published' ? 'success' : 'secondary'; ?>">
                                        <?php echo ucfirst($a['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="../knowledge.php?slug=<?php echo urlencode($a['slug']); ?>" target="_blank" class="btn btn-sm btn-outline-primary me-1" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="knowledge.php?edit=<?php echo $a['id']; ?>" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="toggle_id" value="<?php echo $a['id']; ?>">
                                        <button class="btn btn-sm btn-outline-info me-1" title="Toggle status"><i class="fa fa-<?php echo $a['status'] === 'published' ? 'eye-slash' : 'eye'; ?>"></i></button>
                                    </form>
                                    <form method="POST" class="d-inline" onsubmit="return confirm('Delete this article permanently?')">
                                        <input type="hidden" name="delete_id" value="<?php echo $a['id']; ?>">
                                        <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
