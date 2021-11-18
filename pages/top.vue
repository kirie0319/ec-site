<template>
  <div>
    <CommonHeader/>
    <img src="http://127.0.0.1:8000/storage/images/sandal.jpg" alt="">
    <p v-if="$auth.loggedIn">test</p>
    <div v-for="image in imageLists" :key="image.id">
      <img :src="`${url}/${image.file_name}`" alt="" @click="productDetail(image.id)">
      <p>{{image.name}}</p>
      <p>{{image.price}}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      imageLists: [],
      url: "http://127.0.0.1:8000",
    };
  },
  methods: {
    async getImage() {
      const resData = await this.$axios.get("http://127.0.0.1:8000/api/upload");
      this.imageLists = resData.data.image;
    },
    productDetail(id) {
      this.$router.push({ name: 'products-id', params: { id }})
    }
  },
  created() {
    this.getImage();
  }
}
</script>


<style>
img {
  width: 80%;
}
</style>