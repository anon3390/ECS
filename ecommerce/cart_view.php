<style>
	#hidden_div {
    display: none;
}
#hidden_div2 {
    display: none;
}
#btnContinue {
	display: none;
}
</style>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
					<p id="tots" style="display: none;"></p>

	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
								<th width="20%">Days</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>

	        		</div>
					<div>
						<p style="color: red;"> 10% of the item price added for more than one days</p>
					</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
							echo '<input type="button" class="btn btn-success" onclick="getId()" id="rent" value="Rent Now" data-toggle="modal" data-target="#myModal">';
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
	        	</div>
				 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 80%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment Method</h4>
        </div>
        <div class="modal-body">
	
<div >
	<table class="table table-bordered">
		<thead>
			<th></th>
			<th>Photo</th>
			<th>Name</th>
			<th>Price</th>
			<th width="20%">Quantity</th>
			<th>Subtotal</th>
			<th width="20%">Days</th>
		</thead>
		<tbody id="hiddentbody">
			
		</tbody>
	</table>
	<p id="cart" style="display: none;"></p>
	</div>
<br>
	<select class="form-select" aria-label="Default select example" onchange="showDiv('hidden_div','hidden_div2', this)">
		<option selected><b>Please choose your payment method</option>
		<option value="1">Cash</option>
		<option value="2">Credit/Debit Card</option>
	  </select>

<div id="hidden_div">
	<br>
<p style="color: red;">The amount will be collected upon delivery as cash</p>
</div>

<div id="hidden_div2">
	<br><br>
	<div>
	<form onsubmit="Payment()">
		<div class="form-group">
			<img src="cardnumber.jpg" alt="Card Number" style="width:300px;height:160px;"><br><br>
		<label>Card Number:</label>
		<input type = "text" class="form-control" pattern ="^[0-9]*$" title="please input only numeric value" minlength="16" maxlength="16" required />
		</div>
		<div class="form-group">
			<img src="cvvnumber.PNG" alt="Cvv Number"  style="width:400px;height:200px;"><br><br>

		<label>Cvv Number:</label>
		<input type = "text" class="form-control"pattern = "^[0-9]*$"  title="please input only numeric value" minlength="3" maxlength="3"  required/>
		</div>
		<br>
		<!-- onclick="Payment()" -->
		<button type="submit" class="btn btn-primary" >Confirm</button>
	</form>
</div>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="button" id="btnContinue" onclick="Payment()" class="btn btn-primary" >Continue</button>

        </div>
      </div>
      
    </div>
  </div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
			</div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '#minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCheckoutDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '#add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCheckoutDetails();
					getCart();
					getTotal();
				}
			}
		});
		getDetails();
	getCheckoutDetails();
	getTotal();
	});

	$(document).on('click', '#daysminus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var dayss = $('#days_'+id).val();
		if(dayss>1){
			dayss--;
		}
		$('#days_'+id).val(dayss);
		$.ajax({
			type: 'POST',
			url: 'checkout_update.php',
			data: {
				id: id,
				dayss: dayss,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCheckoutDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '#daysadd', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var dayss = $('#days_'+id).val();
		dayss++;
		$('#days_'+id).val(dayss);
		$.ajax({
			type: 'POST',
			url: 'checkout_update.php',
			data: {
				id: id,
				dayss: dayss,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCheckoutDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getCheckoutDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#hiddentbody').html(response);

			$('#tbody').html(response);
			getCart();
		}
	});
}

function getCheckoutDetails(){
	$.ajax({
		type: 'POST',
		url: 'checkout_details.php',
		dataType: 'json',
		success: function(response){
			// $('#hiddentbody').html(response);

			getCart();
		}
	});
}
function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
			$('#tots').html(response);
		
		}
		
	});
}
// $(window).on('load',function(){
// 	var total = document.getElementById("tots").innerHTML;
// 	if(parseInt(total)>0){
// console.log(total);
// alert(total);

// 					document.getElementById("#rent").style.display = 'none';
// 				}
// 				else{
// 					document.getElementById("#rent").disabled = 'true';

// 				}
// });
function getId(){
	$.get("cart_items_id.php", function(data, status){
    // alert("Data: " + data + "\nStatus: " + status);
	const id = data;
	// alert(typeof id);
	document.getElementById("cart").innerHTML = id;
		
	});
}

function deleteOnCheckout(data){
	var id = JSON.parse(data);
	alert(id)

	
	$.post("cart_delete.php",
	{
		id: id
	},
  function(data, status){
    alert("Data: " + data + "\nStatus: " + status);
	if(!status.error){
					getDetails();
					getCart();
					getTotal();
				}
  });
}

function getRandomString(length) {
    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    for ( var i = 0; i < length; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }
    return "PAY-" + result.toUpperCase();
}

async function Payment()
{		

	document.getElementById("btnClose").style.display = 'none';
	// var res = confirm("Paymen confirmed");
	if(confirm("Payment confirmed")){
	// var id = document.getElementById("cart").innerHTML;
	let payment = getRandomString(22);
		window.location = 'sales.php?pay='+payment;
	// alert(id);

//   deleteOnCheckout(id);

		// deleteOnCheckout(id);
		
	}
	
	// window.location = 'sales.php?pay='+payment.id;
}
function PaymentId(){
	let payment = getRandomString(24);
		window.location = 'sales.php?pay='+payment;
}
function showDiv(divId1,divId2, element)
{

    document.getElementById(divId1).style.display = element.value == 1 ? 'block' : 'none';
	document.getElementById("btnContinue").style.display = element.value == 1 ? 'block' : 'none';
document.getElementById(divId2).style.display = element.value == 2 ? 'block' : 'none';

}
</script>
<!-- Paypal Express -->
<!-- <script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button'); -->
</script>
</body>
</html>