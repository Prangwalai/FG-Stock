<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body, h1, h2, h3, th, td {
            font-family: 'THSarabunNew', Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th {
            background-color: #74abff;
            font-weight: bold;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<h1>ข้อมูลรายวันยอดสต๊อกน้ำถัง 18.9 ลิตร : วังน้อย</h1>
    <table>
        <thead>
            <tr>
                <th>วันที่</th>
                <th>ยอด Stock เข้า</th>
                <th>KPI</th>
                <th>ยอดผลิต</th>
                <th>แผนผลิต</th>
                <th>หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daily as $item): ?>
                <tr>
                    <td><?= $item->Date ?></td>
                    <td><?= number_format($item->ยอด_stock_เข้า) ?></td>
                    <td><?= number_format($item->KPI) ?></td>
                    <td><?= number_format($item->ยอดผลิต) ?></td>
                    <td><?= number_format($item->แผนผลิต) ?></td>
                    <td><?= esc($item->remark) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
