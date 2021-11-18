<template>
  <div>
    <CommonHeader/>
    <h1>購入履歴</h1>
    <div v-for="item in histories" :key="item.id">
      <p>{{ item.order_id }}</p>
      <p>{{ item.created_at }}</p>
      <p>{{ item.quantity }}</p>
      <p>{{ item.item.name }}</p>
      <p>{{ item.item.price }}</p>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        histories: [],
        histories2: [],
        histories3: []
      }
    },
    methods: {
      async getHistroy() {
        const resData = await this.$axios.get("http://127.0.0.1:8000/api/history")
        this.histories = resData.data.items
        // console.log(test)
        // for(let i = 0; i < test.length; i++) {
        //     console.log(test[i])
        //     this.histories[i] = test[i]
        //     // console.log(test2)
        //     // for(let a = 0; a < test2.length; a++) {
        //     //   console.log(test2[a])
        //     //   this.histories[a] = test2[a]
        //     // }
        //       // console.log(test)
        // }
        // console.log(this.histories)
        // for(let i =0; i < this.histories.length; i++) {
        //   // console.log(this.histories[i])
        // }
      }
    },
    created() {
      this.getHistroy()
    }
  }
</script>