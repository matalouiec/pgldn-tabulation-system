import Vue from 'vue';
import Vuex from 'vuex';
import judges from './modules/judges';
import categories from './modules/categories';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        judges,
        categories
    }
})