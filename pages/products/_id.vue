<template>
<div>
  <CommonHeader/>
  <div class="productDetail_card">
    <div class="productDetail_img-container">
      <img　class="productDetail_img" :src="`${url}/${imageDetail.file_name}`" alt="" >
    </div>
    <div class="productDetail_txt-container">
      <p class="productDetail_name">{{imageDetail.name}}</p>
      <p class="productDetail_price">￥{{imageDetail.price}}(税込)</p>
      <form>
        <label class="productDetail_quantity-label" for="quantity">個数</label>
        <input id="quantity" class="productDetail_quantity" type="text" v-model="quantity">
        <div class="productDetail_addCart" v-on:click="addCart(imageDetail)">カートに入れる</div>
      </form>
    </div>
  </div>
  <div class="productDetail_info">
    <p class="productDetail_info_head">{{imageDetail.info_head}}</p>
    <p class="productDetail_info_txt">{{imageDetail.info}}</p>
  </div>
  <CopyRight />
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
      const test = this.quantity
      if (test != null && test.match(/^([1-9]\d*|0)$/)) {
        item.quantity = this.quantity;
      } else {
        return alert('正しい値を入力してください')
      }
      console.log(item.quantity)
      this.$store.commit('addCart', item);
      const id = item.id
      this.$store.dispatch('getImages', id);
      this.$router.push({name: 'cart'});
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