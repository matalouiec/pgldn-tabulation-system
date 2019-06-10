import axios from 'axios';

const state = {
    categories: []
}

const getters = {
    filteredCategories: (state) => {
        return state.categories;
    }
}

const mutations = {
    SET_CATEGORIES(state, categories) {
        state.categories = categories;
    }
}

const actions = {
    fetchCategories(context, payload) {
        axios.get('/data-controller/category/' + payload)
            .then(response => {
                context.commit('SET_CATEGORIES', response.data.categories)
            })
            .catch(error => {
                console.log(error);
            })
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}