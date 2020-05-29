import axios from 'axios';

const state = {
    products: [],
    singleProduct: [],
    addToCartResponse: ''

};

const getters = {
    allProducts: state => state.products,
    singleProduct: state => state.singleProduct,
    messageInAddToCart: state => state.addToCartResponse
};

const actions = {
    async fetchAllProducts({ commit }) {
        const response = await axios.get('http://127.0.0.1:8000/api/products_all');
        commit('setProducts', response.data.data);
    },
    async fetchSingleProducts({ commit }, product_id) {
        const response = await axios.get(`http://127.0.0.1:8000/api/product/show/${product_id}`);
        commit('setSingleProduct', response.data.data[0]);
    },
    async addToCustomerCart({ commit }, addToCartInfo) {
        const response = await axios.post('http://127.0.0.1:8000/api/cart', addToCartInfo);
        commit('passResponseMessage', response.data);
    },
};

const mutations = {
    setProducts: (state, products) => (state.products = products),
    setSingleProduct: (state, singleProduct) => (state.singleProduct = singleProduct),
    passResponseMessage: (state, message) => (state.addToCartResponse = message)
};

export default {
  state,
  getters,
  actions,
  mutations
};
