var videoAyuda = {
    FFN: ["#",
        "../../seiya/videos/FF1.mp4",
        "../../seiya/videos/FF2.mp4",
        "../../seiya/videos/FF3.mp4",
        "../../seiya/videos/FF4.mp4",
        "",
        "",
        "",
        "../../seiya/videos/FF8.mp4",
        "../../seiya/videos/FF9.mp4",
        "../../seiya/videos/FF10.mp4",
        "../../seiya/videos/FF11.mp4",
        "../../seiya/videos/FF12.mp4",
        "../../seiya/videos/FF13.mp4",
        "../../seiya/videos/FF14.mp4",
        "../../seiya/videos/FF15.mp4",
        "../../seiya/videos/FF16.mp4",
        "../../seiya/videos/FF17.mp4"
    ],
    SSN: [
        "../../seiya/videos/servicio.mp4",
        "../../seiya/videos/solicitudes-bien.mp4",
        "../../seiya/videos/exterior.mp4"
    ],
    FAC: ["../../seiya/videos/Cliente.mp4",
        "../../seiya/videos/Inventario.mp4",
        [
            "../../seiya/videos/factura-contado.mp4",
            "../../seiya/videos/factura-credito.mp4",
            "../../seiya/videos/Proforma-Factura.mp4"
        ],
        "../../seiya/videos/proforma.mp4",
        "../../seiya/videos/recibos.mp4",
        "../../seiya/videos/deposito.mp4"
    ],
    CATA:[
     "",
     "",
     "../../seiya/videos/vehiculo.mp4"
    ],
    FORMULARIOS: ["../../seiya/videos/formularios.mp4"],
    muestraVideo: function (nombre, direccion) {
        modalBootstrap(nombre, '<video style="border: 5px solid #009cde;" width="569" height="440" controls> <source src="' + direccion + '" type="video/mp4"> Your browser does not support the video tag. </video>');
    },
    muestraVideoFFN: function (i) {
        this.muestraVideo("Ayuda FF" + i, this.FFN[i]);
    },
    muestraVideoFAC: function (titulo, i, j) {
        if (j == undefined) {
            this.muestraVideo(titulo, this.FAC[i]);
        } else {
            this.muestraVideo(titulo, this.FAC[i][j]);
        }
    },
    muestraVideoCATALOGO:function(titulo, i){
        this.muestraVideo(titulo, this.CATA[i]);
    }
};