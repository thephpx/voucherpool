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
				<h1>Reddem</h1>
				<hr/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form id="redeemForm">
					<table>
						<tr>
							<th>Code:</th>
							<td><input type="text" name="code" value="" class="form-control" /></td>
							<th>Email:</th>
							<td><input type="text" name="email" value="" class="form-control" /></td>
							<td><button type="button" class="btn btn-primary btn-block" onclick="redeemCode();">Redeem</button></td>
						</tr>
					</table>
					<hr/>
					<a href="<?php echo url('/'); ?>" class="btn btn-primary">Go Back</a>
				</form>
			</div>
		</div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


	<script type="text/javascript">
		var id = <?php echo $id; ?>;

		var redeemCode = function(){
			var redeemForm = $("#redeemForm").serialize();

			$.ajax({
				method: "POST",
				url:'<?php echo url("api/vouchers/redeem"); ?>/'+id, 
				dataType: 'json',
				data: redeemForm
			}).done(function(response){
				$("#redeemForm")[0].reset();
			});
		}
	</script>
</body>
</html>