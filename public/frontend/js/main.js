// Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
	center: true,
	autoplay: true,
	dots: true,	
	margin:80,
	loop: true,
	nav: true,
	navText: true,
	responsiveClass:true,
	responsive: { 
		0: { items: 1 },
		nav: true,
		768: { items: 2 },
		nav: true,
		900: { items: 3 },
		nav: true,
	}  
  });
  
  