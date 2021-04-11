const openNav = document.querySelector('.mobile-nav-button');
const closeNav = document.querySelector('.close-nav-button');
let acc = document.querySelectorAll('.accordion');
const swip = document.querySelector('.swiper-container');

openNav.addEventListener('click', () => {
    document.querySelector('.nav-list').style.width = "100%";
});

closeNav.addEventListener('click', () => {
    document.querySelector('.nav-list').style.width = "0";
});

if(acc) {

    for (let i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
    }
}

if(swip)
var swiper = new Swiper('.swiper-container', {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    loop: true,
  });