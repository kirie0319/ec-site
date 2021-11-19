<template>
  <header class="header">
    <h1 class="title">Trace</h1>
    <nav class="nav">
      <ul class="menu-group">
        <li class="menu-item">
          <p class="header-name" v-if="$auth.loggedIn" @click="$router.push('/top')">Name：{{ $auth.user.name }}</p>
        </li>
        <li class="menu-item">
          <img
          v-if="$auth.loggedIn" class="header-img" src="http://127.0.0.1:8000/storage/images/cart.png" @click="$router.push('/cart')"/>
        </li>
        <li v-if="$auth.loggedIn" class="menu-item">
          <img class="header-img" src="http://127.0.0.1:8000/storage/images/user.png" @click="$router.push('/history')"/>
        </li>
        <li class="menu-item">
          <img class="header-img" v-if="$auth.loggedIn" src="http://127.0.0.1:8000/storage/images/logout.png" @click="logout" />
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  methods: {
    async logout() {
      try {
        this.$store.commit('removeCart', this.$store.getters.cartProducts)
          console.log(this.$store.getters.cartProducts)
        await this.$auth.logout();
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>