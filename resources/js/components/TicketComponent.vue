<template>
  <div class="col-sm-6">
    <div class="card rounded-3 p-0">
      <div class="ratio ratio-16x9">
        <img
          src="images/ticket-image.png"
          style="object-fit: cover; border-radius: 0.3rem 0.3rem 0px 0px"
          alt="チケットの画像"
        />
      </div>
      <div class="card-body p-0">
        <div ref="slider" class="keen-slider">
          <div
            class="keen-slider__slide position-relative"
            style="padding-top: 20%"
            v-for="slide in slides"
            :key="slide.name"
          >
            <img
              class="position-absolute w-100 ticket-footer"
              src="images/ticket-image-footer.png"
              alt="チケットの画像"
            />
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
.ticket-footer {
  border-style: dashed;
  border-width: 0.1rem 0 0 0;
  top: 0;
  border-radius: 0px 0px 0.3rem 0.3rem;
}
</style>



