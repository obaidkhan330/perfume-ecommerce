(function($) {

	"use strict";

	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() {
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			autoplay: true,
			autoplaySpeed:2000,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();





  $(document).ready(function(){
    $('#hero-carousel').owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      smartSpeed: 800,
      nav: false,
      dots: true
    });
  });


	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');
				}
			}
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			}
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');
				}

				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var counter = function() {

		$('#section-counter, .wrap-about, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});

			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});

				}, 100);

			}

		} , { offset: '95%' } );
	};
	contentWayPoint();



	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });

  $('[data-toggle="popover"]').popover()
	$('[data-toggle="tooltip"]').tooltip()

})(jQuery);



// ciustom js

// Price slider text
const range = document.getElementById('priceRange');
const priceValue = document.getElementById('priceValue');
if (range && priceValue) {
  const format = v => 'PKR ' + Number(v).toLocaleString();
  priceValue.textContent = format(range.value);
  range.addEventListener('input', e => priceValue.textContent = format(e.target.value));
}


/* Qty +/- controls */
document.addEventListener('click', function(e){
  if(e.target.matches('[data-qty-btn]')){
    const btn = e.target;
    const wrap = btn.closest('.qty');
    const input = wrap.querySelector('input[type="number"]');
    const min = Number(input.min || 1);
    const max = Number(input.max || 999);
    let val = Number(input.value || min);
    if(btn.dataset.qtyBtn === 'minus') val = Math.max(min, val-1);
    if(btn.dataset.qtyBtn === 'plus')  val = Math.min(max, val+1);
    input.value = val;
    input.dispatchEvent(new Event('change'));
  }
});

/* Remove row (UI only) */
document.addEventListener('click', function(e){
  if(e.target.closest('[data-remove-row]')){
    const row = e.target.closest('tr');
    row?.remove();
    recomputeTotals();
  }
});

/* Recompute totals (very simple, UI only) */
function money(n){ return 'PKR ' + Number(n).toLocaleString(); }
function recomputeTotals(){
  const rows = document.querySelectorAll('[data-cart-row]');
  let sub = 0;
  rows.forEach(r=>{
    const price = Number(r.dataset.price || 0);
    const qty = Number(r.querySelector('input[type="number"]')?.value || 1);
    const cell = r.querySelector('[data-sub]');
    const rowTotal = price * qty;
    sub += rowTotal;
    if(cell) cell.textContent = money(rowTotal);
  });
  const subEl = document.querySelector('[data-subtotal]');
  const shipEl = document.querySelector('[data-shipping]');
  const totEl = document.querySelector('[data-total]');
  if(subEl){ subEl.textContent = money(sub); }
  const shipping = sub > 0 ? 250 : 0;
  if(shipEl){ shipEl.textContent = money(shipping); }
  if(totEl){ totEl.textContent = money(sub + shipping); }
}
document.addEventListener('change', e=>{
  if(e.target.matches('.qty input[type="number"]')) recomputeTotals();
});

/* Fake coupon apply (UI) */
document.addEventListener('submit', function(e){
  if(e.target.matches('[data-coupon-form]')){
    e.preventDefault();
    const code = e.target.querySelector('input')?.value?.trim().toUpperCase();
    const msg = document.querySelector('[data-coupon-msg]');
    if(code === 'AROMA10'){
      msg.className = 'alert alert-success mt-2';
      msg.textContent = 'Coupon applied: 10% off (UI only).';
    }else{
      msg.className = 'alert alert-warning mt-2';
      msg.textContent = 'Invalid coupon (demo). Try AROMA10.';
    }
  }
});

/* init after load */
window.addEventListener('load', recomputeTotals);


