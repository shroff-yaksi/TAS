<?php
require_once __DIR__ . '/auth.php';
requireAdmin();
require_once __DIR__ . '/../php/db.php';

$db = Database::getInstance();
$contacts = $db->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages - TAS Admin</title>
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
            <a class="nav-link active" href="contacts.php"><i class="fa fa-envelope me-2"></i> Contact Messages</a>
            <a class="nav-link" href="newsletter.php"><i class="fa fa-users me-2"></i> Newsletter</a>
            <a class="nav-link" href="knowledge.php"><i class="fa fa-blog me-2"></i> Car Knowledge</a>
            <hr class="bg-secondary mx-3">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Contact Messages</h3>
        </div>

        <div class="card card-stats bg-white p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($contacts as $c): ?>
                        <tr>
                            <td><small><?php echo date('d M Y', strtotime($c['created_at'])); ?></small></td>
                            <td><strong><?php echo $c['name']; ?></strong></td>
                            <td><?php echo $c['email']; ?><br><?php echo $c['phone']; ?></td>
                            <td><?php echo $c['subject']; ?></td>
                            <td><div style="max-width: 300px; font-size: 0.9rem;"><?php echo nl2br($c['message']); ?></div></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
