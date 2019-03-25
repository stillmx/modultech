
$( document ).ready(function() {

      // Contact form
    	var form = $('#main-contact-form');
      $("span.help-block").hide();
      $("#nombre").keyup(validar_nombre);
      $("#email").keyup(validar_email);
      //var validar = $("#btn-validar").on(function(){validar_nombre(), validar_email()});

        function validar_nombre(){
          var nombre = document.getElementById("nombre").value;

            if( nombre == null || nombre.length <= 2 || /^\s+$/.test(nombre) || !(/^[A-Za-z\_\-\.\s\xF1\xD1]+$/.test(nombre)) /*|| !(isNaN(nombre))*/) {
              $("#icono_nombre").remove();
              $("#nombre").parent().parent().addClass("form-group has-error has-feedback");
              $("#nombre").parent().children("span").text("Debe ingresar un nombre válido").show();
              $("#nombre").parent().append().append("<span id='icono_nombre' class='glyphicon glyphicon-remove form-control-feedback'></span>")
              return false;

          }

            else{
              $("#icono_nombre").remove();
              $("#nombre").parent().parent().removeClass("form-group has-error has-feedback");
              $("#nombre").parent().parent().addClass("form-group has-success has-feedback");
              $("#nombre").parent().children("span").text("").hide();
              $("#nombre").parent().append().append("<span id='icono_nombre' class='glyphicon glyphicon-ok form-control-feedback'></span>")
              return true;
            }
          }
        function validar_email(){
          var email = document.getElementById("email").value;
            if (email== null || !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))) {
              $("#icono_email").remove();
              $("#email").parent().parent().addClass("form-group has-error has-feedback");
              $("#email").parent().children("span").text("Debe ingresar un email válido").show();
              $("#email").parent().append().append("<span id='icono_email' class='glyphicon glyphicon-remove form-control-feedback'></span>")
              return false;
          }
            else {
              $("#icono_email").remove();
              $("#email").parent().parent().removeClass("form-group has-error has-feedback");
              $("#email").parent().parent().addClass("form-group has-success has-feedback");
              $("#email").parent().children("span").text("").hide();
              $("#email").parent().append().append("<span id='icono_email' class='glyphicon glyphicon-ok form-control-feedback'></span>")
            return true;
          }

}

      //form.submit(function(event){
    		//event.preventDefault();

          $("#btn-validar").click(function(event){
            event.preventDefault();
            var form_status = $('<div id="status" class="form_status"></div>');
            if(validar_nombre() && validar_email()){

      		$.ajax({
      			  url: 'sendemail.php',
            	beforeSend: function(){
      				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> El correo se está enviando...</p>').fadeIn() );
      			}
      		}).done(function(data){
            $("p.text-success").remove();
            $(":reset").click();
            $("#nombre,#email").parent().parent().removeClass("form-group has-success form-group has-error has-feedback");
            $("#icono_nombre, #icono_email").remove();
            form_status.html('<p class="text-success">Gracias por contactarnos. En el menor tiempo posible le estaremos contactando.</p>').delay(3000).fadeOut();
      		});
        }


      });



  });
