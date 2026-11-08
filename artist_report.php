<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "registration");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch artist data
$result = $conn->query("SELECT * FROM artists");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Artist Report</title>
  <script>
    // Auto-download CSV on page load
    window.onload = function() {
      window.location.href = 'generate_artist_csv.php';
    };
  </script>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }
  </style>
</head>
<body>
  <h2>Artist Report</h2>
  <table>
    <tr>
      <?php while ($fieldinfo = $result->fetch_field()): ?>
        <th><?php echo $fieldinfo->name; ?></th>
      <?php endwhile; ?>
    </tr>
    <?php
    // Reset result pointer and fetch again
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()):
    ?>
      <tr>
        <?php foreach ($row as $data): ?>
          <td><?php echo htmlspecialchars($data); ?></td>
        <?php endforeach; ?>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
