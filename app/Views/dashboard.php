<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Welcome, <?= esc($name) ?></h2>
        <p class="text-secondary">เลือกรายงานที่คุณต้องการบันทึก</p>
    </div>

    <div class="row g-4 justify-content-center">
        <?php if ($role === 'admin'): ?>
            <!-- กล่องฝั่งซ้าย: ดอนเมือง -->
            <div class="col-12 col-md-6">
                <?php if (in_array('dfg', $allowedRoutes)): ?>
                    <div class="card border-primary shadow-sm h-50 mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร : ดอนเมือง</h5>
                            <p class="card-text">รายงานยอด stock น้ำถัง 18.9 ลิตร คงเหลืองผลิตประจำวัน</p>
                            <a href="<?= base_url('/dfg') ?>" class="btn btn-primary w-100">บันทึกข้อมูล</a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (in_array('fg', $allowedRoutes)): ?>
                    <div class="card border-primary shadow-sm h-50">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">รายงานยอดสต๊อกคลังสำเร็จรูป : ดอนเมือง</h5>
                            <p class="card-text">บันทึกรายงานสต๊อกคลังสำเร็จรูปคลังดอนเมือง</p>
                            <a href="<?= base_url('/dm') ?>" class="btn btn-primary w-100">บันทึกข้อมูล</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- กล่องฝั่งขวา: วังน้อย -->
            <div class="col-12 col-md-6">
                <?php if (in_array('fgw', $allowedRoutes)): ?>
                    <div class="card border-success shadow-sm h-50 mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title text-success">รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร : วังน้อย</h5>
                            <p class="card-text">รายงานยอด stock น้ำถัง 18.9 ลิตร คงเหลืองผลิตประจำวัน</p>
                            <a href="<?= base_url('/wfg') ?>" class="btn btn-success w-100">บันทึกข้อมูล</a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (in_array('wfg', $allowedRoutes)): ?>
                    <div class="card border-success shadow-sm h-50">
                        <div class="card-body text-center">
                            <h5 class="card-title text-success">รายงานยอดสต๊อกคลังสำเร็จรูป : วังน้อย</h5>
                            <p class="card-text">บันทึกรายงานสต๊อกคลังสำเร็จรูปคลังวังน้อย</p>
                            <a href="<?= base_url('/wn') ?>" class="btn btn-success w-100">บันทึกข้อมูล</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- กล่องเดียวตรงกลางสำหรับ dm หรือ wn -->
            <div class="col-12 col-md-8">
                <?php if ($role === 'dm'): ?>
                    <?php if (in_array('dfg', $allowedRoutes)): ?>
                        <div class="card border-primary shadow-sm h-50 mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร : ดอนเมือง</h5>
                                <p class="card-text">รายงานยอด stock น้ำถัง 18.9 ลิตร คงเหลืองผลิตประจำวัน</p>
                                <a href="<?= base_url('/dfg') ?>" class="btn btn-primary w-100">บันทึกข้อมูล</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (in_array('fg', $allowedRoutes)): ?>
                        <div class="card border-primary shadow-sm h-50">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">รายงานยอดสต๊อกคลังสำเร็จรูป : ดอนเมือง</h5>
                                <p class="card-text">บันทึกรายงานสต๊อกคลังสำเร็จรูปคลังดอนเมือง</p>
                                <a href="<?= base_url('/fg') ?>" class="btn btn-primary w-100">บันทึกข้อมูล</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php elseif ($role === 'wn'): ?>
                    <?php if (in_array('fgw', $allowedRoutes)): ?>
                        <div class="card border-success shadow-sm h-50 mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร : วังน้อย</h5>
                                <p class="card-text">รายงานยอด stock น้ำถัง 18.9 ลิตร คงเหลืองผลิตประจำวัน</p>
                                <a href="<?= base_url('/wfg') ?>" class="btn btn-success w-100">บันทึกข้อมูล</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (in_array('wfg', $allowedRoutes)): ?>
                        <div class="card border-success shadow-sm h-50">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">รายงานยอดสต๊อกคลังสำเร็จรูป : วังน้อย</h5>
                                <p class="card-text">บันทึกรายงานสต๊อกคลังสำเร็จรูปคลังวังน้อย</p>
                                <a href="<?= base_url('/fgw') ?>" class="btn btn-success w-100">บันทึกข้อมูล</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
