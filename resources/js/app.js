/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const CryptoJS = require('crypto-js');
const passphrase = process.env.MIX_PASSPHARE

import App from './App.vue';
import VueRouter from 'vue-router'
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './router/router';
import Vue from 'vue';

window.Vue = require('vue');

Vue.router = router;
Vue.use(VueRouter)

//axios.defaults.baseURL = `${process.env.APP_URL}/`;
Vue.use(VueAxios, axios);

// This prototype allows to be called using params or name from any component
Vue.prototype.$goRouter = function (name, params, path) {
	if (path) {
		this.$router.push({ path: path, params: params }).catch(err => { err = null })
	} else {
		this.$router.push({ name: name, params: params }).catch(err => { err = null })
	}
}

Vue.prototype.$encryptWithAES = function (textToEncrypt) {
    return CryptoJS.MD5(CryptoJS.DES.encrypt(textToEncrypt, passphrase).toString()).toString()
}

Vue.prototype.$decryptWithAES = function (textToDecrypt) {
    const bytes = CryptoJS.DES.decrypt(textToDecrypt, passphrase)
    const originalText = bytes.toString(CryptoJS.enc.Utf8)
    return originalText;
}


// Allows to generate an URL for the project
Vue.prototype.$getLinkProject = function (projectText) {
    let auxURL = process.env.MIX_APP_URL + '/view/' + projectText
    return auxURL
}
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
	App,
	router,
	render: app => app(App)
});
