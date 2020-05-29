import axios from 'axios';

const state = {
    categories_with_count: [],
    categories: [],
};

const getters = {
    getCategories: state => state.categories_with_count,
    getAllCategories: state => state.categories
};  

const actions = {
    async fetchAllCategories({ commit }) {
        const response = await axios.get('http://localhost:8000/api/categories');
        commit('setAllCategories', response.data);
    },
    async fetchCategories({ commit }) {
        const response = await axios.get('http://localhost:8000/api/categorycount/');
        commit('setCategories', response.data.data);
    },
    async fetchProductInSpeicificCategory({commit}, category_name) {
        const response = await axios.get(`http://127.0.0.1:8000/api/products/sortBy/${category_name}`);
        commit('setProducts', response.data.data, {root: true});
    },
    async fetchSearchProduct({ commit }, searchText) {
        let url = `http://127.0.0.1:8000/api/products/search/${searchText}`;
        const response = await axios.get(url);
        commit('setProducts', response.data.data, {root: true});
    }
    
};

const mutations = {
    setCategories: (state, response) => (state.categories_with_count = response),
    setAllCategories: (state, response) => (state.categories = response)

};

export default {
    state,
    getters,
    actions,
    mutations
};