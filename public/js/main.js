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
      behavior: 'smooth'
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

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }
  /* lighbox product image in product details */
  /**
  * Initiate Gallery Lightbox 
  */
  // const productImageLightbox = GLightbox({
  //   selector: '.p-image-lb'
  // });

  // new Swiper('.subcategories-slider', {
  //   speed: 600,
  //   loop: false,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   slidesPerView: 'auto',
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   },
  //   breakpoints: {
  //     320: {
  //       slidesPerView: 1,
  //       spaceBetween: 10
  //     },

  //     1200: {
  //       slidesPerView: 6,
  //       spaceBetween: 20
  //     }
  //   }
  // });

  /**
   * Testimonials slider
   */
  // new Swiper('.testimonials-slider', {
  //   speed: 500,
  //   loop: true,
  //   autoplay: {
  //     delay: 1000,
  //     disableOnInteraction: false
  //   },
  //   slidesPerView: 'auto',
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   },
  //   breakpoints: {
  //     320: {
  //       slidesPerView: 1,
  //       spaceBetween: 20
  //     },

  //     1200: {
  //       slidesPerView: 2,
  //       spaceBetween: 20
  //     }
  //   }
  // });


  /**
   * Featured Products slider
  */
  var prodElement = '.fp-slider';
  var prodElementConfig = {
    speed: 1000,
    loop: false,
    watchOverflow: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      767: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 10
      },
      1200: {
        slidesPerView: 5,
        spaceBetween: 10
      }
    }
  }

  /**
   * Sub Category slider
  */
  var catElement = '.sc-slider';
  var catElementConfig = {
    speed: 1000,
    loop: false,
    watchOverflow: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      767: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 10
      },
      1200: {
        slidesPerView: 5,
        spaceBetween: 10
      }
    }
  }
 
  new Swiper(prodElement, prodElementConfig);
  new Swiper(catElement, catElementConfig);

  /**
   * Porfolio isotope and filter
   */
  // window.addEventListener('load', () => {
  //   let spcatContainer = select('.sp-cat-container');
  //   if (spcatContainer) {
  //     let spcatIsotope = new Isotope(spcatContainer, {
  //       itemSelector: '.sp-cat-item',
  //       layoutMode: 'fitRows'
  //     });

  //     let spcatFilters = select('#sp-cat-flters li', true);

  //     on('click', '#sp-cat-flters li', function(e) {
  //       e.preventDefault();
  //       spcatFilters.forEach(function(el) {
  //         el.classList.remove('filter-active');
  //       });
  //       this.classList.add('filter-active');

  //       spcatIsotope.arrange({
  //         filter: this.getAttribute('data-filter')
  //       });
  //     }, true);
  //   }

  // });

  /**
   * Initiate portfolio lightbox 
   */
  // const portfolioLightbox = GLightbox({
  //   selector: '.sp-cat-lightbox'
  // });

  // /**
  //  * Portfolio details slider
  //  */
  // new Swiper('.portfolio-details-slider', {
  //   speed: 400,
  //   loop: true,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   }
  // });

  var pageCount = 20; 

  if( $('#product-list').children().length > pageCount ) {

    $('#product-list').paginate({
      perPage: pageCount,
      useHashLocation: false
    });
  }

  $(document).on('change', '#filter-products', function(e) {

    let option = $(this).val();

    if( typeof($('#product-list').data('paginate')) != 'undefined' ) {
      $('#product-list').data('paginate').kill();
    }

    if( option == 'l2h' ) {
      sortAscending();
    }


    if( option == 'h2l' ) {
      sortDescending();
    }

    $('#product-list').paginate({
      perPage: pageCount,
      useHashLocation: false
    });

  });

  function sortAscending() {
  
    var productItems = $('#product-list .product-item-box');

    productItems.sort(function(a, b) {
      return $(a).data('price') - $(b).data('price');
    });

    $('#product-list').append(productItems);
  }

  function sortDescending() {
    var productItems = $('#product-list .product-item-box');

    productItems.sort(function(a, b) {
      return $(b).data('price') - $(a).data('price');
    });

    $('#product-list').append(productItems);
  }

  $(document).on('submit', '#search-form', function(e) {
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');
    let search = $(this).find('input[name=search]').val();

    // $.get( url, { search: search } );
    location.href = url + '/' + search;

    // console.log(url);

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
    // $(document).on('click', '.btn-inquire', function(e){

    //   e.preventDefault();

    //   var name = $(this).parent().data('product');
    //   var price = $(this).parent().data('price');


    //   $('.inquired-product').html(name);
    //   $('.inquired-price').html(price);

    //   $('#inquiry').val(name + '|' + price);

    //   modal.show();
    // });

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
