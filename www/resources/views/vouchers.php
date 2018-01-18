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
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h3>List of Vouchers</h3><hr/>
				  <table class="table table-bordered" id="vouchersTable">
				  	<thead>
					  	<tr>
					  		<th class="text-center" width="10%">Id</th>
					  		<th class="text-center">Offer</th>
					  		<th class="text-center">Code</th>
					  		<th class="text-center">Recipient</th>
					  		<th class="text-center" width="12%">Created On</th>
					  		<th class="text-center" width="10%">Expire On</th>
					  		<th class="text-center" width="10%">Used On</th>
					  	</tr>
				  	</thead>
				  	<tbody>
				  		
				  	</tbody>
				  </table>
				  <form id="voucherForm">
				  	<input type="hidden" name="recepient_id" value="<?php echo $id; ?>"/>
				  	<div class="row">
				  		<div class="col-lg-12">
				  			<table>
				  				<tr>
				  					<th>Select Offer:</th>
				  					<th></th>
				  				</tr>
				  				<tr>
				  					<td>
							  			<select class="form-control" name="offer_id">
							  				<?php foreach($offers as $offer){ ?>
							  				<option value="<?php echo $offer->id; ?>"><?php echo $offer->name; ?></option>
							  				<?php } ?>
							  			</select>
				  					</td>
				  					<td>
				  						<button type="button" onClick="generateVoucher();" class="btn btn-primary pull-right">Generate Voucher</button>
				  					</td>
				  				</tr>
				  			</table>
			  			</div>
			  		</div>
				  </form>
				  <hr/>
				  <a href="<?php echo url('/'); ?>" class="btn btn-primary btn-sm">Go Back</a>
			</div>
		</div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


	<script type="text/javascript">
		var id = <?php echo $id; ?>;

		var loadVouchers = function (){
			$.get('<?php echo url("api/vouchers/");?>/'+id, function(response){
				$("#vouchersTable tbody").html('');
				$(response).each(function(){
					
					var voucher_link = '<?php echo url("vouchers"); ?>/'+this.id;

					$("#vouchersTable tbody").append('<tr><td class="text-center">'+this.id+'</td><td  class="text-center">'+this.offer.name+'</td><td  class="text-center">'+this.code+'</td><td  class="text-center">'+this.recepient.name+'</td><td class="text-center">'+this.created_at+'</td><td class="text-center">'+this.expiry_date+'</td><td class="text-center">'+this.usage_date+'</td></tr>');
				})
			});
		}

		var generateVoucher = function(){
			var voucherForm = $("#voucherForm").serialize();

			$.ajax({
				method: "PUT",
				url:'<?php echo url("api/vouchers/"); ?>/'+id, 
				dataType: 'json',
				data: voucherForm
			}).done(function(response){
				$("#voucherForm")[0].reset();
				loadVouchers();
			});
		}

		$(document).ready(function(){
			loadVouchers();
		});
	</script>
</body>
</html>