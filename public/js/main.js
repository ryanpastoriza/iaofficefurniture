jQuery(document).ready(function($) {
  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

   /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }
  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'fast'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  let selectTopbar = select('#topbar')

  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.add('topbar-scrolled')
        }
      } else {
        selectHeader.classList.remove('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.remove('topbar-scrolled')
        }
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /* lighbox product image in product details */
  /**
  * Initiate Gallery Lightbox 
  */
  const productImageLightbox = GLightbox({
    selector: '.p-image-lb'
  });


  /*  */
  $(document).one('submit', '#inquiry-form', function(e) {
    e.preventDefault();
    e.stopPropagation();

    var form = $(this);
    var button = form.find('button');
    var url = window.location.origin + '/admin/inquiry/store';
    var data = form.serialize();

    button.prop('disabled', true);
    var posting = $.post(url, data);
        posting.done(function(response) {

          Swal.fire(
            'Inquiry has been sent',
            'Thank you for submitting your inquiry to us. We appreciate your interest in our products',
            'success'
          )

        form[0].reset();
        button.prop('disabled', false);
    });

  });

  if( $('.inquire-product-modal').length )  {

  var options = {
    'backdrop' : 'static'
  };

  var modal = new bootstrap.Modal($('.inquire-product-modal'), options);

  //  product details
  $(document).on('click', '.btn-inquire', function(e){

    e.preventDefault();

    var name = $('.pd-name').html();
    var price = $('.pd-price').html();


    $('.inquired-product').html(name);
    $('.inquired-price').html(price);

    $('#inquiry').val(name + '|' + price);

    modal.show();
  });

  $(document).on('submit', '#product-inquiry-form', function(e) {
    e.preventDefault();

   
    const Toast = Swal.mixin({
      toast: true,
      position: 'center',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });


    var url = window.location.origin + '/admin/inquiry/store';
    var data = $(this).serialize();
    var posting = $.post(url, data);
        posting.done(function(response) {

          modal.hide();

          Toast.fire({
            icon: response.status,
            title: response.message
          });
          
        });
  });

}

});