<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/img/logo.png') ?>"/>
<title>ระบบบันทึกสต็อกสินค้าสำเร็จรูป</title>
<?php if(session()->get('logged_in')): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 12px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 16px; color: #333; flex-wrap: wrap; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="font-weight: 600; font-size: 20px; color: #007bff;">
        📦 FG-Stock
    </div>

    <?php if(session()->get('logged_in')): ?>
        <div style="text-align: right;">
            💧 <?= session()->get('username') ?> |
            <a href="<?= site_url('/logout') ?>" style="color: #dc3545; text-decoration: none; font-weight: 500;">Logout</a>
        </div>
    <?php endif; ?>
    </div>
<?php endif; ?>
<?= $this->renderSection("content"); ?>