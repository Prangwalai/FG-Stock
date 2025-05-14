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
<div class="container mt-4">
  <div class="d-flex justify-content-center align-items-center mb-4">
  <h2 class="mb-0" style="text-align: center; color: blue;">รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร คงเหลืองผลิตประจำวัน : ดอนเมือง
  </h2>
  </div>

  <!-- ตารางข้อมูล -->
  <button class="btn btn-primary" onclick="openAddModal()">เพิ่มข้อมูล + </button>
  <table id="stockTable" class="table table-bordered">
    <thead>
      <tr>
        <th style = "text-align: center; background-color: #ffb703;">ปี</th>
        <th style = "text-align: center; background-color: #ffb703;">เดือน</th>
        <th style = "text-align: center; background-color: #ffb703;">รายละเอียด</th>
        <th style = "text-align: center; background-color: #ffb703;">วันที่แก้ไข</th>
        <th style = "text-align: center; background-color: #ffb703;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($summary as $item): ?>
        <tr>
          <td><?= $item->year?></td>
          <td><?= DateTime::createFromFormat('!m', $item->month)->format('F') ?></td>
          <td><button type="button" class="btn btn-light btn-sm" onclick="window.location.href='<?= base_url("dfg/monthlyDetail/{$item->year}/{$item->month}") ?>'">
  ข้อมูลรายงาน
</button></td>
          <td><?= date('d/m/Y H:i น.', strtotime($item->Date)) ?></td>
          <td><a class="btn btn-primary btn-sm" href="<?= base_url("dfg/monthlyDetail/{$item->year}/{$item->month}") ?>">ข้อมูล</a>
          <a href="<?= base_url("dfg/exportPDF/{$item->year}/{$item->month}") ?>" class="btn btn-danger btn-sm" target="_blank">Export PDF</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
<div class="modal fade" id="stockModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="stockForm" method="post" action="<?= base_url('dfg/save') ?>">
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

</body>
</html>
