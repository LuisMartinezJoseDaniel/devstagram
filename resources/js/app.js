import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

try {
    //Buscar el elemento en el create.blade.html, en el form id ="dropzone"
    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,
        // funcion de inicializacion de dropzone
        init: function () {
            const inputHidden = document.querySelector(`[name="imagen"]`);
            if (!inputHidden.value.trim()) {
                return "";
            }

            const imagenPublicada = {};
            imagenPublicada.size = 1234; //debe de tener un size(cualquiera)
            imagenPublicada.name = inputHidden.value;
            //init =imagenPublicada, call llama automaticamente la funcion para asignarla a dropzone
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        },
    });

    // Cuando se envia un archivo
    // file ->contiene la info del archivo
    // formData-> contiene info del headers
    // dropzone.on( 'sending', (file, xhr, formData) => {
    //   console.log(file)
    // } );

    dropzone.on("success", (file, response) => {
        // console.log( response.imagen );
        const inputHidden = document.querySelector("#imagen");
        inputHidden.value = response.imagen; //response.imagen viene del servidor como json

        // console.log(inputHidden);
    });

    dropzone.on("error", (file, message) => {
        console.log(message);
    });

    dropzone.on("removedfile", (file) => {
        console.log("Archivo eliminado");
        //Al eliminar la imagen eliminar el value
        const inputHidden = document.querySelector(`[name="imagen"]`);
        inputHidden.value = "";
    });
} catch (error) {
    
}


