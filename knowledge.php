<?php
$title = 'Car Knowledge - The Auto Shoppers';
$keywords = 'car tips, car maintenance blog, auto knowledge, car care tips surat';
$description = 'Expert car knowledge and tips from The Auto Shoppers. Learn about car maintenance, repair insights, and automotive best practices.';
require 'partials/head.php';
require 'php/db.php';

$db = Database::getInstance();

// Single article view
if (isset($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);
    $stmt = $db->prepare("SELECT * FROM knowledge WHERE slug = ? AND status = 'published'");
    $stmt->execute([$slug]);
    $article = $stmt->fetch();

    if (!$article) {
        header('Location: knowledge.php');
        exit;
    }
}

// Listing view
if (!isset($article)) {
    $articles = $db->query("SELECT * FROM knowledge WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
}
?>

<body>
<?php require 'partials/navbar.php'; ?>

<?php if (isset($article)): ?>
    <!-- Single Article View -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <a href="knowledge.php" class="btn btn-outline-danger mb-4"><i class="fa fa-arrow-left me-2"></i>Back to Articles</a>

                    <h1 class="mb-3 wow fadeInUp" data-wow-delay="0.1s"><?php echo htmlspecialchars($article['title']); ?></h1>
                    <p class="text-muted mb-4"><i class="fa fa-calendar-alt me-2"></i><?php echo date('F j, Y', strtotime($article['created_at'])); ?></p>

                    <?php if (!empty($article['cover_image'])): ?>
                        <div class="mb-4 wow fadeInUp" data-wow-delay="0.2s">
                            <img src="<?php echo htmlspecialchars($article['cover_image']); ?>" class="img-fluid rounded w-100" style="max-height: 500px; object-fit: cover;" alt="<?php echo htmlspecialchars($article['title']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($article['video_url'])): ?>
                        <div class="ratio ratio-16x9 mb-4 wow fadeInUp" data-wow-delay="0.3s">
                            <?php
                            $videoUrl = $article['video_url'];
                            // Convert YouTube URLs to embed format
                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                            }
                            ?>
                            <iframe src="<?php echo htmlspecialchars($videoUrl); ?>" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <div class="knowledge-content mb-4 wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                    </div>

                    <?php if (!empty($article['image2']) || !empty($article['image3'])): ?>
                        <div class="row g-3 mb-4 wow fadeInUp" data-wow-delay="0.4s">
                            <?php if (!empty($article['image2'])): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo htmlspecialchars($article['image2']); ?>" class="img-fluid rounded w-100" style="height: 300px; object-fit: cover;" alt="Article image">
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($article['image3'])): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo htmlspecialchars($article['image3']); ?>" class="img-fluid rounded w-100" style="height: 300px; object-fit: cover;" alt="Article image">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- Articles Listing -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-danger text-uppercase">Car Knowledge</h6>
                <h1 class="mb-5">Tips, Insights & Expert Advice</h1>
            </div>

            <!-- Workshop Showcase: Videos -->
            <?php
            $videos = glob('img/knowledge/videos/*.mp4');
            sort($videos);
            ?>
            <?php if (!empty($videos)): ?>
                <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-danger text-uppercase">Workshop in Action</h6>
                    <h2 class="mb-4">See Our Team at Work</h2>
                    <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">Behind-the-scenes footage from our service bays — diagnostics, detailing, and the craftsmanship that goes into every vehicle we touch.</p>
                </div>
                <div class="row g-4 mb-5">
                    <?php foreach ($videos as $i => $v): ?>
                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo 0.1 + ($i % 2) * 0.1; ?>s">
                            <div class="media-video-card">
                                <video controls preload="metadata" playsinline>
                                    <source src="<?php echo htmlspecialchars($v); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center mt-5 pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-danger text-uppercase">Articles</h6>
                    <h2 class="mb-4">Read Our Latest Tips</h2>
                </div>
            <?php endif; ?>

            <?php if (empty($articles)): ?>
                <div class="text-center py-5">
                    <i class="fa fa-book-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No articles yet. Check back soon for expert car tips and knowledge!</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($articles as $i => $a): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo 0.1 + ($i % 3) * 0.2; ?>s">
                            <a href="knowledge.php?slug=<?php echo urlencode($a['slug']); ?>" class="text-decoration-none">
                                <div class="knowledge-card h-100">
                                    <div class="knowledge-card-img">
                                        <?php if (!empty($a['cover_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($a['cover_image']); ?>" alt="<?php echo htmlspecialchars($a['title']); ?>">
                                        <?php else: ?>
                                            <div class="knowledge-card-placeholder">
                                                <i class="fa fa-car fa-3x text-danger"></i>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($a['video_url'])): ?>
                                            <span class="knowledge-card-video-badge"><i class="fa fa-play"></i></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="knowledge-card-body">
                                        <small class="text-muted"><i class="fa fa-calendar-alt me-1"></i><?php echo date('M j, Y', strtotime($a['created_at'])); ?></small>
                                        <h5 class="mt-2 mb-2"><?php echo htmlspecialchars($a['title']); ?></h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($a['summary'] ?: mb_substr(strip_tags($a['content']), 0, 120) . '...'); ?></p>
                                    </div>
                                    <div class="knowledge-card-footer">
                                        <span class="text-danger fw-bold">Read More <i class="fa fa-arrow-right ms-1"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
