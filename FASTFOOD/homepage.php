<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fast Food Offers</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fff8f0;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #ff3c00;
      color: white;
      padding: 1rem 2rem;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    nav {
      background-color: #ffe6d5;
      padding: 1rem;
      display: flex;
      justify-content: center;
      gap: 1rem;
    }
    nav a {
      text-decoration: none;
      color: #ff3c00;
      font-weight: bold;
      border: 2px solid #ff3c00;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    nav a:hover {
      background-color: #ff3c00;
      color: white;
    }
    main {
      padding: 2rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      background-color: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 1rem;
      border: 1px solid #f5c6aa;
      text-align: center;
    }
    th {
      background-color: #ffd4b3;
    }
  </style>
</head>
<body>
  <header>
    Fast Food Chain Dashboard
  </header>

  <nav>
    <a href="StoresView.php">Καταστήματα</a>
    <a href="OffersView.php">Προσφορές</a>
    <a href="SalariesView.php">Μισθοί</a>
    <a href="StaffView.php">Προσωπικό</a>
    <a href="MealsView.php">Γεύματα</a>
    <a href="OrdersView.php">Παραγγελίες</a>
  </nav>

  <main>
    <h2>Καλώς ήρθατε στην πλατφόρμα διαχείρισης!</h2>
    <p>Επιλέξτε μία από τις παραπάνω προβολές για να δείτε δεδομένα από τη βάση.</p>
  </main>
</body>
</html>