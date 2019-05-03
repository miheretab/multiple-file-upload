# MultipleFileUpload plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).


put MultipleFileUpload folder into plugins and do:
```
composer dumpautoload
```

or manual installation by modifying your application composer.json like this:

```
    "autoload": {
        "psr-4": {
            //....
            "MultipleFileUpload\\": "./plugins/MultipleFileUpload/src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            //...
            "MultipleFileUpload\\Test\\": "./plugins/MultipleFileUpload/tests/"
        }
    },
```

add this line to src/Application.php
```
$this->addPlugin('MultipleFileUpload');
```

Run db migration:
```
bin/cake migrations migrate -p MultipleFileUpload
```
or execute sql/files.sql

You need to have project model in your cakephp application

and add the ff to the ProjectTable

```
$this->hasMany('Files', [
	'foreignKey' => 'project_id',
	'className' => 'MultipleFileUpload.Files'
]);
```

store these variables in .env
FILE_MAX_SIZE_MB=1, by default it is 1MB
PROJECT_MODEL_NAME=Projects, by default it is Projects


Finally, make sure you delete files in tmp/cache/models/*, tmp/cache/persistent/* and tmp/cache/*


Example to include the view on other views:

Include this on head or layout or top of the view
```
    <?= $this->Html->css('MultipleFileUpload.main') ?>

	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		var base = '<?= $this->Url->build('/multiple-file-upload/'); ?>';
		(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
	</script>
	<?= $this->Html->css('MultipleFileUpload.style') ?>
	<?= $this->Html->script('MultipleFileUpload.script') ?>

```

and this on the main view:

```
<form method="post" action="<?= $this->Url->build('/multiple-file-upload/files/upload/'.$projectId); ?>" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">

	<div class="box__input">
		<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
		<input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
		<label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
		<button type="submit" class="box__button">Upload</button>
	</div>

	<div class="box__uploading">Uploading…</div>
	<div class="box__success">Done! <a href="<?= $this->Url->build('/multiple-file-upload/files/view/'.$projectId); ?>" class="box__restart" role="button">Upload more?</a></div>
	<div class="box__error">Error! <span></span>. <a href="<?= $this->Url->build('/multiple-file-upload/files/view/'.$projectId); ?>" class="box__restart" role="button">Try again!</a></div>
	<input type="hidden" name="ajax" value="1">
</form>

<div id="files">
	<?php echo $this->Element('view_files'); ?>
</div>

<script>
	$(document).ready(function(){
		$('a.remove').on('click', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$.ajax({
				url: url,
				method: 'GET',
				success: function(resp) {
					if(resp.success) {
						$('#file-'+resp.id).remove();
					}
				}
			});
		});
	});
</script>
```