<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Διαχείριση Προσφορών Γευμάτων</title>

  <!-- Bootstrap + DataTables + SearchPanes -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.dataTables.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <style>
    body { background-color: #fff8f0; font-family: 'Segoe UI', sans-serif; padding: 2rem; }
    h1 { color: #ff3c00; text-align: center; margin-bottom: 2rem; }
    table.dataTable thead { background-color: #ffe0cc; }
    .btn-sm { font-size: 0.8rem; padding: 0.25rem 0.5rem; }
  </style>
</head>
<body>
  <h1>Διαχείριση Προσφορών Γευμάτων</h1>

  <div class="container">
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Προσθήκη Προσφοράς</button>

    <table id="mealsTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Κατάστημα</th>
          <th>Πόλη</th>
          <th>Κωδικός Γεύματος</th>
          <th>Γεύμα</th>
          <th>Τιμή</th>
          <th>Ενέργειες</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Προσθήκη Προσφοράς</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addForm">
            <div class="form-group">
              <label>Κατάστημα</label>
              <select id="storeCode" class="form-control" required></select>
            </div>
            <div class="form-group">
              <label>Γεύμα</label>
              <select id="mealCode" class="form-control" required></select>
            </div>
            <button type="submit" class="btn btn-success">Προσθήκη</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Επεξεργασία Προσφοράς</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <input type="hidden" id="editOldStore">
            <input type="hidden" id="editOldMeal">
            <div class="form-group">
              <label>Κατάστημα</label>
              <select id="editStoreCode" class="form-control" required></select>
            </div>
            <div class="form-group">
              <label>Γεύμα</label>
              <select id="editMealCode" class="form-control" required></select>
            </div>
            <button type="submit" class="btn btn-primary">Αποθήκευση</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const apiUrl = 'API/getOffers.php';

    function loadOffers() {
      fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
          const table = $('#mealsTable').DataTable();
          table.clear();
          data.forEach(row => {
            table.row.add([
              row.kodikos,
              row.poli,
              row.geyma_kodikos,
              row.geyma,
              `${parseFloat(row.timi).toFixed(2)} €`,
              `<button class="btn btn-sm btn-primary" onclick="openEditModal('${row.kodikos}', '${row.geyma_kodikos}')">Επεξεργασία</button>
               <button class="btn btn-sm btn-danger" onclick="deleteOffer('${row.kodikos}', '${row.geyma_kodikos}')">Διαγραφή</button>`
            ]);
          });
          table.draw();
        });
    }

    function deleteOffer(store, meal) {
      const formData = new FormData();
      formData.append('_method', 'DELETE');
      formData.append('store', store);
      formData.append('meal', meal);
      fetch(apiUrl, {
        method: 'POST',
        body: formData
      }).then(() => loadOffers());
    }

    function populateDropdowns() {
      fetch('API/getStores.php')
        .then(res => res.json())
        .then(data => {
          const storeSelects = [document.getElementById('storeCode'), document.getElementById('editStoreCode')];
          storeSelects.forEach(select => {
            select.innerHTML = data.map(s => `<option value="${s.kodikos}">${s.kodikos} - ${s.poli}</option>`).join('');
          });
        });

      fetch('API/getMealsSorted.php')
        .then(res => res.json())
        .then(data => {
          const mealSelects = [document.getElementById('mealCode'), document.getElementById('editMealCode')];
          mealSelects.forEach(select => {
            select.innerHTML = data.map(m => `<option value="${m.kodikos}">${m.kodikos} - ${m.onomasia}</option>`).join('');
          });
        });
    }

    function openEditModal(store, meal) {
      document.getElementById('editOldStore').value = store;
      document.getElementById('editOldMeal').value = meal;
      document.getElementById('editStoreCode').value = store;
      document.getElementById('editMealCode').value = meal;
      $('#editModal').modal('show');
    }

    document.getElementById('addForm').addEventListener('submit', e => {
      e.preventDefault();
      const store = document.getElementById('storeCode').value;
      const meal = document.getElementById('mealCode').value;
      const formData = new FormData();
      formData.append('store', store);
      formData.append('meal', meal);
      fetch(apiUrl, {
        method: 'POST',
        body: formData
      }).then(() => {
        $('#addModal').modal('hide');
        document.getElementById('addForm').reset();
        loadOffers();
      });
    });

    document.getElementById('editForm').addEventListener('submit', e => {
      e.preventDefault();
      const oldStore = document.getElementById('editOldStore').value;
      const oldMeal = document.getElementById('editOldMeal').value;
      const newStore = document.getElementById('editStoreCode').value;
      const newMeal = document.getElementById('editMealCode').value;
      const formData = new FormData();
      formData.append('_method', 'PUT');
      formData.append('oldStore', oldStore);
      formData.append('oldMeal', oldMeal);
      formData.append('newStore', newStore);
      formData.append('newMeal', newMeal);
      fetch(apiUrl, {
        method: 'POST',
        body: formData
      }).then(() => {
        $('#editModal').modal('hide');
        loadOffers();
      });
    });

    $(document).ready(function () {
      $('#mealsTable').DataTable({
        searchPanes: { cascadePanes: true, viewTotal: true },
        dom: 'Plfrtip',
        language: { url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Greek.json' }
      });
      loadOffers();
      populateDropdowns();
    });
  </script>
</body>
</html>