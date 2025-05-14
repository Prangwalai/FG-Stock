<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/img/logo.png') ?>"/>
  <title>ข้อมูลรายงานยอด Stock น้ำถัง 18.9 ลิตร</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <link rel="stylesheet" href="<?= base_url('public/css/styles.css') ?>">
</head>
<body>
    <!-- Navbar -->
    <?php if(session()->get('logged_in')): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 12px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 16px; color: #333; flex-wrap: wrap; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="font-weight: 600; font-size: 20px; color: #007bff;">
    <a class="navbar-brand" href="<?= base_url('/dashboard') ?>">📦 FG-Stock</a>
    </div>

    <?php if(session()->get('logged_in')): ?>
        <div style="text-align: right;">
            💧 <?= session()->get('username') ?> |
            <a href="<?= site_url('/logout') ?>" style="color: #dc3545; text-decoration: none; font-weight: 500;">Logout</a>
        </div>
    <?php endif; ?>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">รายการบันทึกข้อมูลประจำวัน : วังน้อย</h2> 
    
    <form method="get" action="<?= base_url('wfg/dailyView') ?>" class="row g-3 mb-4 align-items-end">
    <div class="col-auto">
        <label for="start_date" class="col-form-label">วันที่เริ่มต้น:</label>
    </div>
    <div class="col-auto">
        <input type="date" id="start_date" name="start_date" class="form-control form-control-sm" required>
    </div>
    <div class="col-auto">
        <label for="end_date" class="col-form-label">ถึงวันที่:</label>
    </div>
    <div class="col-auto">
        <input type="date" id="end_date" name="end_date" class="form-control form-control-sm" required>
    </div>
    <div class="col-auto d-flex gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fas fa-search me-1"></i> ค้นหา
        </button>
        <button type="button" class="btn btn-sm btn-success"
            onclick="window.location.href='<?= base_url('/wfg/exportExcel') ?>?start_date=<?= isset($startDate) ? $startDate : '' ?>&end_date=<?= isset($endDate) ? $endDate : '' ?>'">
            <i class="fas fa-file-excel me-1"></i> Export to Excel
        </button>
        <button type="button" class="btn btn-sm btn-secondary"
            onclick="window.location.href='<?= site_url('fwg/wnhome') ?>'">
            <i class="fas fa-plus me-1"></i> บันทึกข้อมูล
        </button>
    </div>
   </form>


    <?php if (!empty($records)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="stockTable">
                <thead class="table-warning text-center">
                    <tr>
                        <th style = "text-align: center; background-color: #ffb703;">วันที่บันทึก</th>
                        <th style = "text-align: center; background-color: #ffb703;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td class="text-center" data-order="<?= date('Y-m-d', strtotime($record['Date'])) ?>">
                            <?= date('d/m/Y', strtotime($record['Date'])) ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= site_url('/fwg/wnview/' . $record['Date']) ?>" class="btn btn-sm btn-light me-2">
                                    <i class="fas fa-eye"></i> ดูรายละเอียด
                                </a>
                                <a href="<?= site_url('/fwg/wnedit/' . $record['Date']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                                <button class="btn btn-sm btn-danger" onclick='openDeleteModal(<?= json_encode($record) ?>)'><i class="fas fa-trash-alt"></i> Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary text-center">ไม่มีข้อมูลรายการสต๊อก</div>
    <?php endif; ?>
    <a href="<?= base_url('/dashboard') ?>" class="btn btn-dark">ย้อนกลับ</a>
</div>

<!-- Modal สำหรับยืนยันการลบ-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">ยืนยันการลบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?
      </div>
      <div class="modal-footer">
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">ยืนยัน</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    var table = $('#stockTable').DataTable({
      "pageLength": 25,
      "lengthChange": false,
      "ordering": true,
      "searching": false, 
      "language": {
        "search": "ค้นหา:",
        "paginate": {
          "previous": "ก่อนหน้า",
          "next": "ถัดไป"
        },
        "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
        "infoEmpty": "ไม่มีข้อมูล",
        "zeroRecords": "ไม่พบข้อมูลที่ค้นหา"
      }
    });
  });
</script>
<script>
    function openDeleteModal(record) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();

  // ตั้งค่าเมื่อคลิกปุ่มยืนยัน
    document.getElementById('confirmDeleteBtn').onclick = function () {
    window.location.href = '<?= site_url('/fwg/delete/') ?>' + record.ID;
    };
  }

    function closeDeleteModal() {
        // ปิด Modal เมื่อผู้ใช้คลิกยกเลิก
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

</body>
<footer class="text-center text-muted py-4 mt-5" style="border-top: 1px solid #ccc;">
    <small>© <?= date('Y') ?> Sprinkle FG Stock</small>
</footer>
</html>
