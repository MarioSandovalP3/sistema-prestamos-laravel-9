


function validateQuantity(input) {
  const value = input.value.trim();
  if (value === "" || value < 1) {
    input.value = 1; // Set default value to minimum if empty or less than 1
  }
}


let thumbnails = document.getElementsByClassName('thumbnail')

for(let i = 0; i < thumbnails.length; i++) {
  thumbnails[i].addEventListener('click', function(){
    featured.src = this.src
  })
}
$(document).ready(function () {
  $(".product-image").mousemove(function (e) {
    var $image = $(this).find("img");
    var offset = $(this).offset();
    var xPos = e.pageX - offset.left;
    var yPos = e.pageY - offset.top;

    var xPercent = (xPos / $image.outerWidth()) * 100;
    var yPercent = (yPos / $image.outerHeight()) * 100;

    $image.css("transform-origin", xPercent + "% " + yPercent + "%");
  });
});

function lazyLoad() {

  var lazyImages = document.querySelectorAll('img[data-src]');

  lazyImages.forEach(function(img) {
    if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !== 'none') {
      img.setAttribute('src', img.getAttribute('data-src'));
      img.removeAttribute('data-src');
      img.classList.remove('lazy');
    }
  });

  // Elimina los listeners una vez que todas las imágenes se han cargado
  if (lazyImages.length === 0) {
    window.removeEventListener('scroll', lazyLoad);
    window.removeEventListener('resize', lazyLoad);
    window.removeEventListener('orientationchange', lazyLoad);
  }
}

// Agrega los listeners de eventos para activar lazyLoad en diferentes situaciones
window.addEventListener('scroll', lazyLoad);
window.addEventListener('resize', lazyLoad);
window.addEventListener('orientationchange', lazyLoad);

// Inicia lazyLoad cuando se carga la página
window.addEventListener('load', lazyLoad);








    document.addEventListener('DOMContentLoaded', function () {
        showSnackbar();
    });
    
    function showSnackbar() {
        var snackbar = document.getElementById("mySnackbar");
        
        if (snackbar) {
            snackbar.classList.add("show");
            setTimeout(function () {
                snackbar.classList.remove("show");
            }, 5000);
        }
    }

    // Muestra la snackbar
    document.addEventListener('DOMContentLoaded', function () {
      showSnackbarError();
    });
    
    function showSnackbarError() {
        var snackbarError = document.getElementById("mySnackbarError");
        if (snackbarError) {
        snackbarError.classList.add("show");
        setTimeout(function(){
            snackbarError.classList.remove("show");
        }, 5000);
      }
    }

    function copyTextEmail(email) {
      const spanElement = document.getElementById(email);
      const texto = spanElement.textContent;
      const seleccion = window.getSelection();
      const rango = document.createRange();
    
      rango.selectNodeContents(spanElement);
      seleccion.addRange(rango);
    
      document.execCommand("copy");
    
      // Limpiar el portapapeles anterior
      seleccion.removeAllRanges();
    
      // Mostrar el mensaje de "Copiado!" al lado del botón después de copiar
      const mensajeCopiado = document.getElementById("copyEmail");
      mensajeCopiado.style.display = "inline-block";
                            
      // Ocultar el mensaje después de 2 segundos
      setTimeout(function() {
        mensajeCopiado.style.display = "none";
      }, 2000);
    }
    

    document.addEventListener('livewire:load', function(){
    
    // Cart
     window.livewire.on('cart-update', Msg => {
     Snackbar.show({
           pos: 'top-right',
                     actionText: Msg,
                     actionTextColor: '#ffffff',
                     backgroundColor: '#1d4252'
                     });   

     });
     window.livewire.on('cart-error', Msg => {
      Snackbar.show({
                pos: 'top-right',
               actionText: Msg,
               actionTextColor: '#ffffff',
               backgroundColor: '#d3212d'
               });
  });
     window.livewire.on('productDeleted', Msg => {
     Snackbar.show({
           pos: 'bottom-right',
                     actionText: Msg,
                     actionTextColor: '#ffffff',
                     backgroundColor: '#d3212d'
                     });       
     });
    
    

    
    
     window.livewire.on('clearCart', Msg => {
     Snackbar.show({
           pos: 'bottom-right',
                     actionText: Msg,
                     actionTextColor: '#ffffff',
                     backgroundColor: '#d3212d'
                     });       
     });
    
     // Index
    
     window.livewire.on('suscribe-ok', Msg => {
     Snackbar.show({
           pos: 'bottom-right',
                     actionText: Msg,
                     actionTextColor: '#ffffff',
                     backgroundColor: '#1d4252'
                     });     
     });
    
    
    
     window.livewire.on('suscribe-error', Msg => {
     Snackbar.show({
           pos: 'bottom-right',
                     actionText: Msg,
                     actionTextColor: '#ffffff',
                     backgroundColor: '#d3212d'
                     });       
     });
    
     // ContacUS
    
     window.livewire.on('contacus-ok', Msg => {
       Snackbar.show({
             pos: 'bottom-right',
                       actionText: Msg,
                       actionTextColor: '#ffffff',
                       backgroundColor: '#1d4252'
                       });     
       });
    
       window.livewire.on('contacus-error', Msg => {
       Snackbar.show({
             pos: 'bottom-right',
                       actionText: Msg,
                       actionTextColor: '#ffffff',
                       backgroundColor: '#d3212d'
                       });       
       });
    
       // Products
    
       window.livewire.on('calificacionExitosa', Msg => {
        Snackbar.show({
              pos: 'bottom-right',
                        actionText: Msg,
                        actionTextColor: '#ffffff',
                        backgroundColor: '#1d4252 '
                        });
        })
    
        window.livewire.on('product-add', Msg => {
    
        Snackbar.show({
              pos: 'bottom-right',
                        actionText: Msg,
                        actionTextColor: '#ffffff',
                        backgroundColor: '#1d4252 '
                        });
    
        })
    
//** Productos */


    // Also reset when the modal is closed via backdrop click or escape key
    $('#ratingAddedModal').on('hidden.bs.modal', function () {
        input.value = '';
        counter.textContent = '0 / 250';
    });
    
     window.livewire.on('productAdded', Msg => {
        
        $('#productAddedModal').modal('show')
    
      });

      window.livewire.on('reviewsAdded', Msg => {
        
        $('#ratingAddedModal').modal('show')
    
      });



      window.livewire.on('reviewsClose', Msg => {
        $('#ratingAddedModal').modal('hide')
 
      });
    
      window.livewire.on('product-error', Msg => {
              Snackbar.show({
                        pos: 'top-right',
                       actionText: Msg,
                       actionTextColor: '#ffffff',
                       backgroundColor: '#d3212d'
                       });
          });
    
    
    });


    

/** End */


    function increment() {
      var input = document.getElementById('product_quantity');
      var max = parseInt(input.max);
      var value = parseInt(input.value);
      
      if (value < max) {
          input.value = value + 1;
          
          input.dispatchEvent(new Event('input'));
      }
  }
  
  function decrement() {
      var input = document.getElementById('product_quantity');
      var min = parseInt(input.min);
      var value = parseInt(input.value);
      if (value > min) {
          input.value = value - 1;
          input.dispatchEvent(new Event('input'));
      }
  }


