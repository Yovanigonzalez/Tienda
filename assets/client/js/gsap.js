document.addEventListener("DOMContentLoaded", function() {
    
    const containers = document.getElementById("pin");

    ScrollTrigger.create({
        trigger: containers,
        pin: ".pin",
        start: 'top top',
        end: 'bottom bottom',
        markers: true,
      });
      
      let headings = gsap.utils.toArray(containers);
      gsap.set(headings, { yPercent: 400, opacity: 0})
      
      headings.forEach((heading, i) => {
        let tl = gsap.timeline({
          scrollTrigger: {
            trigger: ".trigger",
            start: () => `top+=${i * window.innerHeight} top`,
            end: () => `top+=${(i + 1) * window.innerHeight} top`,
            markers: true,
            scrub: true
          }
        });
        
        tl.to(heading, { yPercent: 0, opacity: 1})
        .to(heading, { yPercent: -400, opacity: 0}, "+=1")
      });
      
  });