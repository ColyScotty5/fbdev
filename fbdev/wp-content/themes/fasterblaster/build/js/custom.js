function _mobileNavToggle() {
  var navButton = document.querySelector(".mobile-nav-toggle");
  var _mobileNav = document.querySelector(".main-header__mobile-nav");
  // console.log("Button is more certainly: " + navButton);
  navButton.addEventListener('click', function() {
      var expanded = this.getAttribute('aria-expanded') === 'true' || false;
      this.setAttribute('aria-expanded', !expanded);
      var menu = this.nextElementSibling;
      menu.hidden = !menu.hidden;
  });
}

function _initPageHeroCarousel() {
  var mySwiper = new Swiper('.swiper-container', {
    speed: 400,
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    }
  });
}

window.onload=function(){
  _initPageHeroCarousel();
  _mobileNavToggle();
}
