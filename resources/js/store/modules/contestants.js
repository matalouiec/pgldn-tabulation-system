import axios from 'axios';
const state = {
    contestants: []
}
const mutations = {
    SET_CONTESTANTS(state, contestant) {
        state.contestants = contestant;
    }
}
const actions = {
    fetchContestants(context) {
        axios.get('/api/contestants')
            .then(response => {
                context.commit('SET_CONTESTANTS', response.data);
            })
            .catch(error => {
                console.log(error);
            })
    }
}
const getters = {
    contestantList: (state) => {
        return state.contestants;
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}