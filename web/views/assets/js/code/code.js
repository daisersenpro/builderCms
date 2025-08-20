/*=============================================
Reziser
=============================================*/

$("table.tableReziser td:first-child")
.css({"position":"relative"})
.prepend("<div class='resizer'></div>")
.resizable({
	resizeHeight: false,
	handleSelector: "",
	onDragStart: function(e, $el, opt){

		if(!$(e.target).hasClass("resizer"))
			return false;
		return true;
	}
})

/*=============================================
Codemirror
=============================================*/

if($(".codemirror").length > 0){

	var classCodemirror = $(".codemirror");
	var typeCode;

	classCodemirror.each((i)=>{

		if($(classCodemirror[i]).attr("code") == "html"){

			typeCode = "text/html";
		} 


		if($(classCodemirror[i]).attr("code") == "css"){

			typeCode = "css";
		} 


		if($(classCodemirror[i]).attr("code") == "js"){

			typeCode = "javascript";
		} 

		var code = $(classCodemirror[i])[0];
		var editor = CodeMirror.fromTextArea(code, {
			lineNumbers : true,
			lineWrapping: true,
			tabSize:3,
			styleActiveLine: true,
			theme:"udb-dark",
			matchBrackets: true,
			autoRefresh:true,
			mode: typeCode
		});
		editor.on("change", function(event){

			$(".saveLanding").html(`<span class="spinner-border spinner-border-sm text-muted"></span> Guardando`);

			var codeEditor = event.getValue();
			
			updateCode($(classCodemirror[i]).attr("idCode"),codeEditor,$(classCodemirror[i]).attr("column"),$(classCodemirror[i]).attr("page"))

			/*=============================================
			Copiar código después de algún cambio
			=============================================*/			

			$(document).on("click",".copy-"+$(classCodemirror[i]).attr("code"),function(){

				copyToClipboard(event.getValue());

			})
		})

		/*=============================================
		Copiar código inicial del textarea
		=============================================*/	

		$(document).on("click",".copy-"+$(classCodemirror[i]).attr("code"),function(){

			copyToClipboard($(".copy-"+$(classCodemirror[i]).attr("code")).parent().children(".codemirror").val());

		})

		/*=============================================
		Evitar acceder al código
		=============================================*/

		if(localStorage.getItem("token-admin") == null){

			editor.on('mousedown', function(e){

				e.preventDefault();
			})
		}

	})

}


/*=============================================
Autoguardado
=============================================*/

function updateCode(idCode,codeEditor,column, page){

	/*=============================================
	Captura de pantalla de mi HTML
	=============================================*/

	html2canvas($("iframe").contents().find("body")[0], {
		useCORS: true
	}).then(function(canvas){

		var imgBase64 = canvas.toDataURL("image/jpeg", 1);

		// document.getElementById("contenedorCanvas").appendChild(canvas);

		var data = new FormData();
		data.append("idCode", idCode);
		data.append("codeEditor", codeEditor);
		data.append("column", column);
		data.append("img", imgBase64);
		data.append("token", localStorage.getItem("token-admin"));

		$.ajax({

			url: "/ajax/code.ajax.php",
			method: "POST",
			data: data,
			contentType: false,
	        cache: false,
	        processData: false,
	        success: function (response){  
	        	
	        	if(response == 200){

	        		$(".saveLanding").html(`<i class="fas fa-save"></i> Autoguardado <i class="fas fa-check"></i>`)
	        		$("#myIframe iframe").attr("src",page+"?scroll=custom")
	        	}
	        }
		})

	})

	


}

/*=============================================
Navegar entre códigos
=============================================*/

$(document).on("click",".changeCode",function(){

	var mode = $(this).attr("mode");
	var modulesCode = $(".modulesCode");
	var countModules = 0;

	modulesCode.each((i)=>{

		$(modulesCode[i]).hide();

		countModules++;

		if(countModules == modulesCode.length){

			$(".module"+mode).show();	
		}
	})

})

/*=============================================
Copiar en el portapapeles
=============================================*/

function copyToClipboard(code){
	
	var textArea = document.createElement("textarea");
	textArea.value = code;

	document.body.appendChild(textArea);

	textArea.focus();

	textArea.select();

	try{

		document.execCommand("copy");
		fncToastr("success", "código copiado en el portapapeles");
	
	}catch(err){

		fncToastr("error", "El código no se pudo copiar en el portapapeles");

	}

	document.body.removeChild(textArea);

}

/*=============================================
Eliminar Landing y Codigo
=============================================*/

$(document).on("click", ".deleteLanding", function(){

	var idDelete = $(this).attr("idLanding");
	
	fncSweetAlert("confirm","¿Está seguro de borrar esta landing?","").then(resp=>{
		
		if(resp){

			var data = new FormData();
			data.append("idDelete",idDelete);
			data.append("token", localStorage.getItem("token-admin"));

			$.ajax({

				url: "/ajax/code.ajax.php",
				method: "POST",
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				success: function (response){ 

					if(response == 200){

						fncSweetAlert("success", "¡La landing ha sido eliminada correctamente!","/")
					}
				} 

			})  


		}

	})

})
