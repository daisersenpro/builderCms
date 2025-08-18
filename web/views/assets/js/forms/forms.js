/*=============================================
Validación Form Bootstrap 5, 4
=============================================*/

// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


/*=============================================
Función para validar datos repetidos
=============================================*/
function validateDataRepeat(event, type){

  if(type == "landing"){

    var table = "landings";
    var linkTo = "title_landing";

  }

  var value = event.target.value;

  var data = new FormData();
  data.append("table", table);
  data.append("equalTo", value);
  data.append("linkTo", linkTo);

  $.ajax({

    url:"/ajax/forms.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response){  
      
      console.log("Response validation:", response); // Debug
      
      if(response.trim() == "EXISTS"){

        $(event.target).parent().addClass("was-validated");
        $(event.target).parent().children(".invalid-feedback").html("Este registro ya existe en la base de datos");
      
        event.target.value = "";

        return;

      }else if(response.trim() == "OK"){

        if(type == "landing"){

          validateJS(event, "text");

        }

      }

    }

  })




}


/*=============================================
Función para validar formularios
=============================================*/

function validateJS(event, type){

  $(event.target).parent().addClass("was-validated");

  if(type == "text"){

    var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if(!pattern.test(event.target.value)){

      $(event.target).parent().children(".invalid-feedback").html("El campo solo debe llevar texto");

      event.target.value = "";

      return;

    }else{

      createUrl(event, "url_landing");

    }
  
  }

}

/*=============================================
Función para crear Url's
=============================================*/

function createUrl(event, input){
 
  var value = event.target.value;
  
  value = value.toLowerCase();
  value = value.replace(/[#\\;\\$\\&\\%\\=\\(\\)\\:\\,\\'\\"\\.\\¿\\¡\\!\\?\\]/g, "");
  value = value.replace(/[ ]/g, "-");
  value = value.replace(/[á]/g, "a");
  value = value.replace(/[é]/g, "e");
  value = value.replace(/[í]/g, "i");
  value = value.replace(/[ó]/g, "o");
  value = value.replace(/[ú]/g, "u");
  value = value.replace(/[ñ]/g, "n");

  $("#"+input).val(value)

}

/*=============================================
Agregar nuevo plugin
=============================================*/

$(document).on("click",".addPlugin",function(){

  var randomNum = Math.ceil(Math.random() * 10000);

  var itemsPlugins = $(".itemsPlugins").length+randomNum;

  var blockPlugins = $(".blockPlugins").html().replace(/plugins_landing_0/g, "plugins_landing_"+itemsPlugins);

  $(this).before(blockPlugins);

  var pluginsList = JSON.parse($("#pluginsList").val());
  
  pluginsList.push("_"+itemsPlugins);
  console.log("pluginsList", pluginsList);

  $("#pluginsList").val(JSON.stringify(pluginsList));

})