<template>
	<div>

		<h3> Checkout Page </h3>

		<p> Please check your information before placing an order. Thanks</p>
		<form @submit.prevent="orderCreate" method="post">

			<label> Your Name </label>
            <input type="text" v-model="order.customer_name" readonly class="form-control mb-2">

            <label> Address </label>
            <textarea class="form-control mb-2" readonly v-model="order.customer_address" rows="7" cols="7"></textarea> 

            <label> Subtotal </label>
            <input type="text" v-model="order.subtotal" readonly class="form-control mb-2">

            <label> Shipping Fee </label>
            <input type="text" v-model="order.shipping_fee" readonly class="form-control mb-2">

            <label> Coupon Code (if any) </label>
            <input type="text" v-model="order.coupon_code" class="form-control mb-2">

            <label> Total Price </label>
            <input type="text" v-model="order.total_price" readonly class="form-control mb-2">

            <button type="submit" class="btn btn-primary form-control mt-2 mb-2"> Place Order </button>

            <router-link to="/cart" class="btn btn-danger form-control"> Back </router-link>

		</form>
		
	</div>
</template>


<script>
	import { mapGetters, mapActions } from 'vuex';
	export default {
		components: {

		},
		data() {
			return {
				order: {
					customer_name: '',
					customer_address: '',
					subtotal: '',
					shipping_fee: '',
					coupon_code: '',
					total_price: ''
				},

			}
		},
		created() {

		},
		computed: {

		},
		methods: {

		},
	}
</script>

