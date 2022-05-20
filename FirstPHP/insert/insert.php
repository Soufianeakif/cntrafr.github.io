
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Contact Form</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="insert.php" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="submit" class="btn btn-primary" name="delete" value="Delete">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<?php
include_once 'db.php';

if(isset($_POST['delete']))
{    
    echo "hellooooooooooo";
    $name = $_POST['name'];
    try {
        $sql = "DELETE FROM firsttable WHERE id=$name";
        $conn->exec($sql);
        echo "Record deleted successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

if(isset($_POST['submit']))
{    
     $name = $_POST['name'];
     $email = $_POST['email'];
     $mobile = $_POST['mobile'];
     try {
        $sql = "INSERT INTO firsttable (ID,TITLE,PRIX)
        VALUES ('$name','$email','$mobile')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
      
      $conn = null;
}



?>