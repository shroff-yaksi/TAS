<?php
$title = 'Gallery - The Auto Shoppers';
$keywords = 'car workshop gallery, auto service photos, car repair workshop surat';
$description = 'Take a look inside The Auto Shoppers workshop. See our modern equipment, workspace, and the quality care we provide to every vehicle.';
require 'partials/head.php';

$photos = [
    ['file' => 'img/gallery/p06.jpg', 'title' => 'Workshop Entrance',         'caption' => "Surat's newest multi-brand car workshop — open and ready for every make and model."],
    ['file' => 'img/gallery/p10.jpg', 'title' => 'Reception Floor',           'caption' => 'A clean, modern front desk where every service journey begins with a handshake.'],
    ['file' => 'img/gallery/p15.jpg', 'title' => 'Service Advisor\'s Desk',   'caption' => 'Where your service is planned, scoped, and walked through before any spanner turns.'],
    ['file' => 'img/gallery/p07.jpg', 'title' => 'The Service Floor',         'caption' => 'Seven dedicated bays equipped for tyre, alignment, AC, welding, and engine work.'],
    ['file' => 'img/gallery/p12.jpg', 'title' => 'Two-Post Lift Bay',         'caption' => 'Heavy-duty hydraulic lifts give our technicians full access to every underbody job.'],
    ['file' => 'img/gallery/p16.jpg', 'title' => 'A Day on the Floor',        'caption' => 'Honda, Maruti, Hyundai and more — every car gets the same expert attention.'],
    ['file' => 'img/gallery/p04.jpg', 'title' => 'Wheel Alignment Bay',       'caption' => '3D ATS Elgi wheel alignment, balancer, and AC recovery — all under one roof.'],
    ['file' => 'img/gallery/p13.jpg', 'title' => 'Drive-On Alignment Ramp',   'caption' => 'Hantecson alignment ramp flanked by Stanley tool chests for fast turnarounds.'],
    ['file' => 'img/gallery/p11.jpg', 'title' => 'AC Service Machine',        'caption' => 'ATS Elgi Smart Cool handles AC gas recovery, vacuum, and refill in a single cycle.'],
    ['file' => 'img/gallery/p09.jpg', 'title' => 'Pro Paint Booth',           'caption' => 'Spray booth delivers factory-finish paintwork with even airflow and dust-free curing.'],
    ['file' => 'img/gallery/p02.jpg', 'title' => 'Body Repair Bay',           'caption' => 'Climate-controlled paint booth paired with engine crane and tyre changer for one-stop body work.'],
    ['file' => 'img/gallery/p05.jpg', 'title' => 'Dent Pulling Station',      'caption' => 'Spotgun 9000 stud welder and Blue Point booster — dent repair and electrical jobs solved.'],
    ['file' => 'img/gallery/p14.jpg', 'title' => 'Power & Welding Tools',     'caption' => 'Battery chargers, engine starters, and our Spotgun puller stand ready for any electrical job.'],
    ['file' => 'img/gallery/p03.jpg', 'title' => 'Injector Cleaner Station',  'caption' => 'A dedicated bench for fuel injector cleaning, ultrasonic testing, and pressure diagnostics.'],
    ['file' => 'img/gallery/p08.jpg', 'title' => 'Customer Lounge',           'caption' => 'A glass-fronted waiting cabin that lets you watch the work on your car in real time.'],
];
?>

<body>
<?php require 'partials/navbar.php'; ?>

    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-danger text-uppercase">Gallery</h6>
                <h1 class="mb-5">Inside Our Workshop</h1>
            </div>

            <div class="row g-4">
                <?php foreach ($photos as $i => $p): ?>
                    <?php $delay = 0.1 + (($i % 3) * 0.1); ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                        <div class="gallery-item">
                            <div class="gallery-img">
                                <img src="<?php echo htmlspecialchars($p['file']); ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" loading="lazy">
                            </div>
                            <div class="gallery-caption">
                                <h5><?php echo htmlspecialchars($p['title']); ?></h5>
                                <p><?php echo htmlspecialchars($p['caption']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
