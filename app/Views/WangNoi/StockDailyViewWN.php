<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/img/logo.png') ?>"/>
  <title>บันทึกข้อมูลรายงานยอด Stock</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('public/css/styles.css') ?>">
  <!-- DataTables Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


 <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  
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
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0" style="color: blue;">บันทึกข้อมูลรายวัน ยอดสต๊อกน้ำถัง 18.9 ลิตร : วังน้อย</h2>
    <button class="btn btn-primary" onclick="openAddModal()">เพิ่มข้อมูล + </button>
  </div>
  <form method="get" action="<?= base_url('wfg/dailyView') ?>" class="row g-3 mb-4">
    <div class="col-auto">
        <label for="start_date" class="col-form-label">วันที่เริ่มต้น:</label>
    </div>
    <div class="col-auto">
        <input type="date" id="start_date" name="start_date" class="form-control" required>
    </div>
    <div class="col-auto">
        <label for="end_date" class="col-form-label">ถึงวันที่:</label>
    </div>
    <div class="col-auto">
        <input type="date" id="end_date" name="end_date" class="form-control" required>
    </div>
    <div class="col-auto d-flex align-items-center">
        <button type="submit" class="btn btn-primary me-2">ค้นหา</button>
        <button type="button" onclick="window.location.href='<?= base_url('/wfg/exportExcel') ?>?start_date=<?= isset($startDate) ? $startDate : '' ?>&end_date=<?= isset($endDate) ? $endDate : '' ?>'" class="btn btn-success btn-sm">Export to Excel</button>
    </div>
</form>

  <!-- ตารางข้อมูล -->
  <table id="stockTable" class="table table-bordered">
    <thead>
      <tr>
        <th style = "text-align: center; background-color: #74abff;">วันที่</th>
        <th style = "text-align: center; background-color: #74abff;">ยอด Stock เข้า</th>
        <th style = "text-align: center; background-color: #74abff;">KPI</th>
        <th style = "text-align: center; background-color: #74abff;">ยอดผลิต</th>
        <th style = "text-align: center; background-color: #74abff;">แผนผลิต</th>
        <th style = "text-align: center; background-color: #74abff;">หมายเหตุ</th>
        <th style = "text-align: center; background-color: #74abff;">Action</th>
      </tr>
    </thead>
    <tbody id="stockTableBody">
      <?php foreach($daily as $item): ?>
      <tr>
        <td><?= $item->Date ?></td>
        <td><?= number_format($item->ยอด_stock_เข้า) ?></td>
        <td><?= number_format($item->KPI) ?></td>
        <td><?= number_format($item->ยอดผลิต) ?></td>
        <td><?= number_format($item->แผนผลิต) ?></td>
        <td><?= $item->remark ?></td>
        <td>
          <button class="btn btn-sm btn-warning" onclick='openEditModal(<?= json_encode($item) ?>)'><i class="fas fa-edit"></i> Edit</button>
          <button class="btn btn-sm btn-danger" onclick='openDeleteModal(<?= json_encode($item) ?>)'><i class="fas fa-trash-alt"></i> Delete</button>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div><button type="button"  class="btn btn-dark" onclick="window.location.href='<?= base_url('/dashboard') ?>'">ย้อนกลับ</button></div>
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


<!-- Modal -->
<div class="modal fade" id="stockModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="stockForm" method="post" action="<?= base_url('/wfg/save') ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">บันทึกข้อมูล</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="id">

          <div class="mb-3">
            <label for="stock_date" class="form-label">วันที่</label>
            <input type="date" class="form-control" name="date" id="stock_date" value="<?= date('Y-m-d') ?>">
          </div>

          <div class="mb-3">
            <label for="stock_in" class="form-label">ยอด Stock เข้า</label>
            <input type="number" class="form-control" name="stock_in" id="stock_in" value="0"
            onfocus="if(this.value=='0') this.value='';"
            onblur="if(this.value=='') this.value='0';">
          </div>

          <div class="mb-3">
            <label for="kpi" class="form-label">KPI</label>
            <input type="number" class="form-control" name="kpi" id="kpi" value="0"
            onfocus="if(this.value=='0') this.value='';"
            onblur="if(this.value=='') this.value='0';">
          </div>

          <div class="mb-3">
            <label for="actual_production" class="form-label">ยอดผลิต</label>
            <input type="number" class="form-control" name="actual_production" id="actual_production" value="0"
            onfocus="if(this.value=='0') this.value='';"
            onblur="if(this.value=='') this.value='0';">
          </div>

          <div class="mb-3">
            <label for="planned_production" class="form-label">แผนผลิต</label>
            <input type="number" class="form-control" name="planned_production" id="planned_production" value="0"
            onfocus="if(this.value=='0') this.value='';"
            onblur="if(this.value=='') this.value='0';">
          </div>

          <div class="mb-3">
            <label for="remark" class="form-label">หมายเหตุ</label>
            <textarea class="form-control" name="remark" id="remark"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">บันทึก</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </form>
  </div>
</div>
<footer class="text-center text-muted py-4 mt-5" style="border-top: 1px solid #ccc;">
    <small>© <?= date('Y') ?> Sprinkle FG Stock</small>
</footer>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function openAddModal() {
    document.getElementById("stockForm").reset();
    document.getElementById("id").value = "";
    document.getElementById("stock_date").value = new Date().toISOString().split('T')[0];
    new bootstrap.Modal(document.getElementById("stockModal")).show();
  }

  function openEditModal(data) {
    document.getElementById("id").value = data.ID;
    document.getElementById("stock_date").value = data.Date;
    document.getElementById("stock_in").value = data.ยอด_stock_เข้า;
    document.getElementById("kpi").value = data.KPI;
    document.getElementById("actual_production").value = data.ยอดผลิต;
    document.getElementById("planned_production").value = data.แผนผลิต;
    document.getElementById("remark").value = data.remark;
    new bootstrap.Modal(document.getElementById("stockModal")).show();
  }
</script>

<script>
  $(document).ready(function () {
    $('#stockTable').DataTable({
      "pageLength": 25,
      "lengthChange": false,
      "ordering": true,
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
  function openDeleteModal(item) {
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  deleteModal.show();

  // ตั้งค่าเมื่อคลิกปุ่มยืนยัน
  document.getElementById('confirmDeleteBtn').onclick = function () {
    window.location.href = '<?= site_url('/wfg/delete/') ?>' + item.ID;
  };
}

    function closeDeleteModal() {
        // ปิด Modal เมื่อผู้ใช้คลิกยกเลิก
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

</body>
</html>
