<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Προσφορές</title>

  <!-- Bootstrap CSS -->
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

  <h1>Προσφορές Καταστημάτων</h1>

  <div class="container">
    <table id="offersTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Κατάστημα</th>
          <th>Πόλη</th>
          <th>Γεύμα</th>
          <th>Τιμή (€)</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    fetch('API/getOffers.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('#offersTable tbody');
        data.forEach(row => {
          tbody.innerHTML += `
            <tr>
              <td>${row.kodikos}</td>
              <td>${row.poli}</td>
              <td>${row.geyma}</td>
              <td>${parseFloat(row.timi).toFixed(2)}</td>
            </tr>`;
        });

        $('#offersTable').DataTable({
          searchPanes: { cascadePanes: true, viewTotal: true },
          dom: 'Plfrtip'
        });
      });
  </script>
</body>
</html>
