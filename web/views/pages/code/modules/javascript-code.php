<div class="modulesCode moduleJS" style="display:none">

	<?php if (isset($_SESSION["admin"])): ?>	
	<div class="copy-code-wrap copy-js">
		<div class="copy-code text-white text-center pt-1"><i class="fas fa-clipboard"></i></div>
	</div>
	<?php endif ?>
	
	<h4 class="small text-light">JS Editor</h4>

	<textarea class="codemirror" code="js" idCode="<?php echo $code->id_landing ?>" column="javascript_code" page="/<?php echo $code->url_landing ?>"><?php echo htmlspecialchars($code->javascript_code) ?></textarea>

</div>