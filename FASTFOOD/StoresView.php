<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Καταστήματα</title>
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
  <h1>Καταστήματα</h1>
  <div class="container">
    <table id="storesTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Κωδικός</th>
          <th>Πόλη</th>
          <th>Εμβαδόν (τ.μ.)</th>
          <th>Τηλέφωνο</th>
          <th>Ημερομηνία Ίδρυσης</th>
          <th>Υπάλληλοι</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <script>
    fetch('API/getStores.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('#storesTable tbody');
        data.forEach(store => {
          tbody.innerHTML += `
            <tr>
              <td>${store.kodikos}</td>
              <td>${store.poli}</td>
              <td>${store.emvadon}</td>
              <td>${store.tilefono}</td>
              <td>${store.hmer_rydrisis}</td>
              <td>${store.synolikoi_ypalliloi}</td>
            </tr>`;
        });
        $('#storesTable').DataTable({
          searchPanes: { cascadePanes: true, viewTotal: true },
          dom: 'Plfrtip'
        });
      });
  </script>
</body>
</html>
