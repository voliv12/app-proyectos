<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>

<?php echo validation_errors(); ?>

<div class="container-fluid">
        <h3><a><?php echo $titulo_tabla; ?></a></h3>
</div>
<div style="width:300%; text-align:center; padding-left: 40%;">
<ul class="nav nav-pills">
  <li><a href=" ">Link uno</a></li>
  <li><a href=" ">Link dos</a></li>
</ul>
</div>
<ol class="breadcrumb">
 	<?php //echo $barra_navegacion; ?>
</ol>

    <div>
		<?php echo $output; ?>
    </div>

</html>
