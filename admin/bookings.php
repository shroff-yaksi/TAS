<?php
require_once __DIR__ . '/auth.php';
requireAdmin();
require_once __DIR__ . '/../php/db.php';

$db = Database::getInstance();

// Handle Status Update
if (isset($_POST['update_status'])) {
    $id = $_POST['booking_id'];
    $status = $_POST['status'];
    $stmt = $db->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    header('Location: bookings.php?msg=Status updated');
    exit;
}

// Fetch Bookings
$bookings = $db->query("SELECT * FROM bookings ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings - TAS Admin</title>
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
            <a class="nav-link active" href="bookings.php"><i class="fa fa-calendar-check me-2"></i> Bookings</a>
            <a class="nav-link" href="contacts.php"><i class="fa fa-envelope me-2"></i> Contact Messages</a>
            <a class="nav-link" href="newsletter.php"><i class="fa fa-users me-2"></i> Newsletter</a>
            <a class="nav-link" href="knowledge.php"><i class="fa fa-blog me-2"></i> Car Knowledge</a>
            <hr class="bg-secondary mx-3">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Service Bookings</h3>
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success py-1 px-3 mb-0"><?php echo $_GET['msg']; ?></div>
            <?php endif; ?>
        </div>

        <div class="card card-stats bg-white p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Vehicle</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bookings as $b): ?>
                        <tr>
                            <td><small class="text-muted"><?php echo $b['booking_id']; ?></small></td>
                            <td><strong><?php echo $b['name']; ?></strong></td>
                            <td><?php echo $b['phone']; ?><br><small><?php echo $b['email']; ?></small></td>
                            <td><?php echo $b['car_make'] . ' ' . $b['car_model']; ?><br><small><?php echo $b['registration_number']; ?></small></td>
                            <td><?php echo $b['service_date']; ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $b['status'] === 'pending' ? 'warning' : ($b['status'] === 'confirmed' ? 'success' : ($b['status'] === 'completed' ? 'primary' : 'secondary')); 
                                ?>">
                                    <?php echo ucfirst($b['status']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="booking_id" value="<?php echo $b['id']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $b['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $b['status'] === 'confirmed' ? 'selected' : ''; ?>>Confirm</option>
                                        <option value="completed" <?php echo $b['status'] === 'completed' ? 'selected' : ''; ?>>Complete</option>
                                        <option value="cancelled" <?php echo $b['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancel</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
