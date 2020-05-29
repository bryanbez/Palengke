import axios from 'axios';

const state = {
    cartCount: ''
};

const getters = {
    getCartCount: state => state.cartCount,
};

const actions = {
    async fetchCartCount({commit}) {
        const response = await axios.get(`http://127.0.0.1:8000/api/cart/${checkAuth}/count`);
        commit('setCartCount', response.data);
    } 
    
};

const mutations = {
    setCartCount: (state, count) => (state.cartCount = count)
};


export default {
    state,
    getters,
    actions,
    mutations
};