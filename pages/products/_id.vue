<template>
<div>
  <CommonHeader/>
  <p>{{imageDetail.name}}</p>
  <p>{{imageDetail.price}}</p>
  <p>{{imageDetail.info_head}}</p>
  <img :src="`${url}/${imageDetail.file_name}`" alt="" >
  <p>{{imageDetail.info}}</p>
  <form>
    <input type="text" v-model="quantity">{{quantity}}
    <div v-on:click="addCart(imageDetail)">カートに入れる</div>
  </form>
</div>
</template>
<script>
export default {
  data() {
    return {
      imageDetail: [],
      url: "http://127.0.0.1:8000",
      quantity: null,
    };
  },
  methods: {
    async getProduct() {
      const sendData = {
        id: this.$route.params.id
      }
      const resData = await this.$axios.post("http://127.0.0.1:8000/api/show", sendData);
      this.imageDetail = resData.data.image;
      if (this.$auth.loggedIn) {
      }
    },
    async addCart(item) {
      item.quantity = this.quantity;
      console.log(item.quantity)
      this.$store.commit('addCart', item);
      const id = item.id
      this.$router.push({name: 'cart', params: { id }});
    }
  },
  created() {
    this.getProduct();
  }
};
</script>

<style>
img {
  width: 80%;
}
</style>