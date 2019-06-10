import axios from 'axios';

const state = {
    judges: [],
    selectedJudge: []
}

const mutations = {
    SET_JUDGES(state, judges) {
        state.judges = judges;
    },
    SET_SELECTED_JUDGE(state, judge) {
        state.selectedJudge = judge;
    }
}

const actions = {
    fetchJudges(context) {
        axios.get('/judges').then(response => {
            context.commit('SET_JUDGES', response.data)
        })
    },
    setSelectedJudge(context, payload) {
        context.commit('SET_SELECTED_JUDGE', payload)
    },
}

const getters = {
    judgesList: (state) => {
        return state.judges;
    },
    selectedJudgeInfo: (state) => {
        return state.selectedJudge;
    }

}

export default {
    state,
    mutations,
    actions,
    getters
}