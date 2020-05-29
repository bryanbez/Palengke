<template>
	<div>

	<div v-if="!getInputErrMessage" class="alert alert-primary"> {{ getAddModifyProductMessage }} </div>

    <form @submit.prevent="updateProductMethod" method="post" enctype="multipart/form-data">

    <label for="product_name">Product Name</label>
      <input type="text" v-model="productInfoToModify.product_name" class="form-control" placeholder="name of product">
      <p v-if="getInputErrMessage.product_name" class="error"> {{ getInputErrMessage.product_name | trimCharacters }}</p>

    <label for="product_image">Product Image</label><br />
      <input type="file" v-on:change="uploadImage"><br />

    <label for="category">Category</label>
      <select class="form-control" v-model="productInfoToModify.category">
        <option value="" disabled>Select Category</option>
        <option v-for="category in getAllCategories" :key="category.id">{{ category.category_name }}</option>
                </select>
       <p v-if="getInputErrMessage.category" class="error"> {{ getInputErrMessage.category | trimCharacters }}</p>

    <label for="product_price">Product Price</label>
        <input type="text" v-model="productInfoToModify.product_price" class="form-control" placeholder="product price">
                <p v-if="getInputErrMessage.product_price" class="error"> {{ getInputErrMessage.product_price | trimCharacters }}</p>
    <label for="stocks_left">Stocks Left</label>
        <input type="text" v-model="productInfoToModify.stocks_left" class="form-control" placeholder="stocks left">
        <p v-if="getInputErrMessage.stocks_left" class="error"> {{ getInputErrMessage.stocks_left | trimCharacters }}</p>

    <label for="product_desc">Product Description</label>
        <textarea v-model="productInfoToModify.product_desc" rows="8" cols="80" class="form-control"></textarea>
        <p v-if="getInputErrMessage.product_desc" class="error"> {{ getInputErrMessage.product_desc | trimCharacters }}</p>

        <input type="submit" name="submit" value="Update Product" class="form-control btn btn-primary">

    </form>
		
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
export default {
	data() {
		return {
			updateFeedback: '',
			product_id_to_modify: '',
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
		}
	},
	computed: {
		...mapGetters(['getProductInfoToModify', 'getAllCategories', 'getAddModifyProductMessage', 'getInputErrMessage']),
	},
	methods: {
		...mapActions(['updateProduct', 'modifyProductInfo', 'fetchProductsWithPaginate']),
		
		uploadImage(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.productInfoToModify.product_image = event.target.result;
            }
      	},
      	updateProductMethod() {
      		this.$store.dispatch('updateProduct', this.productInfoToModify);
      		this.fetchProductsWithPaginate();
		},
	},
	created() {
		this.productInfoToModify = this.getProductInfoToModify;
		

	},
	filters: {
      trimCharacters: function(value) {
          return value.toString();
      },
    }
	
}
</script>

<style lang="css" scoped>

input, textarea, select {
  margin-bottom: 2em;
}
.error {
  color: red;
  font-weight: bold;
  margin-top: -2em;
}

</style>