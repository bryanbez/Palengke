import Vuex from 'vuex';
import Vue from 'vue';
import DisplayProducts from './modules/displayproducts';
import CartCount from './modules/addToCartCount';
import AddToCart from './modules/addToCartPage';
import ProductCategories from './modules/productCategories';
import ManageProduct from './modules/admin/manageProducts';
import OrderPage from './modules/orderPage';
import CustomerProfile from './modules/customerProfile';
import Checkout from './modules/checkout';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        DisplayProducts,
        CartCount,
        AddToCart,
        ProductCategories,
        ManageProduct,
        OrderPage,
        CustomerProfile,
        Checkout
    }
});
