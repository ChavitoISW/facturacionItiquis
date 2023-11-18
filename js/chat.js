function muestraChat(tipo, solicitud) {
    var parametros = {
        "_AJAX": 1,
        "tipo": tipo,
        "solicitud": solicitud
    };
    $.ajax({
        cache: false,
        data: parametros,
        url: "../../seiya/shell/compras/_chat_aclaraciones.php",
        type: 'post',
        beforeSend: function () {
            swal({
                title: "Por favor espere!",
                text: "Se esta procesando la informacion!",
                type: "info",
                showConfirmButton: false
            });
        },
        success: function (_response) {
            var chat = JSON.parse(_response);
               str = '';
            if (chat.length > 0) {      
                for (i = 0; i < chat.length; i++) {
                    // $("#chatbox").append(getLineaMsj(chat[i].usuario, chat[i].fecha, chat[i].mensaje));
                    str += getLineaMsj(chat[i].usuario, chat[i].fecha, chat[i].mensaje);
                    str+="<hr>";
                }
                //modalBootstrap("Aclaraciones", $("#chat").html());
            }
             swal.close();
             modalBootstrap("Aclaraciones", cajaChat(str, solicitud, tipo));
        }
    });
}
function cajaChat(mensajes, solicitud, tipo) {
    return '  <div class="row"> <div class="col-md-8" style="width: 98%;"> <div class="portlet portlet-default"> <div class="portlet-heading"> <div class="portlet-title"> <h4><i class="fa fa-circle text-green"></i>Mensajes</h4> </div> <div class="clearfix"></div> </div> <div id="chat" class="panel-collapse collapse in"> <div> <div id="chatbox" class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;">' + mensajes + ' </div> </div> <div class="portlet-footer"> <form role="form"> <div class="form-group"> <textarea id="msjChat" class="form-control" placeholder="Ingrese el mensaje..."></textarea> </div> <div class="form-group"> <button onclick="enviarMensajeChat(' + solicitud + ',\'' + tipo + '\')" type="button" class="btn btn-default pull-right">Enviar</button> <div class="clearfix"></div> </div> </form> </div> </div> </div> </div> </div>';
}
function getLineaMsj(usuario, fecha, msj) {
    return ' <div class="row"> <div class="col-lg-12"> <div class="media"> <div class="media-body"> <h4 class="media-heading">' + usuario + ' <span class="small pull-right">' + fecha + '</span> </h4> <p>' + msj + '</p> </div> </div> </div> </div>';
}
function enviarMensajeChat(solicitud, tipo) {

    if ($("#msjChat").val() == "") {
        swal('Alerta!', 'Debe indicar el mensaje', 'warning');
        return;
    }
    var parametros = {
        "_AJAX": 2,
        "tipo": tipo,
        "solicitud": solicitud,
        "mensaje": $("#msjChat").val()
    };
    $.ajax({
        data: parametros,
        url: "../../seiya/shell/compras/_chat_aclaraciones.php",
        type: 'post',
        beforeSend: function () {
            swal({
                title: "Por favor espere!",
                text: "Se esta procesando la informacion!",
                type: "info",
                showConfirmButton: false
            });
        },
        success: function (_response) {
            if (_response == 1) {
                swal('Mensaje Enviado!', 'El mensaje se envio satisfactoriamente!', 'success');
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            } else {
                swal('Error!', 'No se pudo Enviar el mensaje', 'error');
            }
        }
    });
}