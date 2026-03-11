<?php
require_once __DIR__ . '/auth.php';
requireAdmin();
require_once __DIR__ . '/../php/db.php';

$db = Database::getInstance();

// Stats
$totalBookings = $db->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
$pendingBookings = $db->query("SELECT COUNT(*) FROM bookings WHERE status = 'pending'")->fetchColumn();
$totalContacts = $db->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$totalSubscribers = $db->query("SELECT COUNT(*) FROM newsletter")->fetchColumn();

// Recent Bookings
$recentBookings = $db->query("SELECT * FROM bookings ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TAS Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --sidebar-width: 250px; }
        body { background-color: #0c0c0e; color: #ffffff; font-family: 'Open Sans', sans-serif; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: #08080a; color: #fff; padding-top: 20px; border-right: 1px solid rgba(255,255,255,0.05); }
        .sidebar .nav-link { color: #888; padding: 15px 25px; border-left: 4px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(227, 30, 36, 0.05); border-left-color: #e31e24; }
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        .card-stats { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; backdrop-filter: blur(10px); }
        .icon-box { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .table { color: #fff; }
        .table-light { background: rgba(255,255,255,0.05); color: #fff; border: none; }
        .text-muted { color: #888 !important; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="px-4 mb-4">
            <h4 class="text-danger"><i class="fa fa-car me-2"></i>TAS Admin</h4>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="index.php"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
            <a class="nav-link" href="bookings.php"><i class="fa fa-calendar-check me-2"></i> Bookings</a>
            <a class="nav-link" href="contacts.php"><i class="fa fa-envelope me-2"></i> Contact Messages</a>
            <a class="nav-link" href="newsletter.php"><i class="fa fa-users me-2"></i> Newsletter</a>
            <a class="nav-link" href="knowledge.php"><i class="fa fa-blog me-2"></i> Car Knowledge</a>
            <hr class="bg-secondary mx-3">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Overview</h3>
            <span class="text-muted">Welcome, <?php echo $_SESSION['username']; ?></span>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Bookings</h6>
                            <h3 class="mb-0"><?php echo $totalBookings; ?></h3>
                        </div>
                        <div class="icon-box bg-primary text-white"><i class="fa fa-calendar-check"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h3 class="mb-0"><?php echo $pendingBookings; ?></h3>
                        </div>
                        <div class="icon-box bg-warning text-white"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">New Messages</h6>
                            <h3 class="mb-0"><?php echo $totalContacts; ?></h3>
                        </div>
                        <div class="icon-box bg-success text-white"><i class="fa fa-envelope"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Newsletter</h6>
                            <h3 class="mb-0"><?php echo $totalSubscribers; ?></h3>
                        </div>
                        <div class="icon-box bg-info text-white"><i class="fa fa-users"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-stats bg-white p-4">
            <h5 class="mb-4">Recent Bookings</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentBookings as $b): ?>
                        <tr>
                            <td><?php echo $b['booking_id']; ?></td>
                            <td><?php echo $b['name']; ?></td>
                            <td><?php echo $b['car_make'] . ' ' . $b['car_model']; ?></td>
                            <td><?php echo $b['service_date']; ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $b['status'] === 'pending' ? 'warning' : ($b['status'] === 'confirmed' ? 'success' : 'secondary'); 
                                ?>">
                                    <?php echo ucfirst($b['status']); ?>
                                </span>
                            </td>
                            <td><a href="bookings.php?id=<?php echo $b['id']; ?>" class="btn btn-sm btn-outline-danger">View</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
