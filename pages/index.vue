<template>
  <div class="container">
      <CommonHeader/>
    <form @submit.prevent="login">
      <input type="email" v-model="newEmail" placeholder="email" required />
      <input type="password" v-model="newPassword" placeholder="password" required />
      <button type="submit">送信</button>
    </form>
    <form @submit.prevent="register">
      <input type="text" v-model="name" placeholder="name" required />
      <input type="email" v-model="email" placeholder="email" required />
      <input type="password" v-model="password" placeholder="password" required />
      <button type="submit">送信</button>
    </form>
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
    async getImage() {
      const resData = await this.$axios.get("http://127.0.0.1:8000/api/upload");
      this.file_name = this.url + resData.data.image[11].file_name;
      console.log(this.file_name);
      
    },
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
        this.$router.push("/top");
      } catch {
        alert("メールアドレスがすでに登録されています");
      }
    }
  },
    created() {
      this.getImage();

    }
};
</script>
