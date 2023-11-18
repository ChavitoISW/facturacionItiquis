    function _FLOAT(obj) {
    num = obj.toString().replace(/,/g, '');
    num = _FVAL(num);
    num += '';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '.00';
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + ',' + '$2');
    }
    splitRight += '0';
    obj = splitLeft + splitRight.substr(0, 3);
    if (obj == "" || obj < 0)
        obj = "0.00";
    return obj;
}

function _FVAL(num) {
    var str = new String();
    str = num.toString();
    str = str.replace(/([^0-9\.\-])/g, '') * 1;
    if (isNaN(str))
        str = 0;
    return str;
}

function imprime() {
    return window.print();
}

function mOver(fila) {
    fila.style.background = "#333";
    fila.style.color = "#FFF";
    fila.style.cursor = "pointer";
}

function mOut(fila) {
    fila.style.background = "";
    fila.style.color = "#000";
    fila.style.cursor = "pointer";
}

function Mal(cantidad, valor) {
    if (valor.length < cantidad) {
        return true;
    }

    var p1 = valor;
    var espacios = true;
    var cont = 0;

    while (espacios && (cont < p1.length)) {
        if (p1.charAt(cont) != " ") {
            espacios = false;
        }
        cont++;
    }

    if (espacios) {
        return true;
    }

    return false;
}

function Kira(_OPC) {

    var parametros = {
        "_EXIT": _OPC
    };

    $.ajax({
        data: parametros,
        url: __SHELL__,
        type: 'post',
        beforeSend: function () {},
        success: function (_response) {
            switch (_response) {
                case '2':
                    //swal('Alerta!', 'La pagina solicitada no pudo ser encontrada.', 'warning');
                    swal('Alerta!', 'Estamos actualizando la informacion. En breve estará disponible', 'warning');
                    break;
                default:
                    lolo = _response.split("|");
                    if (lolo[0] == '0')
                        window.location.href = lolo[1];
                    else
                        window.open(lolo[1], '', 'width=900,height=600,scrollbars=yes,status=no');
                    break;
            }
        }
    });
}

function modalBootstrap(titulo, contenido, tamano, requerido) {
    if (tamano === undefined) {
        tamano = "";
    }
    if (requerido === undefined) {
        requerido = false;
    }
    $("#myModal").remove();
    if (requerido) {
        $("body").append('<div style="top: 45px;" id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"> <div class="modal-dialog ' + tamano + ' " role="document"> <div class="modal-content"> <div class="modal-header">  <h4 class="modal-title">' + titulo + '</h4> </div> <div class="modal-body"> <p>' + contenido + '</p> </div> <div class="modal-footer">  </div> </div></div></div>');
    } else {
        $("body").append('<div style="top: 45px;" id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"> <div class="modal-dialog ' + tamano + ' " role="document"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">' + titulo + '</h4> </div> <div class="modal-body"> <p>' + contenido + '</p> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> </div> </div></div></div>');
    }
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

var HtmlUtiles = {
    setActivoID: function (id, estado) {
        document.getElementById(id).disabled = estado;
    },
    setTituloId: function (id, titulo) {
        document.getElementById(id).title = titulo;
    },
    setOnchageActions: function (inputs, accion) {
        for (i = 0; i < inputs.length; i++) {
            inputs[i].onchange = function () {
                accion();
            };
        }
    },
    getUrlVars: function () {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    },
    // array of inputs
    getInputValues: function (inputs) {
        var arrayvalues = new Array();
        for (i = 0; i < inputs.length; i++) {
            arrayvalues.push(inputs[i].value);
        }
        return arrayvalues;
    },
    getHTMLValues: function (inputs) {
        var arrayvalues = new Array();
        for (i = 0; i < inputs.length; i++) {
            arrayvalues.push(inputs[i].innerHTML);
        }
        return arrayvalues;
    },
    getValuesNumeros: function (array) {
        for (i = 0; i < array.length; i++) {
            if (!this.isNumeroValido(array[i])) {
                array[i] = 0;
            }
        }
        return array;
    },
    getTaginnerHtml: function (inputs) {
        var arrayvalues = new Array();
        for (i = 0; i < inputs.length; i++) {
            arrayvalues.push(inputs[i].innerHTML);
        }
        return arrayvalues;
    },
    // array of values
    getSumaValues: function (values) {
        var suma = 0;
        for (i = 0; i < values.length; i++) {
            if ($.isNumeric(values[i])) {
                suma += parseFloat(values[i]);
            }
        }
        return suma;
    },
    getSumaInputs: function (inputs) {
        return this.getSumaValues(this.getInputValues(inputs));
    },
    isNumeroValido: function (num) {
        return $.isNumeric(num) && parseFloat(num) > 0;
    },
    isValuesValidos: function (array) {
        for (i = 0; i < array.length; i++) {
            if (array[i] == "") {
                return false;
            }
        }
        return true;
    },
    isValuesValidosInt: function (array) {
        for (i = 0; i < array.length; i++) {
            if (array[i] == "" || !this.isNumeroValido(array[i])) {
                return false;
            }
        }
        return true;
    },
    getDiasDiferencia: function (f1, f2) {
        var fecha1 = this.construyeFecha(f1);
        var fecha2 = this.construyeFecha(f2);
        var diasDif = fecha2.getTime() - fecha1.getTime();
        return Math.round(diasDif / (1000 * 60 * 60 * 24));
    },
    // fecha formato dia-mes-año
    construyeFecha: function (cadena) {
        array = cadena.split('-');
        return new Date(array[2].substring(0, 4), parseInt(array[1]) - 1, array[0]);
    },
    sumarDiasFecha: function (fecha, dias) {
        fecha.setDate(fecha.getDate() + dias);
        return fecha;
    },
    setCookie: function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    getCookie: function (cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
};

function cargarProyectos() {
    var parametros = {
        "_AJAX": 2,
        'proyecto': document.getElementById('proyecto').value
    };

    $.ajax({
        data: parametros,
        url: "../../seiya/shell/_menu.php",
        type: 'post',
        success: function (_response) {
            switch (_response) {
                case '0':
                    swal('Error!', 'No se pudo actualizar el proyecto de trabajo', 'warning');
                    break;
                case '1':
                    window.location.reload();
                    break;
            }
        }
    });
}
function cambiaProyecto() {
    var parametros = {
        "_AJAX": 1,
        'cs': "1"
    };

    $.ajax({
        data: parametros,
        url: "../../seiya/shell/_menu.php",
        type: 'post',
        success: function (_response) {
            modalBootstrap('Seleccione un proyecto', _response, '', 1);
        }
    });
}

function sidebarOpcion() {
    $('body').hasClass('sidebar-collapse')? HtmlUtiles.setCookie('sidebar', 1, 30):HtmlUtiles.setCookie('sidebar', 0, 30);
}

$(function() {
   if(HtmlUtiles.getCookie('sidebar')=='0'){
       $('body').addClass('sidebar-collapse');
   }
});