<?php
require_once __DIR__ . '/../php/utils.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - The Auto Shoppers</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0c0c0e; color: #ffffff; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; padding: 40px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.5); background: #16161a; border: 1px solid rgba(255,255,255,0.08); }
        .btn-danger { background-color: #E31E24; border-color: #E31E24; }
        .form-control { background-color: #0c0c0e; border-color: rgba(255,255,255,0.1); color: #fff; }
        .form-control:focus { background-color: #1a1a1e; border-color: #E31E24; color: #fff; box-shadow: none; }
        .text-muted { color: #888 !important; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <h2 class="text-danger"><i class="fa fa-car me-2"></i>TAS Admin</h2>
            <p class="text-muted">Sign in to manage your workshop</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="admin">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="admin123">
            </div>
            <button type="submit" class="btn btn-danger w-100 py-2 mt-2">Login</button>
        </form>
        <div class="text-center mt-4">
            <a href="../index.html" class="text-muted small">Return to Website</a>
        </div>
    </div>
</body>
</html>
