<template>
  <header>
    <h1 class="title" @click="$router.push('/top')">Trace</h1>
    <nav class="nav">
      <ul class="menu-group">
        <li class="menu-item">
          <p v-if="$auth.loggedIn">Name：{{ $auth.user.name }}</p>
        </li>
        <li class="menu-item">
          <img src="http://127.0.0.1:8000/storage/images/cart.png" @click="$router.push('/cart')"/>
        </li>
        <li class="menu-item">
          <img src="http://127.0.0.1:8000/storage/images/user.png" @click="$router.push('/history')"/>
        </li>
        <li class="menu-item">
          <img v-if="$auth.loggedIn" src="http://127.0.0.1:8000/storage/images/logout.png" @click="logout" />
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
        await this.$auth.logout();
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style scoped>
header {
  display: flex;
  height: 100px;
  padding: 0 50px;
  margin-bottom: 30px;
  align-items: center;
}
.title {
  margin-right: auto;
}
.menu-item {
  list-style: none;
  display: inline-block;
  padding: 10px;
}
.menu-item a {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

img {
  width: 50px;
}
</style>
