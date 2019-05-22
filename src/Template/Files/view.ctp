<form method="post" action="<?= $this->Url->build('/multiple-file-upload/files/upload/'.$projectId); ?>" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">
	<div id="files">
		<?php echo $this->Element('view_files'); ?>
	</div>
	<span class="box__dragndrop">Drag & Drop<br>oder</span>
	<div class="box__input">
		<input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
		<label for="file">Datei Upload</label>
		<button type="submit" class="box__button">Upload</button>
	</div>

	<div class="box__uploading">Uploading…</div>
	<div class="box__success">Done! <a href="<?= $this->Url->build('/multiple-file-upload/files/view/'.$projectId); ?>" class="box__restart" role="button">Upload more?</a></div>
	<!--<div class="box__error">Error! <span></span>. <a href="<?= $this->Url->build('/multiple-file-upload/files/view/'.$projectId); ?>" class="box__restart" role="button">Try again!</a></div>-->
	<input type="hidden" name="ajax" value="1">
</form>

<div style="display:none;" id="error" class="box__error"><span></span></div>

<div id="files">
	<?php echo $this->Element('view_files'); ?>
</div>

<script>
	$(document).ready(function(){
		$(document).on('click','a.remove', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$.ajax({
				url: url,
				method: 'GET',
				success: function(resp) {
					console.log(resp);
					if(resp.success) {
						$('#file-'+resp.id).remove();
					}
				}
			});
		});
	});
</script>
