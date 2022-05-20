<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" crossorigin="anonymous">
  </head>
      <body>
      <table class = "table">
    <?php
    //Les clefs du tableau étant l'id_acd
    $EMPLOYEES = array(
        1 => array(
            'id_acd' => 1,
            'nombre' => 2,
        ),
        3 => array(
            'id_acd' => 3,
            'nombre' => 4,
        ), 
        5 => array(
            'id_acd' => 5,
            'nombre' => 6,
        ), 
    );
    foreach($EMPLOYEES as $employee)
    {
        $employee = (object)$employee;
    ?>
        <tr>
        <td><?=$employee->id_acd;?></td>
        <td><?=$employee->nombre;?></td>
        <td>
            <!-- https://getbootstrap.com/docs/4.0/components/modal/ -->
            <button
                data-toggle="modal"
                data-target="#myModal"
                class="btn btn-warning btn-open-my-modal"
                data-employee-id = "<?=$employee->id_acd;?>"
                 
            >
             <span class="fa fa-plus" aria-hidden="true"></span>
           </button>
          </td>
       </tr>
    <?php }?>
    </table>
    
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-sm">
       <h4 id = "myModalTitle" style="text-align:center;color:green">Bienvedio {{id_acd}} {{nombre}} </h4>
       </div>
    </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" crossorigin="anonymous"></script>   
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
     
        // On passe notre variables PHP au javascript grace à json_encode.
        var employees = <?=
            json_encode(
                $EMPLOYEES
            ); ?>;
             
        (function($){
             
            var myModalTitle = $( '#myModalTitle' );
            var myModalTitleText = myModalTitle.html();
            var myModal = $( '#myModal' );
            var btnOpenMyModal = $( '.btn-open-my-modal' );
             
            //On remplace le texte original par notre texte
            btnOpenMyModal.on(
                'click',
                function()
                {
                     
                    var btn = $( this );
                    var currentEmployees = employees[parseInt( btn.data( 'employee-id' ) )];
                    myModalTitle.html(
                        myModalTitleText
                        .replace( '{{id_acd}}', currentEmployees.id_acd )
                        .replace( '{{nombre}}', currentEmployees.nombre )                      
                    );                 
                }
            );
 
             
        }(jQuery));
         
    </script>
  </body>
</html>