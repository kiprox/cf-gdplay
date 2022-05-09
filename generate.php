<?php

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Generator CFPlayer</title>
	<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/cfplayer.css" type="text/css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
	<script type="text/javascript" src="assets/js/cfplayer.min.js"></script>
</head>
<body>
	<div class="container bg-dark">
		<div class="jumbotron mt-3">
	        <h1 class="display-6">Generate Video Player</h1>
	        <p class="lead">Encode URL to protect your real URL. You can use url or iframe after encoding into your website easily and quickly.</p>
	     </div>
	     
		<form id="action-form" action="action.php" method="POST" accept-charset="utf-8">
			<div class="form-group">
				<label class="font-weight-bold text-white">Video URL</label>
				<input type="text" name="link" class="form-control" placeholder="" onclick="this.select()" required>
			</div>

			<div class="row">

				<div class="col-md-11" id="sub">
					<div id="sub-block">
						<div class="row">
						    <div class="col-md-7">
						        <div class="form-group">
						        	<label class="font-weight-bold text-white">Subtitle</label>
						        	<input type="text" class="form-control" name="sub[0]" placeholder="https://yourdomain/subtitle.srt" onclick="this.select()"> 
						        </div>
						    </div>
						    
						    <div class="col-md-4">
						        <div class="form-group">
						        	<label class="font-weight-bold text-white">Label</label>
						        	<input type="text" class="form-control" name="label[0]" placeholder="Ex: Default" onclick="this.select()"> 
						        </div>
						    </div>
						    
						    <div class="col-md-1" style="margin-top: 30px">
						        <div class="form-group">
						        	<button type="button" id="remove_sub" class="btn btn-danger btn-block" disabled><i class="fa fa-trash"></i></button> 
						    	</div>
						    </div>
						</div>
					</div>
				</div>

			    <div class="col-md-1" style="margin-top: 30px">
			    	<button type="button" id="add_new_sub" data-total="1" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
				</div>

			</div>

			<div class="form-group">
				<label class="font-weight-bold text-white">Poster</label>
				<input type="text" name="poster" class="form-control" placeholder="https://yourdomain/poster.jpg" onclick="this.select()">
			</div>

			<div class="form-group">
				<button type="submit" id="action-submit" class="btn btn-lg btn-info btn-block"> <span id="fa-loading"><i class="fa fa-retweet"></i></span> Encode</button>
			</div>
		</form>
		
		<div class="form-group">
			<label class="font-weight-bold text-white">URL Encoding</label>
			<input type="text" id="url-encode" class="form-control" placeholder="" onclick="this.select()" readonly>
		</div>

		<div class="form-group">
			<label class="font-weight-bold text-white">Iframe Encoding</label>
			<textarea rows="5" class="form-control" id="iframe-encode" placeholder="" onclick="this.select()" readonly></textarea>
		</div>
		<?php  $domainServer = (isset($_SERVER['HTTPS']) ? "http" : "https") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); ?>
		<script type="text/javascript">
			jQuery(function ($) {
				$('#action-form').submit(function(e) {
					e.preventDefault();
					$('#action-submit').prop('disabled', !0);
					$('#fa-loading').html('<i class="fa fa-spinner fa-spin"></i>');
		       		var b = $(this).serializeArray(), c = $(this).attr('action');
					$.ajax({
				        type: 'POST',
				        dataType: 'text',
				        url: c,
				        data: b,
						error: function (result) {
							alert("Something went wrong. Please try again!");
							$('#fa-loading').html('<i class="fa fa-arrow-circle-right"></i>');
							$('#action-submit').removeAttr('disabled');
						},
						success: function (result) {
							$('#url-encode').val('<?php echo $domainServer . 'index.php?data=' ?>'+result+'');
							$('#iframe-encode').html('<iframe src="<?php echo $domainServer . 'index.php?data=' ?>'+result+'" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>');
							$('#fa-loading').html('<i class="fa fa-retweet"></i>');
							$('#action-submit').removeAttr('disabled');
						}
					});
				});
			});
		</script>

		<hr>
	</div>
	<footer class="footer">
		<p class="text-center text-white">Copyleft &copy; <?php echo date('Y') ?> <a href="https://t.me/kiprox" title="CFPlayer" target="_blank">CFPlayer</a>. All rights reserved.</p>
	</footer>
</body>
</html>
