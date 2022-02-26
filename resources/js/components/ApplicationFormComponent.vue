<template>
  <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-7 mx-auto">
    <div class="card">
      <div class="card-header">申込フォーム</div>
      <div class="card-body">
        <form action="/application" method="POST">
          <input type="hidden" name="_token" :value="csrf" />
          <div class="row">
            <div class="p-1 col-12">
              <label for="name" class="form-label m-0">氏名</label>
              <div class="input-group has-validation">
                <span
                  class="input-group-text d-flex justify-content-center"
                  
                >
                  <i class="fas fa-user"></i>
                </span>
                <input
                  type="text"
                  :class="[
                    'form-control',
                    {
                      'is-invalid': name_error,
                      'is-valid': name_error === '',
                    },
                  ]"
                  placeholder="例：佐藤太郎"
                  id="name"
                  name="name"
                  required
                  v-model="name"
                  @blur="checkName()"
                />
                <div class="invalid-feedback">
                  {{ name_error }}
                </div>
              </div>
            </div>
            <div class="p-1 col-sm-6">
              <label for="email" class="form-label m-0">メールアドレス</label>
              <div class="input-group has-validation">
                <span
                  class="input-group-text d-flex justify-content-center"
                  
                >
                  <i class="fas fa-envelope"></i>
                </span>
                <input
                  type="text"
                  :class="[
                    'form-control',
                    {
                      'is-invalid': email_error,
                      'is-valid': email_error === '',
                    },
                  ]"
                  placeholder="例：chiba-univ@email.com"
                  id="email"
                  name="email"
                  required
                  v-model="email"
                  @blur="checkEmail()"
                />
                <div class="invalid-feedback">
                  {{ email_error }}
                </div>
              </div>
            </div>
            <div class="p-1 col-sm-6">
              <label for="tel" class="form-label m-0">緊急連絡先</label>
              <div class="input-group has-validation">
                <span
                  class="input-group-text d-flex justify-content-center"
                  
                >
                  <i class="fas fa-phone-alt"></i>
                </span>
                <input
                  type="text"
                  :class="[
                    'form-control',
                    {
                      'is-invalid': tel_error,
                      'is-valid': tel_error === '',
                    },
                  ]"
                  placeholder="例：012-3456-7890"
                  id="tel"
                  name="tel"
                  required
                  v-model="tel"
                  @blur="checkTel()"
                />
                <div class="invalid-feedback">
                  {{ tel_error }}
                </div>
              </div>
            </div>
            <div class="px-2 py-3">
              <div
                class="
                  card
                  bg-light
                  border-top-0
                  border-end-0
                  border-bottom-0
                  border-secondary
                  border-3
                  rounded-0
                "
              >
                <div class="card-body">
                  <p class="card-text">
                    <small class="text-muted"
                      >※新型コロナウイルス感染症対策のため、ご来場される方全員分の申込をお願い致します。<br />
                      ※携帯電話等をお持ちでないお子様は、保護者様のメールアドレスをご入力いただきますよう、お願い致します。</small
                    >
                  </p>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-sm btn-primary rounded-pill px-3">
                申し込む
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      name: "",
      email: "",
      tel: "",
      // バリデーションエラー
      name_error: null,
      email_error: null,
      tel_error: null,
      // csrfトークン
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  methods: {
    checkName() {
      if (this.name) {
        this.name_error = "";
      } else {
        this.name_error = "氏名は必須です";
      }
    },
    checkEmail() {
      var reg =
        /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/;
      if (reg.test(this.email)) {
        this.email_error = "";
      } else {
        this.email_error = "メールアドレスを正しく入力してください";
      }
    },
    checkTel() {
      var tel = this.tel.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, "");
      var reg = /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/;
      if (reg.test(tel)) {
        this.tel_error = "";
      } else {
        this.tel_error = "電話番号を正しく入力してください";
      }
    },
  },
  props: { errors: Object, old: Object },
  mounted: function () {
    if (!Array.isArray(this.errors)) {
      this.name_error = this.errors.name ? this.errors.name[0] : "";
      this.email_error = this.errors.email ? this.errors.email[0] : "";
      this.tel_error = this.errors.tel ? this.errors.tel[0] : "";
    }
    if (!Array.isArray(this.old)) {
      this.name = this.old.name;
      this.email = this.old.email;
      this.tel = this.old.tel;
    }
  },
};
</script>
