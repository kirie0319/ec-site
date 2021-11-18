<template>
  <div>
    <CommonHeader />
    <h1>ショッピングカート</h1>
    <ul>
      <li v-for="(item, index) in cast" :key="`first-${index}`">
        <p>{{ item.name }}</p>
        <p>{{ item.price }}</p>
        <img :src="`${url}/${item.file_name}`" alt="" >
        <p>{{ item.quantity }}</p>
      </li>
    </ul>
    <p>{{ cartTotalPrice }}</p>
    <div @click="orderCart(cast)">注文する</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "http://127.0.0.1:8000"
    };
  },
  computed: {
    cartList() {
      console.log("test", this.$store.state.productList);
      return this.$store.state.productList
    },
    cast() {
      return this.$store.getters.cartProducts
    },
    cartTotalPrice() {
      return this.$store.getters.cartTotalPrice
    }
  },
  methods:  {
    async orderCart(items) {
      var S="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
      var N=16
      const random_txt = Array.from(Array(N)).map(()=>S[Math.floor(Math.random()*S.length)]).join('')
      for(let i = 0; i < items.length; i++) {
        const sendData = {
          user_id: this.$auth.user.id,
          random_txt: random_txt,
          image_id: items[i].id,
          quantity: items[i].quantity
        }
        console.log(sendData)
        await this.$axios.post("http://127.0.0.1:8000/api/cart", sendData);
      }
      this.$router.push({name: 'thanks', params: { random_txt }})
    }
  },
  created() {
    this.$store.dispatch('getImages', this.$route.params.id);
  }
}
</script>
