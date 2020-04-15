import $ from 'jquery';

class HeroSlider {
  constructor() {
    // this.els = $(".hero-slider");
    this.els = $(".multiple-items");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      // autoplay: true,
      arrows: false,
      dots: true,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
    });
  }
}

export default HeroSlider;