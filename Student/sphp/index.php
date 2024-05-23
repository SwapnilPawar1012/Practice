<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <title>Crud Project</title>
</head>

<body>
  <div class="container my-5">
    <h2>List of Students</h2>
    <a class="btn btn-primary" href="/crud/create.php" role="button">Add Student</a>
    <br />
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "!Swapnil1012";
        $database = "crud";

        /* Using mysqli 
        $connection = new mysqli($servername, $username, $password, $database);
        
        if ($connection->connect_error) {
          die("Connection Failed: " . $connection->connect_error);
        }
        
        $sql = "SELECT * FROM student";
        $result = $connection->query($sql);
        $connection.close(); */

        /* Using Procedural mysqli 
        $connection = mysqli_connect($servername, $username, $password, $database);

        if (!$connection) {
          die("Connection Failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM student";
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection); */


        /*
        if (!$result) {
          die("No data found!");
        }

        while ($row = $result->fetch_accos()) {
          echo "
            <tr>
            <td>$row[ID]</td>
            <td>$row[Name]</td>
            <td>$row[Email]</td>
            <td>
              <a class='btn btn-primary' href='/crud/edit.php?ID=$row[ID]' role='button'
                >Edit</a
              >
              <a class='btn btn-danger' href='/crud/delete.php?ID=$row[ID]' role='button'
                >Delete</a
              >
            </td>
          </tr>
            ";
        } */

        /* Using PDO */
        try {
          // Establish connection using PDO
          $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // Prepare and execute SQL statement
          $sql = $connection->prepare("SELECT * FROM student");
          $sql->execute();

          $rows = $sql->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows at once
          foreach ($rows as $row) { // Iterate through each row
            echo "
        <tr>
            <td>" . htmlspecialchars($row['ID']) . "</td>
            <td>" . htmlspecialchars($row['Name']) . "</td>
            <td>" . htmlspecialchars($row['Email']) . "</td>
            <td>
                <a class='btn btn-primary' href='/crud/edit.php?ID=" . urlencode($row['ID']) . "' role='button'>Edit</a>
                <a class='btn btn-danger' href='/crud/delete.php?ID=" . urlencode($row['ID']) . "' role='button'>Delete</a>
            </td>
        </tr>
        ";
          }
        } catch (PDOException $e) {
          die("Connection failed: " . $e->getMessage());
        }

        // Close the connection
        $connection = null;
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>