
gsap.registerPlugin(ScrollTrigger);

/** LINKVE */
gsap.from('.title', {
  duration: 1,
  x:-1200,
  delay:1,
  ase: "power3.out",
})

/** Suscribe */
gsap.from('.suscribe', {
    duration: 1,
    x:-900,
    delay:1.5,
    
})

/** Servicios */
var ns = gsap.timeline({
    scrollTrigger:{
    trigger: '#ns',
    //markers: true,
    start: '20px 80%',
    end: 'center center',
    scrub: 5,
    },
});
  
ns.fromTo('#ns', {
    opacity: 0,
    y: "-50%",
  }, {
    opacity: 1,
    y: "0%",
    duration: 1,
    ease: "Power3.easeOut",
  });

  var ns2 = gsap.timeline({
    scrollTrigger:{
    trigger: '#ns2',
    //markers: true,
    start: '20px 80%',
    end: 'center center',
    scrub: 5,
    },
});
  
ns2.fromTo('#ns2', {
    opacity: 0,
    y: "-50%",
  }, {
    opacity: 1,
    y: "0%",
    duration: 1,
    ease: "Power3.easeOut",
  });

  var nsb = gsap.timeline({
    scrollTrigger:{
    trigger: '.div-contac',
    //markers: true,
    start: '20px 80%',
    end: 'center center',
    scrub: 5,
    },
});
  
nsb.fromTo('.div-contac', {
    opacity: 0,
    y: "-50%",
  }, {
    opacity: 1,
    y: "0%",
    duration: 1,
    ease: "Power3.easeOut",
  });

  var servicios = gsap.timeline({
    scrollTrigger:{
    trigger: '.product-services',
    //markers: true,
    start: '30px 90%',
    end: 'center center',
    scrub: 5,
    },
});
  
servicios.fromTo('.product-services', {
    opacity: 0,
    transform: "translateX(-70%)",
  }, {
    opacity: 1,
    transform: "translateX(0%)",
    duration: 3,
    delay: 1,
    ease: "Power3.easeOut",
  });


  
  /** Categoria */







  /** Lazy Iamgenes */
ScrollTrigger.config({ limitCallbacks: true });

gsap.utils.toArray(".lazy").forEach(image => {
  
	let newSRC = image.dataset.src,
		  newImage = document.createElement("img"),
      
	loadImage = () => {
		newImage.onload = () => {
			newImage.onload = null; // avoid recursion
			newImage.src = image.src; // swap the src
			image.src = newSRC;
			// place the low-res version on TOP and then fade it out.
			gsap.set(newImage, {
				position: "absolute", 
				top: image.offsetTop, 
				left: image.offsetLeft, 
				width: image.offsetWidth, 
				height: image.offsetHeight
			});
			image.parentNode.appendChild(newImage);
			gsap.to(newImage, {
				opacity: 0, 
				onComplete: () => newImage.parentNode.removeChild(newImage)
			});
			st && st.kill();
		}
		newImage.src = newSRC;
	}, 
      
	st = ScrollTrigger.create({
		trigger: image,
		start: "-50% bottom",
		onEnter: loadImage,
		onEnterBack: loadImage // make sure it works in either direction
	});
});






