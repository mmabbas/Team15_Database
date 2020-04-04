<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);


  try{
    $sql = "INSERT INTO 'login' ('loginID', 'userPassword') VALUES (userID, userPassword)";
  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
    
  try {
    $sql = "INSERT INTO 'login' ('loginID', 'userPassword') VALUES (userID, userPassword)";  
    $new_cardholder = array(
      "userID"    => $_POST['userID'],
      "loginID"    => $_POST['userID'],
      "firstName" => $_POST['firstName'],
      "lastName"  => $_POST['lastName'],
      "email"     => $_POST['email'],
      "userType"  => $_POST['userType'],
      "age"       => $_POST['age'],
      "fines"     => 0,
      "dayLimit"  => 7,
      "bookLimit"  => 3,
      "quantityCheckedOut"  => 0,
    );

    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "cardholder",
        implode(", ", array_keys($new_cardholder)),
        ":" . implode(", :", array_keys($new_cardholder))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_cardholder);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['firstName']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
  <label for="userID">User ID</label>
  <input type="number" name="userID" id="userID">

  <label for="userPassword">Password</label>
  <input type="password" name="userPassword" id="userPassword">

  <label for="firstName">First Name</label>
  <input type="text" name="firstName" id="firstName">

  <label for="lastName">Last Name</label>
  <input type="text" name="lastName" id="lastName">

  <label for="email">email Address</label>
  <input type="text" name="email" id="email">

  <label for="userType">User Type</label>
  <input type="radio" name="userType"
  <?php if (isset($userType) && $userType=="student") echo "checked";?>
  value="student">Student
  <input type="radio" name="userType"
  <?php if (isset($userType) && $userType=="faculty") echo "checked";?>
  value="faculty">Faculty

  <label for="age">Age</label>
  <input type="number" name="age" id="age">

  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>