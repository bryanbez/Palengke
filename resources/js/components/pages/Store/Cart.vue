<template>
    <div>
        <div v-if="!getCartList.length == 0">
            <h3> Your Cart </h3>
            <table class="table table-bordered">
                <tr>
                    <th> Product Image </th>
                    <th> Product Name </th>
                    <th> Quantity </th>
                    <th> Price </th>
                    <th colspan="2"> Options </th>
                </tr>
                <tr v-for="product in getCartList" :key="product.cart_id">
                    <td> <img :src="product.product_info.product_image" style="width: 150px; height: 150px" />  </td>
                    <td> {{ product.product_info.product_name }} </td>
                    <td> {{ product.orderDetails.quantity }}</td>
                    <td> {{ product.orderDetails.total_price }}</td>
                    <td> <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#changeQuantityModal" @click="getProductInfo(product.cart_id)"> Change Quantity </a> </td>
                    <td> <a class="btn btn-danger text-white" @click="removeItem(product.cart_id, product.product_info.product_name)"> Remove </a> </td>
                </tr>
                <tr>
                    <td colspan="3"><h4> Total Price: </h4>  </td>
                    <td> <h4> {{ totalPrice | addPesos }} </h4> </td>
                    <td colspan="2"> <router-link to="/checkout" class="btn btn-primary" style="float: right"> Proceed to Checkout </router-link>  </td>
                </tr>
            </table>
        </div>  
    
      <h3 v-else> Cart is Empty </h3>

      <div class="modal fade" id="changeQuantityModal" tab-index="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content container">
              <div class="modal-header mb-2">
                <h4> Change Quantity </h4>
                <button class="btn btn-danger" @click="closeQuantityModal" data-dismiss="modal" style="float: right;"> x </button>
              </div>
              <div class="modal-content">
                  <div class="card flex-container">
                    <div class="card-img-top">
                      <img :src=getSpecificCartInfo.product_image alt="" style="width: 100%; height: 250px;">
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <p> Price: <b> {{ getSpecificCartInfo.price }} pesos </b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                          <div class="col-lg-6">
                              <label for="quantity">Quantity</label>
                              <input type="number" class="form-control" v-on:keyup="computeTotal(getSpecificCartInfo.price)" v-model.number="getSpecificCartInfo.quantity">
                              <span v-if="emptyQuantityMessage" style="color: red"> {{ emptyQuantityMessage }} </span>
                          </div>
                          <div class="col-lg-6">
                              <label for="total_price">Total Price</label>
                              <input type="text" class="form-control" readonly v-model="getSpecificCartInfo.total_price">
                          </div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" @click="updateQuantity(getSpecificCartInfo.cart_id)"> Update Quantity </button>
              </div>

            </div>
        </div>
    </div>

    </div>
</template>

<script>
import  { mapGetters, mapActions, mapState } from 'vuex';
export default {

    data() {
        return {
 
            txtQuantity: '',
            txtTotalPrice: '',
            updateQuantityMessage: '',
            emptyQuantityMessage: '',
            limitQuantity: 99
        }
    },
    computed: {
        ...mapGetters(['getCartList', 'getSpecificCartInfo', 'getupdateQuantityMessage', 'getDeleteCartMessage']),
       
          totalPrice: function() {
              let listTotalPrice = [];

              $.each(this.getCartList, function(key, value) {
                  listTotalPrice.push(value.orderDetails.total_price)
              });
              return listTotalPrice.reduce((a, b) => a + b, 0)
        }
    },
  
    methods: {
        ...mapActions(['showCartList', 'showSpecificCart', 'updateCartQuantity', 'deleteCart', 'fetchCartCount']),
       
        computeTotal(price) {
            this.getSpecificCartInfo.total_price = parseInt(this.getSpecificCartInfo.quantity) * price;
        },

      getProductInfo(cart_id) {
            this.showSpecificCart([checkAuth, cart_id]);
           
      },
      updateQuantity(cart_id) {
        if (this.getSpecificCartInfo.quantity == 0 || '') {
            this.emptyQuantityMessage = 'Please add quantity'
        }
        else {
          let quantityToUpdate = {
              'cart_id': cart_id,
              'quantity': parseInt(this.getSpecificCartInfo.quantity),
              'total_price': parseInt(this.getSpecificCartInfo.total_price)
          }
            this.updateCartQuantity(quantityToUpdate);
            //this.updateQuantityMessage = this.getupdateQuantityMessage;
            this.closeQuantityModal;
            this.showCartList(checkAuth);
        }

      },
      removeItem(cart_id, product_name) {
          if (confirm('Are you sure to remove this product? '+(product_name))) {
              this.deleteCart(cart_id);
              this.fetchCartCount();
              this.showCartList(checkAuth);
          }
      },
      closeQuantityModal() {
            this.updateQuantityMessage = '';
            this.emptyQuantityMessage = '';
      }

    },
    created() {
        this.showCartList(checkAuth);

    },
    filters: {
        addPesos(value) {
            return value + ' pesos';
        }
    }
}
</script>

<style lang="css" scoped>
</style>
