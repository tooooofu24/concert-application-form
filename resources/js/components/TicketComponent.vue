<template>
  <div class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div class="card rounded-3 p-0 border-0">
      <div class="ratio ratio-16x9">
        <img
          src="/images/ticket-image.png"
          style="object-fit: cover; border-radius: 0.3rem 0.3rem 0px 0px"
          alt="チケットの画像"
        />
        <div
          class="position-absolute w-100 ticket-footer h-100"
          v-if="uid == 'sample'"
        >
          <div class="p-3 h-100 align-middle d-flex align-items-center">
            <span
              class="mx-auto text-white fw-bold display-1"
              style="text-shadow: 0.1rem 0.1rem 0.3rem #808080"
              >Sample</span
            >
          </div>
        </div>
        <div class="ticket"></div>
      </div>
      <div class="card-body p-0">
        <div ref="slider" class="keen-slider">
          <!-- 使用前のスライド -->
          <div
            class="keen-slider__slide position-relative"
            style="padding-top: 20%"
            v-if="!is_used"
          >
            <img
              class="position-absolute w-100 ticket-footer"
              src="/images/ticket-image-footer.png"
              alt="チケットの画像"
            />
            <div class="position-absolute w-100 ticket-footer h-100">
              <div
                class="p-3 h-100 align-middle d-flex align-items-center fs-5"
              >
                <span class="fw-bold ps-2">入場する</span>
                <i
                  class="fas fa-angle-double-right ms-auto me-4 fa-lg animation"
                ></i>
              </div>
            </div>
          </div>

          <!-- 使用済みのスライド -->
          <div
            class="keen-slider__slide position-relative"
            style="padding-top: 20%"
          >
            <div class="position-absolute w-100 ticket-footer bg-gray h-100">
              <div
                class="p-3 h-100 align-middle d-flex align-items-center fs-5"
              >
                <span class="mx-auto text-white">使用済み</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 確認モーダル -->
    <div
      class="modal px-4"
      tabindex="-1"
      id="comfirm_modal"
      data-bs-backdrop="static"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <p class="text-center mb-3">
              本当に入場しますか？<br />（この操作は取り消せません）
            </p>
            <div class="text-end">
              <button
                type="button"
                class="btn btn-secondary btn-sm me-2"
                @click="canselEntry()"
                data-bs-dismiss="modal"
              >
                キャンセル
              </button>
              <button
                type="button"
                class="btn btn-primary btn-sm"
                @click="entry()"
                data-bs-dismiss="modal"
              >
                スライドして入場
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 入場済みモーダル -->
    <div class="modal px-4" tabindex="-1" id="complete_modal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header p-2 border-bottom-0">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body pt-0">
            <p class="text-center">入場処理が完了しました！</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "keen-slider/keen-slider.min.css";
import KeenSlider from "keen-slider";
import axios from "axios";

export default {
  data() {
    return {
      is_used: false,
    };
  },
  mounted() {
    if (this.is_used_data) {
      this.is_used = true;
    }
    this.slider = new KeenSlider(this.$refs.slider, {
      loop: true,
      disabled: this.is_used,
      created: (s) => {},
      animationEnded: (s) => {
        if (s.track.details.rel == 1) {
          this.confirmEntry();
        } else {
          this.slider.moveToIdx(0);
        }
      },
    });
  },
  methods: {
    // 確認モーダルを表示するメソッド
    confirmEntry() {
      var modal = new bootstrap.Modal(document.getElementById("comfirm_modal"));
      modal.show();
    },
    // キャンセルされた際のメソッド
    canselEntry() {
      this.slider.moveToIdx(0);
    },
    // 入場処理をするメソッド
    entry() {
      this.is_used = true;
      this.slider.update({
        disabled: true,
      });
      axios.post("/api/application/enter/" + this.uid).then((res) => {});
      setTimeout(() => {
        var modal = new bootstrap.Modal(
          document.getElementById("complete_modal")
        );
        modal.show();
      }, 500);
    },
  },
  props: {
    uid: String,
    is_used_data: Boolean,
  },
};
</script>

<style>
.ticket {
  background-image: linear-gradient(
    to right,
    #808080,
    #808080 0.5rem,
    transparent 0.5rem
  );
  background-size: 1rem 0.1rem;
  background-position: left bottom;
  background-repeat: repeat-x;
}
.ticket-footer {
  top: 0;
  border-radius: 0px 0px 0.3rem 0.3rem;
}
.animation {
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  animation-direction: alternate;
  animation-duration: 1s;
  animation-name: arrow;
}

.bg-gray {
  background-color: #888888;
}

@keyframes arrow {
  0% {
    transform: translate(0px, 0);
  }
  100% {
    transform: translate(1rem, 0);
  }
}
</style>



