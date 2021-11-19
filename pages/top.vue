<template>
  <div>
    <CommonHeader/>
    <div class="top_header">
      <img class="top_img" src="http://127.0.0.1:8000/storage/images/sandal.jpg" alt="">
      <p class="top_txt_head">New Arrivals</p>
      <p class="top_txt-small">for BOYS & GIRLS</p>
    </div>
    <h1 class="top_cap">Products</h1>
    <div class="product-flex">
      <div class="product-card" v-for="image in imageLists" :key="image.id">
        <img class="product_img" :src="`${url}/${image.file_name}`" alt="" @click="productDetail(image.id)">
        <p>{{image.name}}</p>
        <p>￥{{image.price}}(税込)</p>
      </div>
    </div>
    <ul class="pagination">
      <li class="inactive" :class="(`${current_page}` == 1) ? 'disabled' : ''" @click="changePage(`${current_page}` - 1)" >«</li>
      <li v-for="page in middlePageRange" :key="page" @click="changePage(page)" :class="{'active' : isActive === page}">{{ page }}</li>
      <li class="inactive" :class="(`${current_page}` >= `${last_page}`) ? 'disabled' : ''" @click="changePage(current_page + 1)">»</li>
    </ul>
    <CopyRight />
  </div>
</template>

<script>
export default {
  data() {
    return {
      imageLists: [],
      url: "http://127.0.0.1:8000",
      current_page: 1,
      last_page: "",
      range: 5,
      isActive: '1'
    };
  },
  methods: {
    async getImage() {
      const resData = await this.$axios.get(`http://127.0.0.1:8000/api/upload?page=${this.current_page}`);
      console.log(resData.data.image)
      const image = resData.data.image;
      this.current_page = image.current_page;
      this.last_page = image.last_page;
      console.log(this.last_page)
      this.imageLists = image.data
    },
    productDetail(id) {
      this.$router.push({ name: 'products-id', params: { id }})
    },
    callRange(start, end) {
      const range = []
      for (let i = start; i <= end; i++) {
        range.push(i)
      }
      return range
    },
    changePage(page) {
      if (page > 0 && page <= this.last_page) {
        this.current_page = page
        this.isActive = page
        console.log(this.isActive)
        this.getImage()
      }
    },
    test(page) {
      console.log(page)
    }
  },
  created() {
    this.getImage();
  },
  computed: {
    middlePageRange() {
      let start = ""
      let end = ""
      if (this.current_page + 2 <= this.last_page) {
        end = this.current_page + 2
      } else {
        end = this.last_page
      }
      if (this.current_page - 2 > 0) {
        start = this.current_page - 2;
      } else {
        start = this.current_page
        end = this.current_page + 4
      }
      return this.callRange(start, end)
    },
  }
}
</script>