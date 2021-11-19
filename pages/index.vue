<template>
  <div class="container">
      <CommonHeader/>
      <div class="login_register-container">
        <div class="login">
          <h2 class="txt_head">ログイン</h2>
          <p class="txt_info">会員のお客様</p>
          <p class="txt_info_detail">メールアドレスとパスワードを入力してログインしてください。</p>
          <form @submit.prevent="login">
            <div class="input_container">
              <label class="log_reg-label" for="email">メールアドレス：</label>
                <input class="log_reg-input" id="email" type="email" v-model="newEmail" placeholder="email" required />
              
            </div>
            <div class="input_container">
              <label class="log_reg-label label-tune" for="password">パスワード：</label>
                <input class="log_reg-input" type="password" v-model="newPassword" placeholder="password" required />
              
            </div>
            <button class="submit-button black-button" type="submit">ログイン</button>
          </form>
        </div>
        <div class="register">
          <h2 class="txt_head">新規会員登録</h2>
          <p class="txt_info">初めてご利用の方・会員以外の方</p>
          <p class="txt_info_detail">初めてご利用のお客様は、こちらから会員登録を行ってください。</p>
          <form @submit.prevent="register">
            <div class="input_container">
              <label class="log_reg-label" for="email">メールアドレス：</label>
                <input class="log_reg-input" id="email" type="email" v-model="email" placeholder="email" required />
              
            </div>
            <div class="input_container">
              <label class="log_reg-label label-tune" for="password">パスワード：</label>
                <input class="log_reg-input" id="passoword" type="password" v-model="password" placeholder="password" required />
              
            </div>
            <div class="input_container">
              <label class="log_reg-label name-label-tune" for="name">お名前：</label>
                <input class="log_reg-input" id="name" type="text" v-model="name" placeholder="name" required />
              
            </div>
            <button class="submit-button green-button" type="submit">新規会員登録</button>
          </form>
        </div>
      </div>
      <CopyRight />
  </div>
</template>

<script>
export default {
  data() {
    return {
      postLists: [],
      uid: null,
      file: null,
      file_name: null,
      url: "http://127.0.0.1:8000/",
      email: null,
      password: null,
      newEmail: null,
      newPassword: null,
      name: null,
    };
  },
  methods: {
    async login() {
      try {
        await this.$auth.loginWith("laravelJWT", {
          data: {
            email: this.newEmail,
            password: this.newPassword
          }
        });
        this.$router.push("/top");
      } catch {
        alert("メールアドレスまたはパスワードが間違っております");
      }
    },
    async register() {
      try {
        await this.$axios.post("http://localhost:8000/api/auth/register", {
          name: this.name,
          email: this.email,
          password: this.password
        });
        this.$router.push("/");
      } catch {
        alert("メールアドレスがすでに登録されています");
      }
    }
  },
    created() {
    }
};
</script>
