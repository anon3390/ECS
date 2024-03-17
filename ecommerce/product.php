<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];

	try{
		 		
	    $stmt = $conn->prepare("SELECT *,users.email AS rent, products.name AS prodname, products.photo, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id JOIN users on users.id = products.rentor_id WHERE slug = :slug");
		// 
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}
	
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="col-sm-6">
		            		<img src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product['photo']; ?>">
		            		<br><br>
		            		<form class="form-inline" id="productForm">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
							        </div>
			            			<button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
			            		
								</div><br><br>
		            		</form>
							<button class="btn btn-danger" id="report"  data-toggle="modal" data-target="#myModal">Report Rentor</button>
<button class="btn btn-success"><a style="color: white;" href="http://localhost/ECS/ChatAppAPI">Chat for more queries!</a></button>
		            	</div>
		            	<div class="col-sm-6">
		            		<h1 class="page-header"><?php echo $product['prodname']; ?></h1>
		            		<h3><b>PKR <?php echo number_format($product['price'], 2); ?></b></h3>
		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
		            		<p><b>Description:</b></p>
		            		<p><?php echo $product['description']; ?></p>
							<br><br>
								<label>Rentor: </label>						
									<b><u><a href="rentorprods.php?rentor=<?php echo $product['rentor_id']; ?>" id='a'><?php 
								$stmt = $conn->prepare("SELECT users.firstname, users.lastname FROM users JOIN products ON products.rentor_id=users.id WHERE users.id = :rentor_id");
	   						 $stmt->execute(['rentor_id' => $product['rentor_id']]);
								$rentorname = $stmt->fetch();
								echo $rentorname['firstname'];
								echo "  ";
								echo $rentorname['lastname'];?></a>
		            	</div>
		            </div>
		            <br>
				    <div class="fb-comments" data-href="http://localhost/ecommerce/product.php?product=<?php echo $slug; ?>" data-numposts="10" width="100%"></div> 
	        	</div>
				<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" >
				<div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Report Request</h4>
        </div>
        <div class="modal-body">
			<form action="request.php" method="post">
			<div class="form-group">
				<input type="text"  class="form-group" name="rentor_id" value="<?php echo $product['rent']; ?>" hidden>
				<input type="text"  class="form-group" name="user_id" value=" <?php echo $user['email']; ?>" >
				<div class="form-group">
				<label for="description" >Reason</label>
				<br>
				<textarea rows="4" cols="50" name="descrption" required></textarea>

				</div>
				
</div>
<button type="submit" onclick="alert('user reported')"class="btn btn-primary">Submit</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </div></div></div>
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
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});


	// $(document).on('click', '#report', function(e){
	// 	e.preventDefault();
	// 	var id = <?php $product['rentor_id']?>;
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: 'request.php',
	// 		data: {id:id,
				
	// 		},
	// 		dataType: 'json',
	// 		success: function(response){
	// 			alert("rentor reported");
	// 		}
	// 	});
	// });

});
</script>
</body>
</html>