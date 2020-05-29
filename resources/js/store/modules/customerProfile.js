import axios from 'axios';

const state = {
   profile: {
   		customer_last_name: '',
		customer_first_name: '',
		customer_middle_name: '',
		customer_address: '',
		customer_cp_number: '',
		customer_birthdate: ''
   },
   profileSaveUpdateFeedback: [],
   inputError: [],
};

const getters = {
   getProfile: state => state.profile,
   getInputErrorMessageOnProfile: state => state.inputError,
   getFeedbackOnProfile: state => state.profileSaveUpdateFeedback,

};

const mutations = {
    SET_FEEDBACK: (state, response) => (state.profileSaveUpdateFeedback = response),
    SET_INPUT_ERROR_MSG: (state, error) => (state.inputError = error),
    SET_FETCH_PROFILE: (state, response) => {
    	
    	if (response.length == 0) {
    		state.profile.customer_username = '',
    		state.profile.customer_last_name = '',
	    	state.profile.customer_first_name = '',
	    	state.profile.customer_middle_name = '',
	    	state.profile.customer_address = '',
	    	state.profile.customer_cp_number = '',
	    	state.profile.customer_birthdate = ''
    	}
    	else {
    		state.profile.customer_last_name = response[0].customer_last_name,
	    	state.profile.customer_first_name = response[0].customer_first_name,
	    	state.profile.customer_middle_name = response[0].customer_middle_name,
	    	state.profile.customer_address = response[0].customer_address,
	    	state.profile.customer_cp_number = response[0].customer_cp_number,
	    	state.profile.customer_birthdate = response[0].customer_birthdate
    	}
    	
    }
};


const actions = {
  async saveProfile({ commit }, profileInfo) {
  	await axios.post('http://localhost:8000/api/profile', profileInfo).then(response => {
  		commit('SET_FEEDBACK', response.data);
  		commit('SET_INPUT_ERROR_MSG', '');
  	}).catch(error => {
  		commit('SET_FEEDBACK', '');
  		commit('SET_INPUT_ERROR_MSG', error.response.data.errors);
  	});
  },
  async fetchProfile({ commit }) {
  	const response = await axios.get(`http://localhost:8000/api/profile/${checkAuth}`);
  	commit('SET_FETCH_PROFILE', response.data);
  },
  async updateProfile({ commit }, profileInfo) {
  	await axios.put(`http://localhost:8000/api/profile/${checkAuth}`, profileInfo).then(response => {
  		commit('SET_FEEDBACK', response.data);
  		commit('SET_INPUT_ERROR_MSG', '');
  	}).catch(error => {
  		commit('SET_FEEDBACK', '');
  		commit('SET_INPUT_ERROR_MSG', error.response.data.errors);
  	});
  },


    
};


export default {
    state,
    getters,
    actions,
    mutations
};