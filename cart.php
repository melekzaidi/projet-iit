
<?php
 session_start();
 require_once('classes/facture.php');
 require_once('classes/config.php');
 $ventes=$_SESSION["ventes"];
 print_r($_COOKIE['username']);/*
 if(isset($_POST['checkout'])){
  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Initialize variables
  $total = 0;
  
  // Calculate total amount
  foreach ($ventes as $vente) {
      $prix = $vente['prix'];
      $quantity = isset($vente['quantity']) ? intval($vente['quantity']) : 1;
      $total += ($prix * $quantity);
  }
  
  // Create a new Order object
  $order = new Order();
  
  // Set order details
  $order->setMontant($total);
  $order->setusername($username );
  $order->setDate(date('Y-m-d H:i:s')); // Assuming you want to store the current date and time

  // Insert order into the database
  $order->insertOrder();
  
  // Clear the cart after checkout
  $_SESSION['ventes'] = [];

    // Proceed with setting the iduser property and other operations
} else {
    // Handle the case where $_SESSION['iduser'] is not set
    echo "Session iduser is not set.";
}

  
}*/
?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Fredoka+One);

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
  outline: none;
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
html { overflow-y: scroll; }
body {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 62.5%;
  line-height: 1;
  color: #414141;
  background: #caccf7 url('https://i.imgur.com/Syv2IVk.png'); /* https://subtlepatterns.com/old-map/ */
  padding: 25px 0;
}

::selection { background: #bdc0e8; }
::-moz-selection { background: #bdc0e8; }
::-webkit-selection { background: #bdc0e8; }

br { display: block; line-height: 1.6em; } 

article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
ol, ul { list-style: none; }

input, textarea { 
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  outline: none; 
}

blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
strong, b { font-weight: bold; }
em, i { font-style: italic; }

table { border-collapse: collapse; border-spacing: 0; }
img { border: 0; max-width: 100%; }

h1 {
  font-family: 'Fredoka One', Helvetica, Tahoma, sans-serif;
  color: #fff;
  text-shadow: 1px 2px 0 #7184d8;
  font-size: 3.5em;
  line-height: 1.1em;
  padding: 6px 0;
  font-weight: normal;
  text-align: center;
}


/* page structure */
#w {
  display: block;
  width: 600px;
  margin: 0 auto;
}

#title {
  display: block;
  width: 100%;
  background: #95a6d6;
  padding: 10px 0;
  -webkit-border-top-right-radius: 6px;
  -webkit-border-top-left-radius: 6px;
  -moz-border-radius-topright: 6px;
  -moz-border-radius-topleft: 6px;
  border-top-right-radius: 6px;
  border-top-left-radius: 6px;
}

#page {
  display: block;
  background: #fff;
  padding: 15px 0;
  -webkit-box-shadow: 0 2px 4px rgba(0,0,0,0.4);
  -moz-box-shadow: 0 2px 4px rgba(0,0,0,0.4);
}

/** cart table **/
#cart {
  display: block;
  border-collapse: collapse;
  margin: 0;
  width: 100%;
  font-size: 1.2em;
  color: #444;
}
#cart thead th {
  padding: 8px 0;
  font-weight: bold;
}

#cart thead th.first {
  width: 175px;
}
#cart thead th.second {
  width: 45px;
}
#cart thead th.third {
  width: 230px;
}
#cart thead th.fourth {
  width: 130px;
}
#cart thead th.fifth {
  width: 20px;
}

#cart tbody td {
  text-align: center;
  margin-top: 4px;
}

tr.productitm {
  height: 65px;
  line-height: 65px;
  border-bottom: 1px solid #d7dbe0;
}


#cart tbody td img.thumb {
  vertical-align: bottom;
  border: 1px solid #ddd;
  margin-bottom: 4px;
}

.qtyinput {
  width: 33px;
  height: 22px;
  border: 1px solid #a3b8d3;
  background: #dae4eb;
  color: #616161;
  text-align: center;
}

tr.totalprice, tr.extracosts {
  height: 35px;
  line-height: 35px;
}
tr.extracosts {
  background: #e4edf4;
}

.remove {
  /* http://findicons.com/icon/261449/trash_can?id=397422 */
  cursor: pointer;
  position: relative;
  right: 12px;
  top: 5px;
}


.light {
  color: #888b8d;
  text-shadow: 1px 1px 0 rgba(255,255,255,0.45);
  font-size: 1.1em;
  font-weight: normal;
}
.thick {
  color: #272727;
  font-size: 1.7em;
  font-weight: bold;
}


/** submit btn **/
tr.checkoutrow {
  background: #cfdae8;
  border-top: 1px solid #abc0db;
  border-bottom: 1px solid #abc0db;
}
td.checkout {
  padding: 12px 0;
  padding-top: 20px;
  width: 100%;
  text-align: right;
}


