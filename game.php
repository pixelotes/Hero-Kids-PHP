<?php
	include './auth.php';
	include './main_pre.php';
?>
<!-- Page content starts here -->
	<iframe id="iFrame1" src="module05.php" width="100%" height="100%">
     </iframe>
	<script type="application/javascript">

	function resizeIFrameToFitContent( iFrame ) {

		//iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
		iFrame.width  = window.innerWidth;
		//iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
		iFrame.height = window.innerHeight;
	}

	window.addEventListener('resize', function () {  
		var iFrame = document.getElementById( 'iFrame1' );
		resizeIFrameToFitContent( iFrame );
		
	});

</script>
	<!-- Page content ends here -->
<?php
	include './main_post.php';
?>