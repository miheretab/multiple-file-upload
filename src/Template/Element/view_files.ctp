<?php foreach($files as $file) { ?>
<div id="file-<?= $file->id ?>" class="mt-10">
	<a class="remove" href="<?= $this->Url->build('/multiple-file-upload/files/remove/'.$file->id); ?>"><svg version="1.1" id="remove-icon" class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><polygon points="24,1.4 22.6,0 12,10.6 1.4,0 0,1.4 10.6,12 0,22.6 1.4,24 12,13.4 22.6,24 24,22.6 13.4,12 "/></svg></a>
	<a class="file-link" href="<?= $this->Url->build('/multiple-file-upload/files/download/'.$file->id); ?>"><?= $file->name . ' ('. $file->size_mb .')'; ?></a>
</div>
<?php } ?>