/* https://codepen.io/guvootes/pen/eyDAb */
#submitbtn {
  width: 150px;
  height: 35px;
  outline: none;
  border: none;
  border-radius: 5px;
  margin: 0 0 10px 0;
  font-size: 1.3em;
  letter-spacing: 0.05em;
  font-family: Arial, Tahoma, sans-serif;
  color: #fff;
  text-shadow: 1px 1px 0 rgba(0,0,0,0.2);
  cursor: pointer;
  overflow: hidden;
  border-bottom: 1px solid #0071ff;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #66aaff), color-stop(100%, #4d9cff));
  background-image: -webkit-linear-gradient(#66aaff, #4d9cff);
  background-image: -moz-linear-gradient(#66aaff, #4d9cff);
  background-image: -o-linear-gradient(#66aaff, #4d9cff);
  background-image: linear-gradient(#66aaff, #4d9cff);
}
#submitbtn:hover {
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #4d9cff), color-stop(100%, #338eff));
  background-image: -webkit-linear-gradient(#4d9cff, #338eff);
  background-image: -moz-linear-gradient(#4d9cff, #338eff);
  background-image: -o-linear-gradient(#4d9cff, #338eff);
  background-image: linear-gradient(#4d9cff, #338eff);
}
#submitbtn:active {
  border-bottom: 0;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #338eff), color-stop(100%, #4d9cff));
  background-image: -webkit-linear-gradient(#338eff, #4d9cff);
  background-image: -moz-linear-gradient(#338eff, #4d9cff);
  background-image: -o-linear-gradient(#338eff, #4d9cff);
  background-image: linear-gradient(#338eff, #4d9cff);
  -webkit-box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
  -moz-box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
  box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shopping Cart</title>
<style>
/* Your CSS styles here */
</style>
</head>
<body>
  <div id="w">
    <header id="title">
      <h1>CART</h1>
    </header>
    <div id="page">
      <table id="cart">
        <thead>
          <tr>
            <th class="first">Photo</th>
            <th class="second">Qty</th>
            <th class="third">Product</th>
            <th class="fourth">Price</th>
            <th class="fifth">Line Total</th>
          </tr>
        </thead>
        <tbody>
        <?php       
            if (!empty($ventes)) {
                foreach ($ventes as $vente) {
                    $id=$vente["id"];
                    $image = $vente['image'];
                    $prix = $vente['prix'];
                    $name = $vente['nom'];   
                    echo '<script>updateTotal(document.querySelector(\'#' . $id . '\'));</script>';

                    echo '<tr class="productitm">
                    <td><img height=100px src=' . $image . ' class="thumb"></td>
                    <td><input type="number" value="1" min="0" max="99" id='.$id.' class="qtyinput" onchange="updateTotal(this)"></td>
                    <td>'.$name.'</td>
                    <td class="productprice">$'.$prix.'</td>
                    <td class="producttotal">$'.$prix.'</td>
                </tr>';
                }
            } else {
                echo '<tr><td colspan="6">Your cart is empty.</td></tr>';
            }
        ?>

          <!-- shopping cart contents -->
         
          
          <!-- tax + subtotal -->
   
          <tr class="totalprice">
            <td class="light">Total:</td>
            <td colspan="4">&nbsp;</td>
            <td><span class="thick grandtotal">$0</span></td>
          </tr>
          
          <!-- checkout btn -->
          <tr class="checkoutrow">
            <form method='post'>
            <td colspan="6" class="checkout"><button name='checkout' id="submitbtn">Checkout Now!</button></td>
          </from>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    // Initialize Line Total based on initial quantity of 1

    function updateTotal(input) {
  var row = input.parentNode.parentNode;
  var price = parseFloat(row.querySelector('.productprice').innerText.replace('$', ''));
  var quantity = input.value;
  var total = price * quantity;
  row.querySelector('.producttotal').innerText = '$' + total.toFixed(2);

  // Update grand total
  var grandTotal = 0;
  var productTotals = document.querySelectorAll('.producttotal');
  productTotals.forEach(function(element) {
    grandTotal += parseFloat(element.innerText.replace('$', ''));
  });
  document.querySelector('.grandtotal').innerText = '$' + grandTotal.toFixed(2);
}
var grandTotal = 0;
  var productTotals = document.querySelectorAll('.producttotal');
  productTotals.forEach(function(element) {
    grandTotal += parseFloat(element.innerText.replace('$', ''));
  });
  document.querySelector('.grandtotal').innerText = '$' + grandTotal.toFixed(2);
  </script>
</body>


</html>
