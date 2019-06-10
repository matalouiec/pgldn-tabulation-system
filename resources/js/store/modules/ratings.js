import axios from 'axios'

const state = {}
const getters = {}
const mutations = {}
const actions = {
    toggleScoreState(ratingid) {
        axios.post('/rating/change-state', { ratingid: 1326 })
            .then(res => {
                if (res) {
                    return true;
                }
                return false;
            })
            .catch(err => {
                console.log(err);
            });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}