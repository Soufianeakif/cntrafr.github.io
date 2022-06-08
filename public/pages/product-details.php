<?php
session_start();
include_once('config.php');
    
$product_id = $_GET["id_product"];

    if($product_id == ''){
        header('location: 404.html');
    }


    $statement = $db->prepare("select ID_Produit,ID_TypeProduit,Produit_name,Prix,old_prix,Nom,Description,Status,image_file_name,climatisation,place FROM produit
                                INNER JOIN type_produit
                                ON produit.ID_TypeProduit = type_produit.ID
                                where Status=1 and ID_Produit = ?
                                order by ID_Produit");
            $statement->execute(array($product_id));
    $results = $statement->fetchAll();

            $Descri = $results[0]['Description'];           
            $nprix = $results[0]['Prix'];
            $var3 = $results[0]['Produit_name'];
            $var4 = $results[0]['image_file_name'];
            $clim = $results[0]['climatisation'];
            $n_place = $results[0]['place'];
            $nom = $results[0]['Nom'];
            $oprix = $results[0]['old_prix'];
            $Status = $results[0]['Status'];
            if($Status == 0 or $product_id == ''){
                header('location: 404.html');
            }
            //echo $var1 . ' and ' . $var2 . ' and ' . $var3;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Starter Template - Nordic Shop: Tailwind Toolbox</title>
    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">
    
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

    <style>
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }
                
        #menu-toggle:checked + #menu {
            display: block;
        }
        
        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }
        
        .hover\:grow:hover {
            transform: scale(1.02);
        }
        
        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }
        
        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }
        
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }
        
        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }
        
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
    </style>

</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

    <!--Nav-->
    <nav id="header" class="w-full z-30 top-0 py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle" />

            <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                <nav>
                    <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                        <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="#">Shop</a></li>
                        <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="about.php">About</a></li>
                    </ul>
                </nav>
            </div>

            <div class="order-1 md:order-2">
                <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="products.php">
                    <!-- <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"> -->
                        <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                    </svg>
                    Centres d'affaires
                </a>
            </div>

            <div class="order-2 md:order-3 flex items-center" id="nav-content">

                <a class="inline-block no-underline hover:text-black" href="#">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle fill="none" cx="12" cy="7" r="3" />
                        <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                    </svg>
                </a>

                <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                        <circle cx="10.5" cy="18.5" r="1.5" />
                        <circle cx="17.5" cy="18.5" r="1.5" />
                    </svg>
                </a>

            </div>
        </div>
    </nav>


    <!--	 

Alternatively if you want to just have a single hero

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

	<div class="container mx-auto">

		<div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
			<h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
			<a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">products</a>

		</div>

	  </div>

</section>

-->

<!-- start -->

<section class="bg-white py-8">
    <main class="flex flex-col xl:flex-row ">
    <div class="w-full xl:w-1/2 my-4 flex justify-center">
        <div class="w-4/6">
        <h1 class="tracking-tight font-light text-gray-500 text-4xl "><?php echo $var3; ?></h3>
        <hr>
            <h1 class="text-6xl md:text-8xl tracking-tight leading-none font-extrabold text-cyan-500"><?php echo $nom; ?></h1>
            <p class="text-lg text-gray-500 mt-2"><?php echo $Descri; ?></p>
            
            
            <p class="text-lg tracking-tight leading-none text-cyan-500 mt-2"><img class="inline-flex h-5 w-5 mr-2 mb-1" src="https://www.svgrepo.com/show/82364/ice-crystal.svg" alt=""><b>Air conditioner :</b> <?php echo $clim;?></p>
            <p class="text-lg tracking-tight leading-none text-cyan-500 mt-2"><img class="inline-flex h-5 w-5 mr-2 mb-1" src="https://www.svgrepo.com/show/204084/chair-seat.svg" alt=""><b>Seats :</b> <?php echo $n_place;?></p>

            <?php 
            if($oprix != 0){
            $reduction = (-100)*(($nprix - $oprix)/ $oprix) ;
            $reduction = round($reduction, 0);}
            if($nprix < $oprix){
                echo '            <p class="text-lg text-gray-500 mt-10"><b>' . $nprix . ' MAD <strike class="text-red-400">' . $oprix . ' MAD</strike>    ' . $reduction . '% de reduction</b></p>';
            }else{
                echo '            <p class="text-lg text-gray-500 mt-10"><b>' .  $nprix .  ' MAD </b></p>';
                


            }
            
            ?>
            <!-- <p class="text-lg text-gray-500 mt-10"><b><?php echo $nprix; ?> MAD <strike class="text-red-400"><?php echo $oprix;?> MAD</strike></b></p> -->


            <!-- <a href="#" class="inline-block bg-cyan-500 hover:bg-pink-600 mt-3 px-6 py-3 rounded-md text-white">Learn More</a> -->
            <button class=" inline-block bg-transparent hover:bg-gray-500 text-Slate-700 font-semibold hover:text-white mt-3 px-6 py-3 border border-Slate-700 hover:border-transparent rounded">
            Reserve now
            </button>
        </div>
    </div>

    





    <div class="w-full xl:w-1/2 mr-5">
        <img class="object-contain h-594 w-371" src="./uploads/<?php echo $var4; ?>" alt="Robot Group">
        
    </div>
    </main>
    </div>
