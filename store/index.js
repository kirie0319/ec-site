export const state = () => ({
  cartList: [],
  productList: []
});

export const getters = {
  cartProducts(state) {
    return state.productList.map(cart => {
      const product = state.cartList.find(product => {
        return product.image_id === cart.id
      });
      return {
        id: cart.id,
        name: cart.name,
        price: cart.price,
        file_name: cart.file_name,
        quantity: product.quantity
      }
    })
  },
  cartTotalPrice(state, getters) {
    return getters.cartProducts.reduce((total, product) => {
      return total + product.price * product.quantity
    }, 0)
  }
}

export const mutations = {
  addCart(state, product) {
    state.cartList.push({
      image_id: product.id,
      quantity: product.quantity
    })
    console.log(product.quantity)
  },
  remove(state, { todo }) {
    state.cartList.splice(state.cartList.indexOf(todo), 1)
  },
  addProduct(state, item) {
    state.productList.push({
      id: item.id,
      file_name: item.file_name,
      name: item.name,
      price: item.price,
    })
    console.log('test')
  },
}

export const actions = {
  async getImages({ commit, state }, image_id) {
    const sendData = {
      id: image_id
    };
    const resData = await this.$axios.post("http://127.0.0.1:8000/api/show", sendData);
    commit('addProduct', resData.data.image);
  },
}