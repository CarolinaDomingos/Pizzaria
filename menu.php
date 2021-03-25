<header>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
        <link rel ="stylesheet" href="./css/estilos.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <title>Menu</title>
  </header>
<body>
<?php
include 'header.php'
?>

<section class="menu-pizza">
      <div class="container">

        <div class="section-title mb-5">
          <h2>Menu</h2>
        </div>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'connections/conn.php';
        $menu = mysqli_query($conn, "SELECT * FROM menu");
        while($men = mysqli_fetch_array($menu))
        {
            echo '
                <div class="col-3">
                    <div class="pic">
                        <img src="img/'.$men["men_pic"].'" alt="">
                    </div>
                    <div class="pizza_info">
                        <p>'.$men["men_nome"].'</p>
                        <p>'.$men["men_price"].'€</p>
                    </div>
                </div> 
        ';
        }       
        ?>
    </div>
</div>
    </section>
</body>

<?php
include 'footer.php'
?>
