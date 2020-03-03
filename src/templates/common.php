<?php function draw_head($jsArray, $class = null) { ?>
  <!DOCTYPE html>
  <html lang="en-US">
	<head>
		<title>Key Share</title>
        <meta charset="UTF-8" name="viewport" content="initial-scale=1.0">
        <!-- bootstrap -->
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome -->
		<script src="../../assets/fontawesome/js/fontawesome.min.js"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">



		<?php foreach($jsArray as $jsFile) { ?>
			<script src=<?=$jsFile?> defer></script>
		<?php } ?>
	</head>
	<body <?=$class == null? '' : "class=$class" ?> > 
<?php } ?>

<?php function draw_footer() { ?>
        </body>
    </html>
<?php } 