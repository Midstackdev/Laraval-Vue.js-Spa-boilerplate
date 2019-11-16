import localforage from 'localforage'
import { isEmpty } from 'lodash'

export const SET_TOKEN = (state, token) => {

	if (isEmpty(token)) {
		localforage.removeItem('authtoken', token)
		return
	}

	localforage.setItem('authtoken', token)
}

export const SET_AUTHENTICATED = (state, isBool) => {
	state.user.authenticated = isBool
}

export const SET_USER_DATA = (state, data) => {
	state.user.data = data
}