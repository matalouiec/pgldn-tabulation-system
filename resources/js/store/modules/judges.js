import axios from 'axios';

const state = {
    judges: [],
    selectedJudge: [],
    categories: []
}

const mutations = {
    SET_JUDGES(state, judges) {
        state.judges = judges;
    },
    SET_CATEGORIES(state, categories) {
        state.categories = categories;
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
    fetchCategories(context, payload) {
        axios.get()
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