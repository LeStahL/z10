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
      // centerMode: true,
      // centerPadding: '0',
    });
  }
}

export default HeroSlider;