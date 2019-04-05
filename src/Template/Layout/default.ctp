<!DOCTYPE html>
<html lang="en" class="js gr__css-tricks_com"><head>
	<meta charset="utf-8">
	<title>MultipleFileUpload:<?= $this->fetch('title') ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('MultipleFileUpload.main') ?>

	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		var base = '<?= $this->Url->build('/multiple-file-upload/'); ?>';
		(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
	</script>
	<?= $this->Html->css('MultipleFileUpload.style') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body data-gr-c-s-loaded="true">

	<div class="container" role="main">

		<?= $this->Flash->render() ?>

		<?= $this->fetch('content') ?>

	</div>
	<?= $this->Html->script('MultipleFileUpload.script') ?>
</body>
</html>