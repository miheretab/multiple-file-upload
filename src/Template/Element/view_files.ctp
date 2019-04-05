<?php foreach($files as $file) { ?>
<div id="file-<?= $file->id ?>" class="mt-10">
	<span class="float-left"><?= $file->name . ' ('. $file->size_mb .')'; ?></span>
	<a class="float-right remove" href="<?= $this->Url->build('/multiple-file-upload/files/remove/'.$file->id); ?>">Remove</a>
	<a class="float-right mr-10" href="<?= $this->Url->build('/multiple-file-upload/files/download/'.$file->id); ?>">Download</a>
</div>
<?php } ?>