import axios from 'axios';

const state = {
    products: [],
    pagination: {},
    addModifyProductMessage: [],
    productInfoToModify: {
        product_id: '',
        product_name: '',
        product_image: '',
        product_price: '',
        stocks_left: '',
        category: '',
        product_desc: '',
        store_of: 'admin',
    },
    inputErrMessage: []
};

const getters = {
    getProducts: state => state.products,
    getPagination: state => state.pagination,
    getAddModifyProductMessage: state => state.addModifyProductMessage,
    getProductInfoToModify: state => state.productInfoToModify,
    getInputErrMessage: state => state.inputErrMessage,
};

const mutations = { 
    SET_PRODUCT_AND_PAGINATE: (state, response) => {
        state.products = response.data;
        let paginationInfo = {
            next_page_url: response.links.next,
            prev_page_url: response.links.prev,
            first_page_url: response.links.first,
            last_page_url: response.links.last,
            current: response.meta.current_page,
            last_page: response.meta.last_page,
        }
        state.pagination = paginationInfo;
    },
    SET_ADD_MODIFY_PRODUCT_MESSAGE: (state, response) => (state.addModifyProductMessage = response),
    SET_PRODUCT_TO_MODIFY: (state, response) =>  
    {
        state.productInfoToModify.product_id = response[0].product_id,
        state.productInfoToModify.product_name = response[0].product_name,
        //state.productInfoToModify.product_image = response[0].product_image,
        state.productInfoToModify.product_price = response[0].product_price,
        state.productInfoToModify.stocks_left = response[0].stocks_left,
        state.productInfoToModify.category = response[0].category,
        state.productInfoToModify.store_of = response[0].store_of,
        state.productInfoToModify.product_desc = response[0].product_desc
    },
    SET_INPUT_ERROR_MSG: (state, err) => (state.inputErrMessage = err),
};

const actions = {
    async fetchProductsWithPaginate({ commit }, page_url) {
        if (page_url == null) {
            const response = await axios.get('http://localhost:8000/api/products');
            commit('SET_PRODUCT_AND_PAGINATE', response.data);
        } else {
            const response = await axios.get(page_url);
            commit('SET_PRODUCT_AND_PAGINATE', response.data);
        }    
    },
    async modifyProductInfo({ commit }, product_id) {
        const response = await axios.get(`http://localhost:8000/api/products/${product_id}`);
        
        commit('SET_PRODUCT_TO_MODIFY', response.data);
    },
    async saveProduct({commit }, product_info) {
        await axios.post('http://localhost:8000/api/products', product_info)
        .then(response => {
            commit('SET_ADD_MODIFY_PRODUCT_MESSAGE', response.data);
        }).catch(error => {
            commit('SET_INPUT_ERROR_MSG', error.response.data.errors);  
        });
        
    },
    async updateProduct({ commit }, product_info) {
        await axios.put(`http://localhost:8000/api/products/${product_info.product_id}`, product_info)
        .then(response => {
            commit('SET_INPUT_ERROR_MSG', '');
            commit('SET_ADD_MODIFY_PRODUCT_MESSAGE', response.data);
        }).catch(function (error) {
            commit('SET_ADD_MODIFY_PRODUCT_MESSAGE', '');
            commit('SET_INPUT_ERROR_MSG', error.response.data.errors);  
        }); 
    },
    async clearInputErrMsg({commit}, data) {
        commit('SET_INPUT_ERROR_MSG', '');
    }
};


export default {
    state,
    getters,
    actions,
    mutations
}