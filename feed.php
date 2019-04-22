<?php include("header.php"); ?>
<div class="container feed">
	<div class="row">
		<div class="col s12 m9">

			
					<div class="card">
						<div class="card-content full-width">
							<div class="card-content-inner">
								<h4>Add Post</h4>
								<form enctype="multipart/form-data"  action='php/add-post.php' method='POST' class='contact-form' id='add-post'>
									<div class="input-field col s12">
										<input id='file' type='file' name='photo' class="file-path validate">
									</div>
									<div class='input-field col s12'>
										<textarea id="comment" name="comment" class="materialize-textarea" required></textarea>
			          		<label for="comment">Comment</label>
									</div>
									<input type='submit' name='add-post' class='btn btn-primary right' value='Submit'>
								</form>
							</div>
							<div class="clear"></div>
								</div>
							</div>

							<div class="card">
						<div class="card-content full-width">
							<div class="card-content-inner">
								<h4>Add Opening</h4>
								<form enctype="multipart/form-data"  action='php/add-openings.php' method='POST' class='contact-form' id='add-post'>
									<div class="input-field col s12">
										<input id='file' type='file' name='photo' class="file-path validate">
									</div>
									<div class='input-field col s12'>
										<textarea id="desc" name="desc" class="materialize-textarea" required></textarea>
			          		<label for="desc">Description</label>
									</div>
									<div class='input-field col s12'>
										<textarea id="eligibility" name="eligibility" class="materialize-textarea" required></textarea>
			          		<label for="eligibility">Eligibility</label>
									</div>
									<input type='submit' name='add-post' class='btn btn-primary right' value='Create'>
								</form>
							</div>
							<div class="clear"></div>

						</div>
					</div>
					
				<?php	

			include("php/get-posts.php"); ?>




			



		
		</div>
	</div>
</div>

<script>
  $(document).ready(function(){
    //$('.tabs').tabs();
  });
</script>
<?php include("footer.php"); ?>