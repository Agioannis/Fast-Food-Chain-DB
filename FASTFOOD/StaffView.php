<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Προσωπικό</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">

  <!-- jQuery & DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.dataTables.min.js"></script>

  <style>
    body {
      background-color: #fff8f0;
      font-family: 'Segoe UI', sans-serif;
      padding: 2rem;
    }
    h1 {
      color: #ff3c00;
      text-align: center;
      margin-bottom: 2rem;
    }
    table.dataTable thead {
      background-color: #ffe0cc;
    }
  </style>
</head>
<body>
  <h1>Προσωπικό με Θέση που περιέχει "Μάγειρας"</h1>
  <div class="container">
    <table id="staffTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Ονοματεπώνυμο</th>
          <th>Μισθός</th>
          <th>Θέση</th>
          <th>Κατάστημα</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    fetch('API/getStaffFiltered.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('#staffTable tbody');
        data.forEach(staff => {
          tbody.innerHTML += `
            <tr>
              <td>${staff.onomateponymo}</td>
              <td>${parseFloat(staff.misthos).toFixed(2)} €</td>
              <td>${staff.thesi}</td>
              <td>${staff.kodikos_katasthmatos}</td>
            </tr>`;
        });
        $('#staffTable').DataTable({
          searchPanes: { cascadePanes: true, viewTotal: true },
          dom: 'Plfrtip'
        });
      });
  </script>
</body>
</html>
