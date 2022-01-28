<template>
    <div class="card">
        <div class="card-header">申込フォーム</div>
        <div class="card-body">
            <form action="" @submit.prevent="submit()">
                <div class="row">
                    <div class="p-1 col-sm-6">
                        <label for="name" class="form-label m-0">氏名</label>
                        <div class="input-group has-validation">
                            <span
                                class="input-group-text d-flex justify-content-center"
                                style="width: 40px"
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
                                placeholder="例：千葉太郎"
                                id="name"
                                name="name"
                                required
                                v-model="name"
                                @blur="checkName()"
                            />
                            <div class="invalid-feedback">{{ name_error }}</div>
                        </div>
                    </div>
                    <div class="p-1 col-sm-6">
                        <label for="email" class="form-label m-0"
                            >メールアドレス</label
                        >
                        <div class="input-group has-validation">
                            <span
                                class="input-group-text d-flex justify-content-center"
                                style="width: 40px"
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
                        <label for="tel" class="form-label m-0">電話</label>
                        <div class="input-group has-validation">
                            <span
                                class="input-group-text d-flex justify-content-center"
                                style="width: 40px"
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
                                placeholder="例：090-1234-5678"
                                id="tel"
                                name="tel"
                                required
                                v-model="tel"
                                @blur="checkTel()"
                            />
                            <div class="invalid-feedback">{{ tel_error }}</div>
                        </div>
                    </div>
                    <div class="p-1 col-sm-6">
                        <label for="zip" class="form-label m-0">郵便番号</label>
                        <div class="input-group has-validation">
                            <span
                                class="input-group-text d-flex justify-content-center"
                                style="width: 40px"
                            >
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input
                                type="text"
                                :class="[
                                    'form-control',
                                    {
                                        'is-invalid': zip_error,
                                        'is-valid': zip_error === '',
                                    },
                                ]"
                                placeholder="例：123-4567"
                                id="zip"
                                name="zip"
                                maxlength="8"
                                required
                                v-model="zip"
                                @blur="checkZip()"
                            />
                            <div class="invalid-feedback">{{ zip_error }}</div>
                        </div>
                    </div>
                    <div class="p-1 col">
                        <label for="address" class="form-label m-0">住所</label>
                        <div class="input-group has-validation">
                            <span
                                class="input-group-text d-flex justify-content-center"
                                style="width: 40px"
                            >
                                <i class="fas fa-location-arrow"></i>
                            </span>
                            <textarea
                                type="text"
                                :class="[
                                    'form-control',
                                    {
                                        'is-invalid': address_error,
                                        'is-valid': address_error === '',
                                    },
                                ]"
                                placeholder="例：千葉市稲毛区弥生町1-33"
                                id="address"
                                name="address"
                                required
                                v-model="address"
                                @blur="checkAddress()"
                            ></textarea>
                            <div class="invalid-feedback">
                                {{ address_error }}
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-3 pb-2">
                        <button
                            class="btn btn-sm btn-primary"
                            v-if="is_validated"
                        >
                            申し込む
                        </button>
                        <button
                            class="btn btn-sm btn-secondary"
                            disabled
                            v-else
                        >
                            申し込む
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            name: "",
            email: "",
            tel: "",
            zip: "",
            address: "",
            // バリデーションエラー
            name_error: null,
            email_error: null,
            tel_error: null,
            zip_error: null,
            address_error: null,
        };
    },
    watch: {
        zip: function (zip, old_zip) {
            if (zip.length == 3 && old_zip.length <= 2) {
                this.zip = zip + "-";
            }
            // 郵便番号の形式だったら郵便番号を自動補完
            var reg = /^[0-9]{3}-[0-9]{4}$/;
            if (reg.test(this.zip)) {
                this.zip_error = "";
                var _this = this;
                new YubinBango.Core(zip, function (addr) {
                    _this.address = addr.region + addr.locality + addr.street; // 市区町村
                });
            }
        },
        address: function (address) {
            this.checkAddress();
        },
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
                axios
                    .post("/api/check-email", { email: this.email })
                    .then((res) => {
                        if (res.data) {
                            this.email_error = "既に登録済のメールアドレスです";
                        } else {
                            this.email_error = "";
                        }
                    });
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
        checkZip() {
            var reg = /^[0-9]{3}-[0-9]{4}$/;
            if (reg.test(this.zip)) {
                this.zip_error = "";
            } else {
                this.zip_error = "郵便番号を正しく入力してください";
            }
        },
        checkAddress() {
            if (this.address) {
                this.address_error = "";
            } else {
                this.address_error = "住所は必須です";
            }
        },
        submit() {
            axios
                .post("/api/tickets", {
                    name: this.name,
                    email: this.email,
                    tel: this.tel,
                    zip: this.zip,
                    address: this.address,
                })
                .then((res) => {
                    console.log(res);
                    window.location.href = "/application?is_created=true";
                });
        },
    },
    computed: {
        is_validated() {
            return (
                this.name &&
                this.email &&
                this.tel &&
                this.zip &&
                this.address &&
                !this.name_error &&
                !this.email_error &&
                !this.tel_error &&
                !this.zip_error &&
                !this.address_error
            );
        },
    },
};
</script>
