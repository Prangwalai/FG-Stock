<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/img/logo.png') ?>"/>
    <title>FG-Stock Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, h3, h5, label, button {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4 text-center" style="width: 100%; max-width: 450px;">
        <!-- Logo and System Name -->
        <div class="mb-4">
            <img src="<?= base_url('public/img/logo.png') ?>" alt="Logo" class="mb-2" style="max-width: 100px;">
            <h3 class="fw-bold">ระบบบันทึกสต็อกสินค้าสำเร็จรูป</h3>
        </div>

        <h5 class="mb-3">Login</h5>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?= base_url('/loginAuth') ?>">
            <?= csrf_field() ?>
            
            <div class="mb-3 text-start">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            
            <div class="mb-3 text-start">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
