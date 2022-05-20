
<?php
  $n = strtotime("-1 hour",strtotime("now"));
  $x = date('Y-m-d\TH:i:s',$n);
  echo $x ;
?>

<input type="datetime-local" id="meeting-time"
       name="meeting-time" 
       min="<?php echo $x ?>" max="">


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="jquery.datetimepicker.min.css"/>

</head>
<body>
  
  <div class="container mt-5 mb-5" style="width: 400px">
    <h3>start date:</h3>
    <input type="text" id="picker1" class="form-control">
    <h3>end date:</h3>
    <input type="text" id="picker2" class="form-control">
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="jquery.datetimepicker.full.min.js"></script>

  <script>
      $('#picker1').datetimepicker({
          timepicker: true,
          datepicker: true,
          format: 'Y-m-d H:1',
          onShow: function(ct){
              this.setOption({
                maxDate: $('#picker2').val() ? $('#picker2').val() : false 
              })
          }

      })

      $('#picker2').datetimepicker({
          timepicker: true,
          datepicker: true,
          format: 'Y-m-d H:1',
          onShow: function(ct){
              this.setOption({
                minDate: $('#picker1').val() ? $('#picker1').val() : false 
              })
          }

      })

  </script>

</body>
</html>

