import Vue from 'vue';
import Vuex from 'vuex';
import judges from './modules/judges';
import categories from './modules/categories';
import contestants from './modules/contestants';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        judges,
        categories,
        contestants
    }
})