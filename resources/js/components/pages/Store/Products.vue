<template>
    <div>
        <div class="container">

          <div class="row">
              <div class="col-lg-8">
                  <h3> Products</h3>
              </div>

          </div>
            <div class="row">
                <div class="col-lg-9">
                    <button class="btn btn-secondary text-white" @click="resetByAll()"> All </button>
                    <div style="display: inline-block; margin-left: 1em;" v-for="category in getCategories">
                        <button class="btn btn-secondary text-white" @click="filterProductsByCategory(category.category_name)"> {{ category.category_name }}({{category.count}}) </button> 
                    </div>
                  
                </div>
              <div class="col-lg-3">
                  <input type="text" v-model="searchText" v-on:keyup="searchProduct()" placeholder="Search Product" class="form-control">
              </div>
          </div>
          <br />
          <div class="row">
              <displayProducts></displayProducts>
          </div>
        </div>

    </div>
</template>

<script>
import displayProducts from '../../layouts/Products/display-products-in-customer.vue';
import { mapGetters, mapActions, mapState } from 'vuex';
export default {
    components: {
        displayProducts,
    },
    data() {
      return {
        searchText: '',   
      }
    },
    computed: { 
        ...mapGetters(['getCategories', 'allProducts']),
    },
    created() {
       this.fetchCategories();

    },
  
    methods: {
        ...mapActions(['fetchCategories', 'fetchSearchProduct', 'fetchAllProducts', 'fetchProductInSpeicificCategory']),
        filterProductsByCategory(category_name) {
            this.fetchProductInSpeicificCategory(category_name);
        },
        resetByAll() {
            this.fetchAllProducts();
        },
        searchProduct() {
            if (this.searchText == '') {
                this.fetchAllProducts()
            }
            else {
              this.fetchSearchProduct(this.searchText);
            }
        }
    }
}
</script>
<style scoped>

</style>
