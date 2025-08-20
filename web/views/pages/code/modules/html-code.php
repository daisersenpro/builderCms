<div class="modulesCode moduleHTML">

	<?php if (isset($_SESSION["admin"])): ?>	
	<div class="copy-code-wrap copy-html">
		<div class="copy-code text-white text-center pt-1"><i class="fas fa-clipboard"></i></div>
	</div>
	<?php endif ?>
	
	<h4 class="small text-light">HTML Editor</h4>

	<textarea class="codemirror" code="html" idCode="<?php echo $code->id_landing ?>" column="html_code" page="/<?php echo $code->url_landing ?>"><?php echo htmlspecialchars($code->html_code) ?></textarea>

</div>