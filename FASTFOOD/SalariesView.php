<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Μισθοί ανά Πόλη</title>
  <!-- Styles & Scripts -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.dataTables.min.js"></script>
  <style>
    body { background-color: #fff8f0; font-family: 'Segoe UI', sans-serif; padding: 2rem; }
    h1 { color: #ff3c00; text-align: center; margin-bottom: 2rem; }
    table.dataTable thead { background-color: #ffe0cc; }
  </style>
</head>
<body>
  <h1>Μέσος Μισθός ανά Πόλη</h1>
  <div class="container">
    <table id="salaryTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Πόλη</th>
          <th>Μέσος Μισθός (€)</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <script>
    fetch('API/getSalaries.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('#salaryTable tbody');
        data.forEach(row => {
          tbody.innerHTML += `
            <tr>
              <td>${row.poli}</td>
              <td>${parseFloat(row.mesos_misthos).toFixed(2)}</td>
            </tr>`;
        });
        $('#salaryTable').DataTable({
          searchPanes: { cascadePanes: true, viewTotal: true },
          dom: 'Plfrtip'
        });
      });
  </script>
</body>
</html>
