export const state = () => ({
  cartList: [],
});

export const getters = {
  cartTotalPrice(state, getters) {
    return state.cartList.reduce((total, product) => {
      return total + product.price * product.quantity
    }, 0)
  }
}

export const mutations = {
    addCart(state, product) {
      state.cartList.push({
        id: product.id,
        name: product.name,
        price: product.price,
        file_name: product.file_name,
        quantity: product.quantity
    })
    console.log(product.quantity)
  },
  removeCart(state) {
    state.cartList = [];
  },
  removeItem(state, product) {
    const cartItem = state.cartList.find(cart => cart.image_id === product.id)
    console.log(cartItem)
    if (cartItem) {
      state.productList.fileter(product => product.match(cartItem.image_id))
    }
  }
}