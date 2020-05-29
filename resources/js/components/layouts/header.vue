<template>
    <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->

                <ul class="navbar-nav ml-auto" v-if="getCheckAuth != 'admin'">
                    <li class="nav-item">
                      <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/products" class="nav-link">Products</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/cart" class="nav-link">Your Cart <b> ({{ getCartCount.cart_count }}) </b></router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/profile" class="nav-link">Profile</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-if="getCheckAuth == 'admin'">
                    <li class="nav-item">
                      <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/manageproducts" class="nav-link">Products</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  </div>
</template>

<script>
import  { mapGetters, mapActions } from 'vuex';
export default {

    data() {
      return {
          getCheckAuth: checkAuth,
      }
    },
    computed: {
      ...mapGetters(['getCartCount']),
      
    },
    methods: {
       ...mapActions(['fetchCartCount']),
      
    },
    created() {
       this.fetchCartCount()
    },

}
</script>

<style scoped>
    .nav-link {
      color: white;
    }
    .navbar-brand a {
      color: white;
      font-weight: bold;
    }
</style>
