
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> | RECEIVED REPORT</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 11px;
      color: #0f172a;
    }

    .page {
      border: 1.5px solid #06b6d4;
      border-radius: 10px;
      padding: 18px;
    }

    .header-table,
    .report-table {
      width: 100%;
      border-collapse: collapse;
    }

    .header-table td {
      vertical-align: middle;
      border: none;
    }

    .logo-box {
      width: 110px;
    }

    .logo {
      width: 96px;
      height: 96px;
      object-fit: contain;
      border: 1px solid #a5f3fc;
      border-radius: 8px;
      padding: 6px;
      background: #ecfeff;
    }

    .report-title {
      color: #0891b2;
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0 0 6px;
    }

    .company-name {
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0 0 4px;
    }

    .company-address,
    .filter-label,
    .report-date {
      font-size: 11px;
      color: #334155;
      margin: 0;
    }

    .divider {
      border-top: 2px solid #06b6d4;
      margin: 14px 0 16px;
    }

    .branch-title {
      margin: 14px 0 8px;
      font-size: 13px;
      font-weight: 700;
      color: #0e7490;
      text-transform: uppercase;
    }

    .report-table th {
      background: #0891b2;
      color: #ffffff;
      border: 1px solid #06b6d4;
      padding: 8px 6px;
      text-align: left;
      font-size: 11px;
      text-transform: uppercase;
    }

    .report-table td {
      border: 1px solid #a5f3fc;
      padding: 7px 6px;
      vertical-align: top;
    }

    .report-table tbody tr:nth-child(even) {
      background: #ecfeff;
    }

    .branch-total-row td,
    .grand-total-row td {
      font-weight: bold;
      background: #cffafe;
    }

    .grand-total-row td {
      background: #a5f3fc;
    }

    .text-right {
      text-align: right;
    }

    .empty-state {
      margin-top: 18px;
      padding: 12px;
      border: 1px solid #a5f3fc;
      background: #ecfeff;
      color: #155e75;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>
<?php
$logo_path = '';
if (!empty($compdata->comp_logo) && file_exists(FCPATH . 'assets/img/' . $compdata->comp_logo)) {
    $logo_path = base_url('assets/img/' . $compdata->comp_logo);
}

$filter_parts = array();
$filter_parts[] = 'From: ' . $from;
$filter_parts[] = 'To: ' . $to;
if (!empty($blanch_data) && !empty($blanch_data->blanch_name)) {
    $filter_parts[] = 'Branch: ' . $blanch_data->blanch_name;
}

$grouped = array();
$grand_total_received = 0;
$grand_total_loan = 0;
$grand_total_count = 0;

if (!empty($data_blanch)) {
    foreach ($data_blanch as $row) {
        $branch_name = !empty($row->blanch_name) ? $row->blanch_name : 'Unknown Branch';
        if (!isset($grouped[$branch_name])) {
            $grouped[$branch_name] = array(
                'rows' => array(),
                'total_received' => 0,
                'total_loan' => 0,
                'count' => 0,
            );
        }

        $grouped[$branch_name]['rows'][] = $row;
        $grouped[$branch_name]['total_received'] += (float) $row->depost;
        $grouped[$branch_name]['total_loan'] += (float) $row->loan_int;
        $grouped[$branch_name]['count']++;

        $grand_total_received += (float) $row->depost;
        $grand_total_loan += (float) $row->loan_int;
        $grand_total_count++;
    }
}
?>

<div class="page">
  <table class="header-table">
    <tr>
      <td class="logo-box">
        <?php if (!empty($logo_path)): ?>
          <img src="<?php echo $logo_path; ?>" class="logo" alt="Company Logo">
        <?php endif; ?>
      </td>
      <td>
        <p class="report-title">Received Report</p>
        <p class="company-name"><?php echo $compdata->comp_name; ?></p>
        <p class="company-address"><?php echo $compdata->adress; ?></p>
        <p class="filter-label"><?php echo implode(' | ', $filter_parts); ?></p>
        <p class="report-date">Generated: <?php echo date('d M Y H:i'); ?></p>
      </td>
    </tr>
  </table>

  <div class="divider"></div>

  <?php if (!empty($grouped)): ?>
    <?php $global_no = 1; ?>
    <?php foreach ($grouped as $branch_name => $branch_data): ?>
      <p class="branch-title"><?php echo $branch_name; ?> (<?php echo $branch_data['count']; ?> customers)</p>
      <table class="report-table">
        <thead>
          <tr>
            <th>S/No.</th>
            <th>Customer Name</th>
            <th>Phone Number</th>
            <th>Duration</th>
            <th>Loan Amount</th>
            <th>Received Amount</th>
            <th>Deposit Method</th>
            <th>Employee</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($branch_data['rows'] as $today_recevables): ?>
            <tr>
              <td><?php echo $global_no++; ?></td>
              <td><?php echo trim($today_recevables->f_name . ' ' . $today_recevables->m_name . ' ' . $today_recevables->l_name); ?></td>
              <td><?php echo $today_recevables->phone_no; ?></td>
              <td>
                <?php
                if ($today_recevables->day == 1) {
                    echo 'Daily';
                } elseif ($today_recevables->day == 7) {
                    echo 'Weekly';
                } elseif (in_array($today_recevables->day, array(28, 29, 30, 31))) {
                    echo 'Monthly';
                } else {
                    echo '-';
                }
                ?>
              </td>
              <td class="text-right"><?php echo number_format((float) $today_recevables->loan_int); ?></td>
              <td class="text-right"><?php echo number_format((float) $today_recevables->depost); ?></td>
              <td><?php echo !empty($today_recevables->pay_method_name) ? $today_recevables->pay_method_name : (!empty($today_recevables->account_name) ? $today_recevables->account_name : 'Not Set'); ?></td>
              <td><?php echo $today_recevables->empl_username; ?></td>
              <td><?php echo date('d M Y', strtotime($today_recevables->depost_day)); ?></td>
            </tr>
          <?php endforeach; ?>
          <tr class="branch-total-row">
            <td colspan="4">Branch Total - <?php echo $branch_name; ?></td>
            <td class="text-right"><?php echo number_format($branch_data['total_loan']); ?></td>
            <td class="text-right"><?php echo number_format($branch_data['total_received']); ?></td>
            <td colspan="3"></td>
          </tr>
        </tbody>
      </table>
    <?php endforeach; ?>

    <table class="report-table" style="margin-top: 14px;">
      <tbody>
        <tr class="grand-total-row">
          <td colspan="4">Grand Total (All Branches) - <?php echo $grand_total_count; ?> customers</td>
          <td class="text-right"><?php echo number_format($grand_total_loan); ?></td>
          <td class="text-right"><?php echo number_format($grand_total_received); ?></td>
          <td colspan="3"></td>
        </tr>
      </tbody>
    </table>
  <?php else: ?>
    <div class="empty-state">No received payments found for the selected filter.</div>
  <?php endif; ?>
</div>
</body>
</html>




