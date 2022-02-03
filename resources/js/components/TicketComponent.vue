<template>
  <div class="col-sm-6">
    <div class="card rounded-3 p-0 border-0">
      <div class="ratio ratio-16x9">
        <img
          src="images/ticket-image.png"
          style="object-fit: cover; border-radius: 0.3rem 0.3rem 0px 0px"
          alt="チケットの画像"
        />
        <div class="ticket"></div>
      </div>
      <div class="card-body p-0">
        <div ref="slider" class="keen-slider">
          <div
            class="keen-slider__slide position-relative"
            style="padding-top: 20%"
          >
            <img
              class="position-absolute w-100 ticket-footer"
              src="images/ticket-image-footer.png"
              alt="チケットの画像"
            />
            <div class="position-absolute w-100 ticket-footer h-100">
              <div
                class="p-3 h-100 align-middle d-flex align-items-center fs-5"
              >
                <i class="fas fa-angle-double-right ms-auto"></i>
              </div>
            </div>
          </div>
          <div
            class="keen-slider__slide position-relative"
            style="padding-top: 20%"
          >
            <div class="position-absolute w-100 ticket-footer">
              <img
                class="position-absolute w-100 ticket-footer"
                src="images/ticket-image-footer-used.png"
                alt="チケットの画像"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "keen-slider/keen-slider.min.css";
import KeenSlider from "keen-slider";

export default {
  name: "Slider",
  data() {
    return {
      index: 0,
      slides: [
        {
          name: "未使用",
        },
        {
          name: "使用済み",
        },
      ],
    };
  },
  mounted() {
    this.slider = new KeenSlider(this.$refs.slider, {
      loop: true,
      created: (s) => {},
      slideChanged: (s) => {
        this.index = s.track.details.rel;
        console.log(this.index);
      },
    });
  },
  beforeDestroy() {
    if (this.slider) this.slider.destroy();
  },
};
</script>

<style>
.ticket {
  background-image: linear-gradient(
    to right,
    #808080,
    #808080 1rem,
    transparent 0.3rem,
    transparent 10px
  ); /* 幅2の線を作る */
  background-size: 1.5rem 0.2rem; /* グラデーションの幅・高さを指定 */
  background-position: left bottom; /* 背景の開始位置を指定 */
  background-repeat: repeat-x; /* 横向きにのみ繰り返す */
}
.ticket-footer {
  top: 0;
  border-radius: 0px 0px 0.3rem 0.3rem;
}
</style>



