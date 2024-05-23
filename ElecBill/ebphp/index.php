<!-- Design and develop a responsive website to calculate Electricity bill using Django/Springboot/Node JS/ PHP. Condition for first 50 units – Rs. 3.50/unit, for next 100 units – Rs. 4.00/unit, for next 100 units – Rs. 5.20/unit and for units above 250 – Rs. 6.50/unit. You can make the use of bootstrap as well as jQuery. -->
<!-- http://localhost/Assignment_4_RollNo52/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
  <title>Electricity Bill Generator</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      background: #befdfd;
    }

    .main-container {
      display: flex;
      justify-content: space-evenly;
      padding: 80px;
    }

    .btn1 {
      background: linear-gradient(45deg, black, transparent);
    }

    .left-box,
    .right-box {
      width: 500px;
    }

    .right-box h1 {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }

    .total-amount {
      border: 1px solid #444;
      padding: 10px;
      border-radius: 4px;
    }

    .error {
      color: red;
    }

    @media (max-width:1250px) {
      .main-container {
        flex-direction: column;
        align-items: center;
        gap: 70px;
      }
    }

    @media (max-width:600px) {
      .main-container {
        flex-direction: column;
        align-items: center;
        gap: 70px;
      }

      .left-box,
      .right-box {
        width: auto;
      }
    }
  </style>
</head>

<body>
  <?php
  // define variables and set to empty values
  $fname = $lname = $email = $phone = $unitnumber = $totalamount = $error = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $unitnumber = test_input($_POST["unit-number"]);
    $error = error_fun($unitnumber);
    $totalamount = calculate_bill($unitnumber);
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function error_fun($unit)
  {
    if ($unit < 0) {
      return "Invalid Input!, Unit(s) must be positive, Please try again.!";
    }
  }

  // To calculate electricity bill as per unit cost
  function
    calculate_bill(
    $units
  ) {
    $first_unit_cost = 3.50;
    $second_unit_cost = 4.00;
    $third_unit_cost = 5.20;
    $fourth_unit_cost = 6.50;

    if ($units > -1 && $units <= 50) {
      $bill = $units * $first_unit_cost;
    } else if ($units > 50 && $units <= 100) {
      $temp = 50 * $first_unit_cost;
      $remaining_units = $units - 50;
      $bill = $temp +
        ($remaining_units * $second_unit_cost);
    } else if (
      $units > 100 && $units <=
      200
    ) {
      $temp = (50 * 3.5) + (100 * $second_unit_cost);
      $remaining_units = $units
        - 150;
      $bill = $temp + ($remaining_units * $third_unit_cost);
    } else {
      $temp = (50 * 3.5) + (100 * $second_unit_cost) + (100 * $third_unit_cost);
      $remaining_units = $units - 250;
      $bill = $temp + ($remaining_units *
        $fourth_unit_cost);
    }
    return number_format((float) $bill, 2, '.', '');
  }

  ?>
  <div class="main-container">
    <div class="left-box">
      <h1>Enter Details</h1>
      <form id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p><label for="">First Name : </label><input type="text" name="fname" class="form-control" id="fname"
            placeholder="first name" required>
        </p>
        <p><label for="">Last Name : </label><input type="text" name="lname" class="form-control" id="lname"
            placeholder="last name" required></p>
        <p><label for="">E-mail : </label><input type="email" name="email" class="form-control" id="email"
            placeholder="email" required></p>
        <p><label for="">Contact(starts with 7 or 8 or 9) : </label><input type="tel" name="phone" class="form-control"
            id="phone" placeholder="contact number" onkeypress="return isNumberKey(event)" pattern="[7-9]{1}[0-9]{9}"
            maxlength="10" required></p>
        <p><label for="">Unit(s) : </label><input type="number" name="unit-number" class="form-control" id="unit-number"
            placeholder="units" required></p>
        <p><input type="submit" class="btn btn-primary btn1" value="submit"></p>
      </form>
    </div>

    <div class="error">
      <?php
      echo $error
        ?>
    </div>

    <div class=" right-box">
      <h1>Electricity Bill</h1>
      <p>Name :
        <?php echo $fname . " " . $lname; ?>
      </p>
      <p>E-mail :
        <?php echo $email; ?>
      </p>
      <p>Contact :
        <?php echo $phone; ?>
      </p>
      <p>Unit(s) :
        <?php echo $unitnumber ?>
      </p>
      <p class="total-amount">Total Amount :
        <?php echo $totalamount ?>
      </p>
    </div>
  </div>

  <script>
    $('#phone').keypress(function (event) {
      let arr = [];
      let kk = event.which;

      for (i = 48; i < 58; i++)
        arr.push(i);

      if (!(arr.indexOf(kk) >= 0))
        event.preventDefault();
    });

    function isNumberKey(event) {
      let charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }
  </script>
</body>

</html>