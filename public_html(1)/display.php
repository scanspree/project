<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script><?php include "jquery.min.js" ?></script>
    <script src="jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
    /*	$(document).ready(function(){
				 $("#data").load("data.php");
				setInterval(function() {
					$("#data").load("data.php",function(data){
					    var table = " <tr> <th>Product id</th> <th>Product name</th> <th>Product price</th> <th>Quantity</th> </tr>";
                    $.each(data, function(key,value){
                        table += "<tr>";
                        table += "<td>" + value.product_id + "</td>";
                        table += "<td>" + value.product_name + "</td>";
                        table += "<td>" + value.product_price + "</td>";
                        table += "</tr>";
                    });
                    $("#my_table").html(table););}
				
		}, 500);
			});*/
			
		
        $(document).ready(function(){
          
            $.ajax({
                url:"data.php",
                dataType: "json",
                success: function(data){
                  
                     var products = {};
                     $("#my_table").html("<tr><th>Product_id</th><th>Product_name</th><th>Quantity</th><th>Product_price</th> </tr>");
                   
                    $.each(data, function(key,value){
                      //  var initialTotal = 0;
                      
                      var productId = value.product_id;
                     
  
  if (productId in products) {
  
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text(products[productId].quantity);
    row.find('.price').text(products[productId].price.toFixed(0));
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    }; 
     $("#my_table").append("<tr data-product-id=" + productId + "><td>" + value.product_id + "</td><td>" + value.product_name +"</td><td class='quantity'>1</td><td class='price' id='pri'>"+value.product_price +"</td></tr>");
      totalPrice += parseInt(value.product_price);
  $('#total-price').text(totalPrice.toFixed(0));
         //var table = document.querySelector("table");
//var totalCell = document.getElementById("total");

// Calculate the initial total

//var dataCells = table.querySelectorAll("td[id^='pri']");
//for (var i = 0; i < dataCells.length; i++) {
//  initialTotal += parseInt(dataCells[i].textContent);
//}
//totalCell.textContent = initialTotal;     
  }                    
           
                    }
         );   
                }
       
            });
            setInterval(function() {
                 
                $.ajax({
                url:"data.php",
                dataType: "json",
                success: function(data){
                //let totalPrice = 0;
                    var products = {};
                     $("#my_table").html("<tr><th>Product_id</th><th>Product_name</th><th>Quantity</th><th>Product_price</th></tr>");
                   
                    $.each(data, function(key,value){
  //  var initialTotal = 0;
    var productId = value.product_id;
  
  if (productId in products) {
  
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text(products[productId].quantity);
    row.find('.price').text(products[productId].price.toFixed(0));
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    };
     $("#my_table").append("<tr data-product-id=" + productId + "><td>" + value.product_id + "</td><td>" + value.product_name +"</td><td class='quantity'>1</td><td class='price' id='pri'>"+value.product_price +"</td></tr>");
    //  totalPrice += parseInt(value.product_price);

  //$('#total-price').text(totalPrice.toFixed(0));
       // var table = document.querySelector("table");
//var totalCell = document.getElementById("total");

// Calculate the initial total

//var dataCells = table.querySelectorAll("td[id^='pri']");
//for (var i = 0; i < dataCells.length; i++) {
//  initialTotal += parseInt(dataCells[i].textContent);
//}
//totalCell.textContent = initialTotal;
  }
                    
                     
                    });
                    var total = 0;
$('.price').each(function() {
    total += parseInt($(this).text());
});
$('#total-price').text(total);
                   
                }
            });
		}, 500);
        })


    </script>
</head>
<body>
    <p id="data"> </p>
    <table id="my_table">
       <p id="total-price"></p>
    </table>
</body>
</html>