<template>
  <div>
    <CommonHeader />
    <h1 class="cart_head">ショッピングカート</h1>
    <div class="flex">
      <div class="cart_content">
        <div class="cartList_content" v-for="(item, index) in cast" :key="`first-${index}`">
          <img class="cartList-img" :src="`${url}/${item.file_name}`" alt="" >
          <div class="cartList-name_content">
            <p class="cartList-name cart_txt">{{ item.name }}</p>
            <button class="cartList-delete cart_txt button" @click="remove(item)">削除する</button>
          </div>
          <p class="cartList-quantity_txt cart_txt">個数：<span class="cartList-quantity">{{ item.quantity }}</span></p>
          <p class="cartList-price cart_txt">￥{{ item.price }}(税込)</p>
        </div>
      </div>
      <div class="totalPrice_content">
        <div class="total_content-inner">
          <p class="cartList-total">合計：￥{{ cartTotalPrice }}(税込)</p>
          <button class="
          cartList-button cartList-order" @click="orderCart(cast)">注文する</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "http://127.0.0.1:8000",
      flag: this.$route.params.test
    };
  },
  computed: {
    cartList() {
      console.log("test", this.$store.state.productList);
      return this.$store.state.productList
    },
    cast() {
      return this.$store.state.cartList
    },
    cartTotalPrice() {
      return this.$store.getters.cartTotalPrice
    }
  },
  methods:  {
    remove(item) {
      this.$store.commit('removeItem', item)
    },
    async orderCart(items) {
      console.log(this.$store.getters.cartProducts)
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
    console.log(this.cast)
  }
}
</script>
