<?php 
session_start();
?>
<header>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
        <link rel ="stylesheet" href="./css/estilos.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
        <title>Encomenda</title>
  </header>

<?php include 'header.php' ?>
<section id="encomenda" class="encomenda section-bg">
      <div class="container">

        <div class="section-title mb-5">
          <h2>Encomenda</h2>
          <p>Faça a sua encomenda</p>
        </div>

        <form method="post" class="mt-1">
            <div class="form-row">
              <div class="form-group">
                <label class="enc_data">Nome</label>
                <input type="nome" class="form-control" id="nome" name="enc_nome" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label class="enc_data">Morada</label>
              <input type="morada" class="form-control" id="morada" name="enc_morada" placeholder="">
            </div>
            <div class="form-group">
              <label class="enc_data">Código postal</label>
              <input type="cod_postal" class="form-control" id="cod_postal" name="enc_cod_postal" placeholder="">
            </div>
            <div class="form-group">
              <label class="enc_data">Nº de telefone/telemóvel</label>
              <input type="numero" class="form-control" id="numero" name="enc_telef" placeholder="">
            </div>
  
            
          <input class="mt-2 mb-2" type="text" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii" name="enc_data">
          <script>
          $('#datetimepicker').datetimepicker();
          </script>  


          <div class="form-group">
          <div class="form-row">
              <div class="enc_tipo mt-2">
                  <p>Tipo de pizza:</p>
                      <input type="checkbox" id="pepp" value="pepperoni" name="enc_tipo">
                      <label class="enc_data mr-5"> Pepperoni </label>
                      <script>$('#pepp').is(':checked');</script>
                      <input type="checkbox" id="choc" value="chocolate" name="enc_tipo">
                      <label class="enc_data mr-5"> Chocolate </label>
                      <script>$('#choc').is(':checked');</script>
                      <input type="checkbox" id="carb" value="carbonara" name="enc_tipo">
                      <label class="enc_data mr-5"> Carbonara </label>
                      <script>$('#carb').is(':checked');</script> 
                      <input type="checkbox" id="veg" value="vegetariana" name="enc_tipo">
                      <label class="enc_data mr-5"> Vegetariana</label>
                      <script>$('#veg').is(':checked');</script>

                
                  </div>
            </div>
            </div>
        
            <div class="form-group">
            <div class="form-row">
            <div class="enc_taxa">
                  <p>Quantidade:</p>
                  <input class="quantity" type="quantidade" id="num" value="" name="enc_quant"> 
            </div>      
            </div>
            </div>

            
            <div class="form-group">
            <div class="form-row">
            <div class="enc_quant">
                  <label class="enc_data" >Taxa de envio: </label>
                  <p class="taxa" type="text" id="num" value="" name="enc_quant">2€</p> 
            </div>      
            </div>
            </div>

          <div class="form-group">
          <div class="form-row">
          <div class="col-12">
            <textarea class="form-control" name="enc_msg" rows="5" placeholder="Message (Optional)"></textarea>
            <div class="validate"></div>
          
          <div class="text-center mt-3"><button type="submit" name="nova_enc">Faça a sua encomenda</button></div>
          </div>
          </div>
          </div>
        </form>

      </div>


<?php
if (isset($_POST["nova_enc"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "INSERT INTO encomenda VALUES ('$_POST[enc_id]'");
	//Saber O ID GERADO NESTA INSERÇÃO
	$enc_id = mysqli_insert_id($conn);
	mysqli_query($conn, "INSERT INTO encomenda VALUES ('$_POST[enc_id]','$_POST[enc_nome]','$_POST[enc_morada]','$_POST[enc_cod_postal]','$_POST[enc_telef]','$_POST[enc_data]','$_POST[enc_tipo]','$_POST[enc_quant]','$_POST[enc_taxa]','$_POST[enc_msg]')");
	mysqli_query($conn, "UPDATE encomenda SET enc_taxa = 2");
  
  echo '<meta http-equiv="refresh" content="0;url=encomenda.php">';
}

?>

    </section>