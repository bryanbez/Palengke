<template>
  <div>
      <!-- <formProductCategories> </formProductCategories> -->
     
      	 <h3> Manage Products </h3>

	    <button type="button" class="btn btn-primary float-right mb-2" name="button" data-toggle="modal" @click="isEditFalse" data-target="#addModifyProductModal">Add Product</button>

	    <div class="modal fade" id="addModifyProductModal" tab-index="-1" role="dialog" aria-hidden="true">
      		<div class="modal-dialog">
	          	<div class="modal-content container">
	            	<div class="modal-header mb-2">
			           <button class="btn btn-danger" @click="clearErrorMsg" data-dismiss="modal" style="float: right;"> x </button>
			     	</div>
			     	<div v-if="is_edit == true">
			     		<p> Update Product</p>
			     		<formModifyProducts></formModifyProducts>
			     	</div>
			     	<div v-else>
			     		
			     		<formAddProducts></formAddProducts>
			     	</div>
	            	
	          	
	        	</div>
	     	</div>
	 	</div>


       <table class="table table-bordered">
        <tr>
          <th> Product Image </th>
          <th> Product Name </th>
          <th> Category </th>
          <th> Product Price </th>
          <th> Stocks Left </th>
          <th colspan="2"> Options </th>
        </tr>
        <tr v-for="product in getProducts">
          <td> <img :src="product.product_image" style="width: 150px; height: 150px" />  </td>
          <td> {{ product.product_name }} </td>
          <td> {{ product.category }}</td>
          <td> {{ product.product_price }}</td>
          <td> {{ product.stocks_left }}</td>
          <td> <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#addModifyProductModal" @click="modifyProduct(product.id)"> Modify </a> </td>
          <td> <a class="btn btn-danger text-white" @click="deleteProduct(product.id)"> Delete </a> </td>
        </tr>
    </table>

    <ul class="pagination">
        <li v-bind:class="[{disabled: !getPagination.prev_page_url}]" class="page-item"><a @click="refreshList(getPagination.prev_page_url)" class="page-link"> Prev </a></li>
        <li class="page-item disabled"><a class="page-link"> {{getPagination.current}} of {{getPagination.last_page}} </a></li>
        <li v-bind:class="[{disabled: !getPagination.next_page_url}]" class="page-item"><a @click="refreshList(getPagination.next_page_url)" class="page-link"> Next </a></li>

    </ul>

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import formAddProducts from '../../layouts/Products/form-add-products.vue'
import formModifyProducts from '../../layouts/Products/form-products-modify.vue'
import formProductCategories from '../../layouts/Products/form-product-categories.vue'
export default {
  	components: {
    	formProductCategories,
    	formAddProducts,
    	formModifyProducts
  	},
  	data() {
  		return {
         	product_id_to_modify_or_delete: '',  
         	is_edit: ''
  		}
  	},
  	computed: {
      	...mapGetters(['getProducts', 'getAllCategories', 'getPagination', 'getInputErrMessage']),
  	},
  	created() {
        this.refreshList();
        this.fetchAllCategories();

    },
  	methods: {
    	...mapActions(['fetchProductsWithPaginate', 'modifyProductInfo', 'fetchAllCategories', 'saveProduct', 'updateProduct']),
    	refreshList(page_url) {
    		this.fetchProductsWithPaginate(page_url);
    		this.fetchAllCategories();
    	},
    	deleteProduct(id) {
          if (confirm('Are ypu sure to delete this product? ')) {
              let uri = `http://localhost:8000/api/products/${id}`;
              axios.delete(uri).then(response => {
                  console.log(response.data);
                  this.refreshList();
              });
          }

        },
        modifyProduct(id) {
            this.modifyProductInfo(id);
            this.insertErrorMsg = [];
            this.is_edit = true;
            
           
        },
        isEditFalse() {
        	this.is_edit = false;
        	

        },
        clearErrorMsg() {
        	this.$store.dispatch('clearInputErrMsg', '');
        }
    },
  

}
</script>

<style lang="css" scoped>
.pagination {
  cursor: pointer;
  float: right;
}

</style>
