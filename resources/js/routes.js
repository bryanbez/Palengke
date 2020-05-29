import MainPage from './components/MainPage.vue';
import Products from './components/pages/Store/Products.vue';
import ManageProducts from './components/pages/Admin/Products.vue';
import YourCart from './components/pages/Store/Cart.vue';
import CheckOut from './components/pages/Store/CheckoutPage.vue';
import Orders from './components/pages/Store/Order.vue';
import Profile from './components/pages/Store/Profile.vue';
import NotFound from './components/pages/404NotFound.vue';

export default [

    { path: '', component: MainPage },
    { path: '/products', component: Products },
    { path: '/manageproducts', component: ManageProducts },
    { path: '/cart', component: YourCart },
    { path: '/checkout', component: CheckOut },
    { path: '/order', component: Orders },
    { path: '/profile', component: Profile },
    { path: '*', component: NotFound }
]
