<template>
	<div>
							
		<div class="container mt-2">

			  <div v-show="!getInputErrorMessageOnProfile" class="alert alert-primary"> {{ getFeedbackOnProfile }} </div>

			<form method="post" @submit.prevent="saveOrUpdateProfile">
				<label> First Name <i>(required)</i> </label>
				<input type="text" v-model="profileInfo.customer_first_name" class="form-control">
				 <p v-if="getInputErrorMessageOnProfile.customer_first_name" class="error"> {{ getInputErrorMessageOnProfile.customer_first_name | trimCharacters }}</p>

				<label> Middle Name </label>
				<input type="text" v-model="profileInfo.customer_middle_name" class="form-control">

				<label> Last Name <i>(required)</i> </label>
				<input type="text" v-model="profileInfo.customer_last_name" class="form-control">
				 <p v-if="getInputErrorMessageOnProfile.customer_last_name" class="error"> {{ getInputErrorMessageOnProfile.customer_first_name | trimCharacters }}</p>


				<label> Address <i>(required)</i> </label>
				<textarea col="7" rows="7" class="form-control mb-2" v-model="profileInfo.customer_address"></textarea>
				<span v-if="getInputErrorMessageOnProfile.customer_address" class="error"> {{ getInputErrorMessageOnProfile.customer_address | trimCharacters }}</span><br />
				

				<label> Cellphone No. <i>(required)</i> </label>
				<input type="text" v-model="profileInfo.customer_cp_number" class="form-control">
				 <p v-if="getInputErrorMessageOnProfile.customer_cp_number" class="error"> {{ getInputErrorMessageOnProfile.customer_cp_number | trimCharacters }}</p>


				<label> Birthday <i>(required)</i> </label>
				<input type="date" v-model="profileInfo.customer_birthdate" class="form-control">
				 <p v-if="getInputErrorMessageOnProfile.customer_birthdate" class="error"> {{ getInputErrorMessageOnProfile.customer_birthdate | trimCharacters }}</p>

				 <button class="btn btn-primary mb-2" type="submit"> Update </button>
				 </form>	
				
		</div>
		
	</div>
</template>


<script>
	import { mapGetters, mapActions } from 'vuex';
	export default {
		components: {


		},
		data() {
			return {
			
				profileInfo: {
					customer_username: checkAuth,
					customer_last_name: '',
					customer_first_name: '',
					customer_middle_name: '',
					customer_address: '',
					customer_cp_number: '',
					customer_birthdate: ''
				},
			}
		},
		created() {
			this.fetchProfile();
			this.profileInfo = this.getProfile;

		},
		computed: {
			...mapGetters(['getInputErrorMessageOnProfile', 'getFeedbackOnProfile', 'getProfile']),
			
		},
		methods: {
			...mapActions(['saveProfile', 'fetchProfile', 'updateProfile']),
			saveOrUpdateProfile() {
				if (this.getProfile.customer_username == '') {
					this.$store.dispatch('saveProfile', this.profileInfo);
				}
				else {
					this.$store.dispatch('updateProfile', this.profileInfo);
				}
				
							
			},

			
		},
		filters: {
	      	trimCharacters: function(value) {
	          	return value.toString();
	    	},
	    }
	}
</script>

<style scoped>
input, textarea, select {
  margin-bottom: 2em;
}
.error {
  color: red;
  font-weight: bold;
  margin-top: -2em;
}
</style>