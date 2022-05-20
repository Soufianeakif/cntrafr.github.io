
<?php
    $nom = "Taha";
    $age = 17;
    $x=0;

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = test_input($_POST["name"]);
    }
    /////////////////////////////
    
    do{
        $pair=rand(1,100);
        $impair1=rand(1,100);
        $impair2=rand(1,100);
        echo "[$pair ,$impair1 ,$impair2]";
    }while($pair%2 != 0 || $impair1%2 != 1 || $impair2%2 != 1);


    echo "<br><br>";
    $z = 333;
    $i = 0;

    for($i ; $i<=($i+1) ; $i++){
        $rand=rand(320,340);
        if($rand == $z){
            echo "[$i ,$z ,$rand]";
            break;
        }
        else
            echo "non | ";

    }
    echo "<br><br>";
    $lettre="";
    $lettre2="";
    for($ii=11 ; $ii<=36 ; $ii++){
        $lettre = chr($ii+54);
        $lettre2 = chr($ii+86);
        $table[$ii] = $lettre ;
        echo "$table[$ii]";

        echo " 
            <table align='center' border='2px solid black'>
                <tr>
                    <td align='center' width='50px'>$lettre</td>
                    <td align='center' width='50px'>$lettre2</td>
                </tr>
            </table>
        ";
    }

?> 

<html>
<head>
    <body>
        <h1>hahaha</h1>
        <h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <input type="text" name="name" value="<?php echo $x; ?>">

        </form>
        <br>
            <?php
                echo "X is :  $x";
                echo "<br>Bonjour Mr $nom vous avez $age ans <br>";

                if ($x%3==0 and $x%5==0)
                    echo "VALID";
                else
                    echo "INVALID";
            ?> 
        </h2>


        
    </body>
</head>
</html>

