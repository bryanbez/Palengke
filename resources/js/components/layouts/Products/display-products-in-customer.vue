<template>
  <div>

    <div class="alert alert-danger mt-2" v-if="allProducts == ''">
        <p> No Products Found </p>
    </div>
    <div class="card flex-container" v-for="product in allProducts">
      <div class="card-img-top">
        <img :src=product.product_image alt="" style="width: 250px; height: 250px;">
      </div>
      <div class="card-header">
        <p> {{ product.product_name }} </p>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-lg-6">
              <b> {{ product.product_price }} pesos </b>
          </div>
          <div class="col-lg-6">
              <button v-show="product.stocks_left" type="button" data-toggle="modal" data-target="#addToCart" @click="getProductInfo(product.id)" class="btn btn-primary" style="float: right">View More</button>
              <button v-show="!product.stocks_left" type="button" class="btn btn-secondary" disabled style="float: right">Out of Stock</button>
          </div>
        </div>

        <!-- Modal to Show Product Info (click add to cart) -->
        <div class="modal fade" id="addToCart" tab-index="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content container">
                <div class="modal-header mb-2">
                    <h3> {{ singleProduct.product_name }} </h3>
                    <button class="btn" @click="clearCartMessage" data-dismiss="modal" style="float: right;"> x </button>
                </div>
                <div class="modal-content">

                    <div class="card flex-container">
                      <div class="card-img-top">
                        <img :src=singleProduct.product_image alt="" style="width: 100%; height: 250px;">
                      </div>
                      <div class="card-header">
                          <div class="row">
                              <div class="col-lg-6">
                                  <p> Price: <b> {{ singleProduct.product_price }} pesos </b> </p>
                              </div>
                              <div class="col-lg-6">
                                  <p> Stocks Left: {{ singleProduct.stocks_left}} </p>
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" name="quantity" v-on:keyup="computeTotal(singleProduct.product_price)" v-model="txtQuantity">
                            </div>
                            <div class="col-lg-6">
                                <label for="total_price">Total Price</label>
                                <input type="text" class="form-control" readonly name="total_price" v-model="txtTotalPrice">
                            </div>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                      <p class="alert alert-success" v-show="messageInAddToCart"> {{ messageInAddToCart }} </p>
                      <button type="button" v-show="!messageInAddToCart" class="btn btn-primary" @click="addToCart(singleProduct.id, singleProduct.product_price)"> Add to Cart </button>
                </div>

                </div>
              </div>
          </div>
        </div>


      </div>
    </div>

  </div>
</template>

<script>
import  { mapGetters, mapActions } from 'vuex';
export default {

  data() {
    return {
        products: [],
        txtQuantity: '',
        txtTotalPrice: '',
        addToCartInfo: {
            'customer_name': checkAuth,
            'product_id': '',
            'price': '',
            'quantity': '',
            'total_price': ''
        },
        addToCartMessage: ''
    }
  },

  computed: mapGetters(['allProducts', 'singleProduct', 'messageInAddToCart']),
  methods: {
      ...mapActions(['fetchAllProducts', 'fetchSingleProducts', 'addToCustomerCart', 'fetchCartCount']),
      computeTotal(price) {
          this.txtTotalPrice = parseInt(this.txtQuantity) * price;
      },
      getProductInfo(id) {
        this.fetchSingleProducts(id);
      },
      addToCart(id, price) {
        this.addToCartInfo.product_id = id;
        this.addToCartInfo.price = price;
        this.addToCartInfo.quantity = parseInt(this.txtQuantity);
        this.addToCartInfo.total_price = parseFloat(this.txtTotalPrice);

        this.addToCustomerCart(this.addToCartInfo);
        this.fetchAllProducts();
        this.fetchCartCount();
      },
      clearCartMessage() {
          this.addToCartMessage = '';
          this.txtQuantity = '';
          this.txtTotalPrice = '';
      }
  },
  created() {
      this.fetchAllProducts();

  }

}
</script>

<style lang="css" scoped>
.card {
  display: inline-block;
  margin-left: 1em;
  margin-bottom: 1em;
}
</style>
