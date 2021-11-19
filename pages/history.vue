<template>
  <div>
    <CommonHeader/>
    <div>
      <h1>購入履歴</h1>
      <div v-for="item in histories" :key="item.id">
        <p>{{ item.order_id }}</p>
        <p>{{ item.created_at }}</p>
        <p>{{ item.quantity }}</p>
        <p>{{ item.item.name }}</p>
        <p>{{ item.item.price }}</p>
      </div>
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
        const sendData = {
          user_id: this.$auth.user.id
        }
        const resData = await this.$axios.post("http://127.0.0.1:8000/api/history", sendData)
        this.histories = resData.data.items
      }
    },
    created() {
      this.getHistroy()
    }
  }
</script>