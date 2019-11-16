import { isEmpty } from 'lodash'
window.axios = require('axios');

export const setHttpToken = (token) => {

	if (isEmpty(token)) {
		window.axios.defaults.headers.common['Authorization'] = null
	}

	window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}