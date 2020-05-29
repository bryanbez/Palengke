import axios from 'axios';

const state = {
    cartList: [],
    username: checkAuth,
    specificCartInfo: {
        'cart_id': '',
        'customer_name': '',
        'product_id': '',
        'price': '',
        'quantity': '',
        'total_price': '',
        'product_name': '',
        'product_image': '',
        'txtTotalPrice': '',
        'txtQuantity': '',
      },
      updateQuantityMessage: '',
      deleteCartMessage: ''
};

const getters = {
    getCartList: state => state.cartList,
    getSpecificCartInfo: state => state.specificCartInfo,
    getupdateQuantityMessage: state => state.updateQuantityMessage,
    getDeleteCartMessage: state => state.deleteCartMessage,
};

const actions = {
    async showCartList({ commit }, username) {
        const response = await axios.get(`http://127.0.0.1:8000/api/cart/${username}/show`);
        console.log(response.data.data);
        commit('setCartList', response.data.data);
    },
    async showSpecificCart({ commit }, [username, cart_id]) {
        let url = `http://127.0.0.1:8000/api/cart/${username}/show/${cart_id}`;
        const response = await axios.get(url);
        commit('setSpecificCartList', response.data.data[0]);
    },
    async updateCartQuantity({ commit }, quantityToUpdate) {
        let url = `http://127.0.0.1:8000/api/cart/${quantityToUpdate.username}/show/${quantityToUpdate.cart_id}/editquantity`;
        const response = await axios.post(url, quantityToUpdate);
        commit('setUpdateCartMessage', response.data);
    },
    async deleteCart({ commit }, cart_id) {
        let url = `http://127.0.0.1:8000/api/cart/${state.username}/remove/${cart_id}`;
        const response = await axios.delete(url, cart_id);
        commit('setDeleteCartMessage', response.data);
    }
    
};

const mutations = {
    setCartList: (state, response) => (state.cartList = response),
    setSpecificCartList: (state, response) => {
        state.specificCartInfo.cart_id = response.cart_id,
        state.specificCartInfo.customer_name = response.orderDetails.customer_name,
        state.specificCartInfo.product_id = response.orderDetails.product_id,
        state.specificCartInfo.price = response.orderDetails.price,
        state.specificCartInfo.quantity = response.orderDetails.quantity,
        state.specificCartInfo.total_price = response.orderDetails.total_price,
        state.specificCartInfo.product_name = response.product_info.product_name,
        state.specificCartInfo.product_image = response.product_info.product_image
    },
    setUpdateCartMessage: (state, response) => (state.updateQuantityMessage = response),
    setDeleteCartMessage: (state, response) => (state.deleteCartMessage = response)
    
};

export default {
    state,
    getters,
    actions,
    mutations
};