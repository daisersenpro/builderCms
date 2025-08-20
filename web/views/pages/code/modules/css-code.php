<div class="modulesCode moduleCSS" style="display:none">

	<?php if (isset($_SESSION["admin"])): ?>	
	<div class="copy-code-wrap copy-css">
		<div class="copy-code text-white text-center pt-1"><i class="fas fa-clipboard"></i></div>
	</div>
	<?php endif ?>
	
	<h4 class="small text-light">CSS Editor</h4>

	<textarea class="codemirror" code="css" idCode="<?php echo $code->id_landing ?>" column="css_code" page="/<?php echo $code->url_landing ?>"><?php echo htmlspecialchars($code->css_code) ?></textarea>

</div>