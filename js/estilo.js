function mOver(fila) {
    fila.style.background = "#E8F3FF";
}

function mOut(fila) {
    fila.style.background = "#FFFFFF";
}

function Info(nombre, descripcion, monto) {
    if (nombre === '') {
        nombre = '-';
    }

    if (descripcion === '') {
        descripcion = '-';
    }
    if (monto === '') {
        monto = '-';
    }



    contenido = '<ul class="todo-list">';
    contenido += '<li><i class="fa fa-book margin-r-5"></i> <b>Descripción:</b> ' + descripcion + '</li>';
    contenido += '<li><i class="fa fa-book margin-r-5"></i> <b>Producto:</b> ' + nombre + '</li>';
    contenido += '<li><i class="fa fa-credit-card margin-r-5"></i> <b>Monto:</b> &cent' + monto + ' CRC</li>';

    contenido += '</ul>';
    $("#myModal").remove();
    $("body").append('<div style="top: 45px;" id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><i class="ion ion-clipboard"></i> <b>Prodcuto:</b> ' + nombre + '</h4> </div> <div class="modal-body"> <p>' + contenido + '</p> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> </div> </div></div></div>');
    $('#myModal').modal();
}

function Selecciona(id, nombre, consecutivo, check) {

    if (check.checked == true) {
        check.checked = false;
    } else {
        check.checked = true;
    }
    Agrega(id, nombre, consecutivo);
}

function Agrega(id, nombre, consecutivo) {

    if (document.getElementById("ck" + id).checked == true) {
        alertify.error('Eliminó el producto "' + nombre + '"');
        document.getElementById("ck" + id).checked = false;
        AgregaLista(id, 'eliminar', consecutivo);
    } else {
        alertify.success('Agregó el producto "' + nombre + '"');
        document.getElementById("ck" + id).checked = true;
        AgregaLista(id, 'agregar', consecutivo);
    }

}

function getUnidades() {
    let total = (prompt("Ingrese cantidad de unidades", "1"));

    if (total != null) {
        return total
    }
}




function totalizar(tipoPago, accion, consecutivo, id){
    var parametros = {
        "_AJAX": 1,
        "tipoPago": tipoPago,
        "accion": accion,
        "consecutivo": consecutivo,
        "id":id,
    };
    $.ajax({
        data: parametrosAdentro,
        url: 'shellTotaliza.php',
        type: 'post',
        success: function (_responseAdentro) {
            switch (_responseAdentro) {
                case '-1' :
                    swal('Error!', 'Error en el envio de parametros [Err:-1].', 'error');
                    break;
                default:
                    swal.close();
                    document.getElementById("total").innerHTML = '&cent;' + _responseAdentro;
                    break;
            }
        }
    });
}

function anular(id, accion){
    var parametros = {
        "_AJAX": 1,
        "accion": accion,
        "consecutivo": id,
    };
    $.ajax({
        data: parametros,
        url: 'shellAnula.php',
        type: 'post',
        success: function (_response) {
            switch (_response) {
                case '-1' :
                    swal('Error!', 'Tiquete ya fue anulado anteriormente', 'error');
                    break;
                case '-2' :
                    swal('Error!', 'No existe consecutivo', 'error');
                    break;
                case '-3' :
                    swal('Error!', 'No se pueden anular tiquetes de fechas anteriores', 'error');
                    break;
                case '0' :
                    swal({
                        title: "Exito",
                        text: "Tiquete anulado correctamente",
                        icon: "success",
                        type:"success",
                        timer: 3000,
                        showConfirmButton: false
                    },
                function(){
                    window.location.href = "index.php";
                });
                    break;
                default:
                    swal.close();
                    break;
            }
        }
    });

}

function AgregaLista(id, accion, consecutivo)
{
    var unidades = 0
    if(accion == "agregar") {
        unidades = getUnidades();
    }
    var parametros = {
        "_AJAX": 1,
        "unidades": unidades,
        "accion": accion,
        "consecutivo": consecutivo,
        "id":id,
    };

    $.ajax({
        data: parametros,
        url: 'shellAgrega.php',
        type: 'post',
        success: function (_response) {

            switch (_response) {
                case '-1':
                    swal('Error!', 'El valor debe ser mayor a 0', 'error');
                    document.getElementById("ck" + id).checked = false;
                    break;
                case '-2':
                    swal('Error!', 'El valor debe ser numerico', 'error');
                    document.getElementById("ck" + id).checked = false;
                    break;
                case '1':

                    var parametrosAdentro = {
                        "_AJAX": 1,
                        "consecutivo": consecutivo,

                    };
                    $.ajax({
                        data: parametrosAdentro,
                        url: 'shellTotaliza.php',
                        type: 'post',
                        success: function (_responseAdentro) {
                            switch (_responseAdentro) {
                        case '-1' :
                            swal('Error!', 'Error en el envio de parametros [Err:-1].', 'error');
                            break;
                        default:
                            swal.close();
                            document.getElementById("total").innerHTML = '&cent;' + _responseAdentro;
                            break;
                        }
                        }
                    });

                    break;
                default:
                    swal.close();
                    break;
            }
        }
    });
}


function muestraOrden(consecutivo){
    var parametros = {
        "_AJAX": 1,
        "consecutivo": consecutivo,
    };
    $.ajax({
        data: parametros,
        url: 'shellVerPedido.php',
        type: 'post',
        success: function (_response) {
            switch (_response) {
                case '-1' :
                    swal('Error!', 'Error en el envio de parametros [Err:-1].', 'error');
                    break;
                default:
                    swal.close();
                    document.getElementById("resumen").innerHTML = _response;
                    break;
            }
        }
    });
}





function Selecciona2(id, nombre, check) {
    if (check.checked == true) {
        check.checked = false;
    } else {
        check.checked = true;
    }
    Agrega2(id, nombre);
}

function Agrega2(id, nombre) {
    if (document.getElementById("ck" + id).checked == true) {
        alertify.error('Eliminó el curso "' + nombre + '"');
        document.getElementById("ck" + id).checked = false;
    } else {
        alertify.success('Agregó el curso "' + nombre + '"');
        document.getElementById("ck" + id).checked = true;
    }
    Calcula2();
}

function Calcula2() {
    cantidad = document.getElementsByName("ck[]");
    ids = "";
    for (x = 0; x < cantidad.length; x++) {
        if (cantidad[x].checked) {
            ids += cantidad[x].getAttribute("id").replace("ck", "") + ",";
        }
    }
    var parametros = {
        "_AJAX": 1,
        "ids": ids
    };

    $.ajax({
        data: parametros,
        url: '../shell.php',
        type: 'post',
        success: function (_response) {
            switch (_response) {
                case '-1':
                    swal('Error!', 'Error en el envio de parametros [Err:-1].', 'error');
                    break;
                case '-99':
                    cantidad = document.getElementsByName("ck[]");
                    for (x = 0; x < cantidad.length; x++) {
                        cantidad[x].checked = false;
                    }
                    swal('Error!', 'El curso ha alcanzado su capacidad máxima, no hay espacios disponibles.', 'error');
                    break;
                default:
                    swal.close();
                    document.getElementById("total").innerHTML = '&cent;' + _response;
                    break;
            }
        }
    });
}