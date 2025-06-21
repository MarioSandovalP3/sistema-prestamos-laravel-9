{{--
    Archivo de scripts principales del tema
    Contiene todas las dependencias JavaScript y funciones personalizadas
--}}

{{-- Librerías base --}}
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/loader.js') }}"></script>

{{-- Plugins adicionales --}}
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}" async></script>
<script async src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

{{-- Scripts de la aplicación --}}
<script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('js/fileinput.js') }}"></script>
<script src="{{ asset('js/input-carrusel.js') }}"></script>

{{-- Inicialización de componentes --}}
<script>
$(document).ready(function() {
    App.init(); // Inicialización principal
    $('[data-toggle="tooltip"]').tooltip(); // Activar tooltips de Bootstrap
});
</script>

{{-- Funciones para manejo de imágenes --}}
<script type="text/javascript">
/**
 * Oculta una imagen agregando la clase 'hidden-img'
 */
function ocultarImagen() {
    document.getElementById("myImage").classList.add("hidden-img");
}

/**
 * Limpia la imagen y texto asociado en un campo de carga
 */
function limpiarImagen() {
    document.getElementById('miImagen').src = "";
    document.getElementById('miSpan').textContent = "Agregar una imagen";
}

/**
 * Muestra vista previa de imagen seleccionada
 */
document.getElementById("myFileInput").addEventListener("change", function() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById("previewImage");
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});
</script>

{{-- Funciones utilitarias --}}
<script>
/**
 * Ajusta automáticamente la altura de un textarea según su contenido
 */
document.getElementById('body').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
});

/**
 * Muestra notificación tipo snackbar
 * @param {string} msg - Mensaje a mostrar
 * @param {number} option - Tipo de notificación (1=normal, otro=error)
 */
function noty(msg, option = 1) {
    SnackBar.show({
        text: msg.toUpperCase(),
        actionText: 'CERRAR',
        actionTextColor: '#fff',
        backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
        pos: 'top-right'
    });
}

// Validación de campos numéricos
jQuery(document).ready(function() {
    jQuery("#numinteger").on('input', function() {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
    
    jQuery("#numdecimal, #numdecimalp").on('input', function() {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9^.]/g, ''));
    });
});
</script>

{{-- Scripts de Livewire --}}
@livewireScripts