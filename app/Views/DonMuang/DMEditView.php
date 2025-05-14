<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/img/logo.png') ?>"/>
    <title>แก้ไขรายงานสต๊อกคลังสำเร็จรูป : ดอนเมือง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php if(session()->get('logged_in')): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 12px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 16px; color: #333; flex-wrap: wrap; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="font-weight: 600; font-size: 20px; color: #007bff;">
            <a class="navbar-brand" href="<?= base_url('/dashboard') ?>">📦 FG-Stock</a>
        </div>
        <div style="text-align: right;">
            💧 <?= session()->get('username') ?> |
            <a href="<?= site_url('/logout') ?>" style="color: #dc3545; text-decoration: none; font-weight: 500;">Logout</a>
        </div>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">แก้ไขรายงานสต๊อกคลังสำเร็จรูป : ดอนเมือง</h1>
        <div class="d-flex align-items-center">
            <label for="record_date" class="form-label me-4 mb-2">Date:</label>
            <input type="date" id="record_date" name="record_date" class="form-control" value="<?= esc($record['Date']) ?>" disabled>
        </div>
    </div>

    <form method="post" action="<?= site_url('/fg/update/' . $record['Date']) ?>">
        <?php foreach ($sections as $sec): ?>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <?= esc($sec->section_name) ?>
                </div>
                <div class="card-body row">
                    <?php foreach ($items as $it): ?>
                        <?php if ($it->section === $sec->section_code): ?>
                             <div class="col-md-6 mb-3">
                             <label class="form-label"><?= esc($it->item_name) ?></label>
                             <div class="input-group">
                             <input type="number" name="item[<?= esc($it->item_code) ?>]" class="form-control"
                              value="<?= esc($itemData[$it->item_code]) ?>"
                              onfocus="if(this.value=='0') this.value='';"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                             <span class="input-group-text"><?= esc($it->unit) ?></span>
                             </div>
                             </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div>
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="<?= base_url('/dm') ?>" class="btn btn-dark">ย้อนกลับ</a>
        </div>
    </form>
<footer class="text-center text-muted py-4 mt-5" style="border-top: 1px solid #ccc;">
    <small>© <?= date('Y') ?> Sprinkle FG Stock</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