</section>

<!-- end -->
    <div class="xl:w-2/2" align=center >
    <hr width="80%">
    </div>
    <section class="bg-white mt-6 mb-3">
            <h1 class="tracking-tight font-light text-gray-900 text-4xl " align=center><img class="inline-flex h-8 w-8 mr-2 mb-2" src="https://www.svgrepo.com/show/263992/fire.svg" alt=""><b> Trending products </b></h3>
    
    </section>

<section class="bg-gray-100 py-0">
<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        
<?php 
$statement1 = $db->prepare("select rent.ID_Produit,ID_TypeProduit,Produit_name,Prix,Description,Status,image_file_name,SUM(D_End - D_Start) AS 'somme' FROM rent INNER JOIN produit ON rent.ID_Produit = produit.ID_Produit INNER JOIN type_produit ON produit.ID_TypeProduit = type_produit.ID GROUP BY rent.ID_Produit ORDER BY `somme` DESC LIMIT 4;");
$statement1->execute();
$results1 = $statement1->fetchAll();

// $pic1 = $results[0]['image_file_name'];

?>

        <?php 
            foreach($results1 as $output){
                echo '<div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="product-details.php?id_product=' . $output['ID_Produit'] . '">
                    <img class="hover:grow hover:shadow-lg " src="uploads/' . $output['image_file_name'] . '">
                    <div class="pt-3 flex items-center justify-between">
                        <p class="">' . $output['Produit_name'] . '</p>
                        <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                        </svg>
                    </div>
                    <p class="pt-1 text-gray-900"><b>' . $output['Prix'] . ' MAD</b></p>
                </a>
            </div>';
            }

        ?>
        
</div>

    </section>










    
    <section class="bg-white py-8">
    <main class="flex flex-col xl:flex-row h-screen">
    <div class="w-full xl:w-1/2 my-4 flex justify-center">
        <div class="w-4/6">
        <h1 class="tracking-tight font-light text-gray-500 text-4xl ">Meet the</h3>
        <hr>
            <h1 class="text-6xl md:text-8xl tracking-tight leading-none font-extrabold text-cyan-500">StarGazers</h1>
            <p class="text-lg text-gray-500 mt-2">Members of an intergalactic alliance paving the way for
            peace and benevolence among all species. They
            are known for their enthusiasm for science, for their love of fun, and their dedication to education.</p>
            <p class="text-lg text-gray-500 mt-2"><b>250 MAD <strike class="text-red-400">300 MAD</strike></b></p>
            <!-- <a href="#" class="inline-block bg-cyan-500 hover:bg-pink-600 mt-3 px-6 py-3 rounded-md text-white">Learn More</a> -->
            <button class=" inline-block bg-transparent hover:bg-gray-500 text-Slate-700 font-semibold hover:text-white mt-3 px-6 py-3 border border-Slate-700 hover:border-transparent rounded">
            Reserve now
            </button>
        </div>
    </div>
    <div class="w-full xl:w-1/2 h-screen mr-5">
        <img class="object-contain h-594 w-371" src="https://pixelprowess.com/i/bots/i/group.svg" alt="Robot Group">
    </div>
    </main>
    </div>
    </section>

    <!-- <section class="bg-white py-8">

        <br>

    </section> -->

    <footer class="container mx-auto bg-white py-8 border-t border-gray-400">
        <div class="container flex px-3 py-8 ">
            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full lg:w-1/2 ">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">About</h3>
                        <p class="py-4">
                        A serviced office is an office or office building that is fully equipped and managed by a facility management company, also known as an office provider, which then rents individual offices or floors to other companies.
                        </p>
                    </div>
                </div>
                <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">Created by :</h3>
                        <ul class="list-reset items-center pt-3">
                            <li>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Ahmed salaheddine</a>
                                <br>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Soufiane akif</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
