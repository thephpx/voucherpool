<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome to the voucher app</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Voucher App</h1>
				<hr/>
				<table class="table table-bordered">
					<tr>
						<th colspan="6" class="text-center">Voucher Statistics</th>
					</tr>
					<tr>
						<th width="10%">Total:</th>
						<td><?php echo $total; ?></td>
						<th width="10%">Used:</th>
						<td><?php echo $used; ?></td>
						<th width="10%">Unused:</th>
						<td><?php echo $unused; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="recepient-tab" data-toggle="tab" href="#recepeints" role="tab" aria-controls="home" aria-selected="true">Recepients</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="offer-tab" data-toggle="tab" href="#offers" role="tab" aria-controls="profile" aria-selected="false">Offers</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="recepeints" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade show active">
						<div style="padding:10px;">
							  <h3>List of Recepients</h3><hr/>
							  <table class="table table-bordered" id="recepeintsTable">
							  	<thead>
								  	<tr>
								  		<th class="text-center" width="10%">Id</th>
								  		<th class="text-center">Name</th>
								  		<th class="text-center">Email</th>
								  		<th width="15%">&nbsp;</th>
								  	</tr>
							  	</thead>
							  	<tbody>
							  		
							  	</tbody>
							  </table>
							  <form id="recepientForm">
							  	<div class="row">
							  		<div class="col-lg-12">
							  			<table class="">
							  				<tr>
							  					<th>Name:</th>
							  					<th>Email:</th>
							  					<th></th>
							  				</tr>
							  				<tr>
							  					<td>
										  			<input type="text" value="" name="name"/>
							  					</td>
							  					<td>
										  			<input type="text" value="" name="email"/>
							  					</td>
							  					<td>
							  						<button type="button" onClick="createRecepient();" class="btn btn-primary pull-right">Create</button>
							  					</td>
							  				</tr>
							  			</table>
						  			</div>
						  		</div>
							  </form>
					  	</div>
					</div>
					<div id="offers" role="tabpanel" aria-labelledby="offer-tab" class="tab-pane fade">
						<div style="padding:10px;">
							<h3>List of Offers</h3><hr/>
							<table class="table table-bordered" id="offersTable">
								<thead>
							  	<tr>
							  		<th class="text-center" width="10%">Id</th>
							  		<th class="text-center">Name</th>
							  		<th class="text-center">Discount</th>
							  	</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
							  <form id="offerForm">
							  	<div class="row">
							  		<div class="col-lg-12">
							  			<table class="">
							  				<tr>
							  					<th>Name:</th>
							  					<th>Discount:</th>
							  					<th></th>
							  				</tr>
							  				<tr>
							  					<td>
										  			<input type="text" value="" name="name"/>
							  					</td>
							  					<td>
										  			<input type="text" value="" name="discount"/>
							  					</td>
							  					<td>
							  						<button type="button" onClick="createOffer();" class="btn btn-primary pull-right">Create</button>
							  					</td>
							  				</tr>
							  			</table>
						  			</div>
						  		</div>
							  </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


	<script type="text/javascript">

		var createRecepient = function(){
			var recepientForm = $("#recepientForm").serialize();

			$.ajax({
				method: "PUT",
				url:'<?php echo url("api/recepients/"); ?>/', 
				dataType: 'json',
				data: recepientForm
			}).done(function(response){
				$("#recepientForm")[0].reset();
				loadRecepients();
			});

		}

		var createOffer = function(){
			var offerForm = $("#offerForm").serialize();

			$.ajax({
				method: "PUT",
				url:'<?php echo url("api/offers/"); ?>/', 
				dataType: 'json',
				data: offerForm
			}).done(function(response){
				$("#offerForm")[0].reset();
				loadOffers();
			});

		}
		
		var loadRecepients = function (){
			$.get('<?php echo url("api/recepients");?>', function(response){
				$("#recepeintsTable tbody").html('');
				$(response).each(function(){
					
					var voucher_link = '<?php echo url("vouchers"); ?>/'+this.id;
					var redeem_link = '<?php echo url("vouchers/redeem"); ?>/'+this.id;

					$("#recepeintsTable tbody").append('<tr><td class="text-center">'+this.id+'</td><td  class="text-center">'+this.name+'</td><td class="text-center">'+this.email+'</td><td class="text-center"><a class="btn btn-sm btn-block btn-primary" href="'+voucher_link+'">Vouchers</a><a class="btn btn-sm btn-block btn-primary" href="'+redeem_link+'">Redeem</a></td></tr>');
				})
			});
		}
		
		var loadOffers = function (){
			$.get('<?php echo url("api/offers");?>', function(response){
				$("#offersTable tbody").html('');
				$(response).each(function(){
					$("#offersTable tbody").append('<tr><td class="text-center">'+this.id+'</td><td  class="text-center">'+this.name+'</td><td class="text-center">'+parseFloat(this.discount).toFixed(2)+'%</td></tr>');
				})
			});
		}

		$(document).ready(function(){
			loadRecepients();
			loadOffers();
		});
	</script>
</body>
</html>