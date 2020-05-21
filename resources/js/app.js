require('./bootstrap');
window.Vue = require('vue');
import Vuex from 'vuex';
Vue.use(Vuex);

// Vue.component('ChatForm', require('./components/ChatForm.vue').default);
// Vue.component('ChatMessage', require('./components/ChatMessage.vue').default);
// Vue.component('ChatUsers', require('./components/ChatUsers.vue').default);
Vue.component('redeem', require('./components/Redeem.vue').default);

export const store = new Vuex.Store({
    state: {
        wonedProducts: []
    },
    actions: {
        clearData({ commit }){
            commit('setWonedProducts', null);
        }
    },
    mutations: {
        setWonedProducts(state, products){
            state.wonedProducts = products;
        },
        pushWonedProduct(state, product){
            state.wonedProducts.unshift(product);
        },
        removeWonedProduct(state, product){
            state.wonedProducts.pop();
        }
    }
});

const app = new Vue({
    store,
}).$mount('#app');

// const app = new Vue({
//     el: '#app'
// });
