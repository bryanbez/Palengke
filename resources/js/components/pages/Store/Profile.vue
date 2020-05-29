<template>
	<div>

		<div class="card">
			<div class="card-header">
				<h3> Your Profile </h3>
			</div>
			<div class="card-body">
				<p> <b> Last Name: </b> {{getProfile.customer_last_name}}</p>
				<p> <b> First Name: </b> {{getProfile.customer_first_name}}</p>
				<p> <b> Middle Name: </b> {{getProfile.customer_middle_name}}</p>
				<p> <b> Address: </b> {{getProfile.customer_address}}</p>
				<p> <b> Cellphone Number: </b> {{getProfile.customer_cp_number}}</p>
				<p> <b> Birthday: </b> {{getProfile.customer_birthdate}}</p>

				<div class="row mb-2 mt-2">
				<div class="col-md-4">
					<button class="btn btn-info">Pending Orders</button>	
				</div>
				<div class="col-md-4">
					<button class="btn btn-info">Received Orders</button>	
				</div>
				<div class="col-md-4">
					<button class="btn btn-info">Cancelled Orders</button>	
				</div>
			
				</div>

				<div class="modal fade" id="updateProfileModal" tab-index="-1" role="dialog" aria-hidden="true">
	        		<div class="modal-dialog">
	            		<div class="modal-content container">
	            			<div class="modal-header mb-2">
	            				<h4> Update Profile </h4>
	            			</div>
		              		<div class="modal-content">
		             			<formProfile></formProfile>
		              		</div>
	              		</div>
	              	</div>
	             </div>	
			</div>
			<div class="card-footer">
				<button type="button" data-toggle="modal" data-target="#updateProfileModal" class="btn btn-secondary">Edit Profile </button>
			</div>
		</div>
		
		
	</div>
</template>


<script>
	import { mapGetters, mapActions, mapState } from 'vuex';
	import formProfile from '../../layouts/customer/form-profile.vue';
	export default {
		components: {
			formProfile,
		},
		data() {
			return {

			}
		},
		computed: {
			...mapGetters(['getProfile']),
		},
		methods: {
			...mapActions(['fetchProfile']),
		},
		created() {
			this.fetchProfile();
			console.log(this.getProfile);
		},
		
	}
</script>