// alert('ok');
import Dropzone from "dropzone";

// if(document.querySelector('.dropzone')) {}

/* por defecto dropzone busca su clase pero nosotros le vamos a dar el comportamiento */
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpge, .gif",
    addRemoveLinks: true, /* poder eliminar imagen */
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false, /* solo se puede suir una sola foto */
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            /* como es un objeto si se puede asignarle valores apesar que sea un const */
            imagenPublicada.size = 123 /* este valor no importa, es un valor obligatorio solo porque asi lo requiere */
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            console.log(imagenPublicada.name);

            /* esto ya es codigo de dropzone */
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            /* clases de dropzone */
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    }
});

/* sending, success, error, removefile */
dropzone.on('success', function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', function() {
    document.querySelector('[name="imagen"]').value = '';
});