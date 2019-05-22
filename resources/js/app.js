require('./bootstrap');
window.Vue = require('vue');

import Notifications from 'vue-notification';
import velocity from 'velocity-animate';
import VeeValidate from 'vee-validate';

//Admin Dashboard component
Vue.component('dashboard-component', require('./components/AdminDashboardComponent/DashboardComponent.vue').default);
Vue.component('category-rank', require('./components/AdminDashboardComponent/CategoryRankComponent.vue').default);
Vue.component('category-rank-main', require('./components/AdminDashboardComponent/CategoryRankMainComponent.vue').default);
Vue.component('judges-gauge', require('./components/AdminDashboardComponent/JudgesGaugeComponent.vue').default);
Vue.component('judge-rank', require('./components/AdminDashboardComponent/JudgeRankComponent.vue').default);
Vue.component('final-rank', require('./components/AdminDashboardComponent/FinalRankComponent.vue').default);


//Judges category component
Vue.component('category-component', require('./components/JudgesCategoryComponent/JudgesCategoryComponent.vue').default);
Vue.component('scoresheet-component', require('./components/JudgesCategoryComponent/ScoresheetComponent.vue').default);
Vue.component('contestant-thumbnail', require('./components/JudgesCategoryComponent/ContestantThumbnailComponent.vue').default);
Vue.component('contestant-selection', require('./components/ContestantSelectionComponent/ContestantSelectionComponent.vue').default);
Vue.component('judge-individual-rank', require('./components/JudgesCategoryComponent/JudgeIndividualRankComponent.vue').default);

// Score board component
Vue.component('scoreboard', require('./components/ScoreBoardComponent/ScoreBoardComponent.vue').default);
Vue.component('scoreboard-thumbnail', require('./components/ScoreBoardComponent/ScoreBoardThumbnailComponent.vue').default);
Vue.component('scoreboard-modal', require('./components/ScoreBoardComponent/ScoreBoardModifyComponent.vue').default);

// Rounds component
Vue.component('rounds', require('./components/RoundsComponent/RoundsComponent.vue').default);
Vue.component('round', require('./components/RoundsComponent/RoundComponent.vue').default);
Vue.component('rounds-modal', require('./components/RoundsComponent/LevelsModalComponent.vue').default);

// Scoreboard per category
Vue.component('cocktail-dress', require('./components/ScoreBoardCategory/CocktailDressComponent.vue').default);
Vue.component('cocktail-dress-rank', require('./components/ScoreBoardCategory/CocktailDressRankComponent.vue').default);
Vue.component('festival-costume', require('./components/ScoreBoardCategory/FestivalCostumeComponent.vue').default);
Vue.component('festival-costume-rank', require('./components/ScoreBoardCategory/FestivalCostumeRankComponent.vue').default);
Vue.component('swim-wear', require('./components/ScoreBoardCategory/SwimWearComponent.vue').default);
Vue.component('swim-wear-rank', require('./components/ScoreBoardCategory/SwimWearRankComponent.vue').default);
Vue.component('maranao-inspired', require('./components/ScoreBoardCategory/MaranaoInspiredComponent.vue').default);
Vue.component('maranao-inspired-rank', require('./components/ScoreBoardCategory/MaranaoInspiredRankComponent.vue').default);
Vue.component('preliminary-interview', require('./components/ScoreBoardCategory/PreliminaryInterviewComponent.vue').default);
Vue.component('preliminary-interview-rank', require('./components/ScoreBoardCategory/PreliminaryInterviewRankComponent.vue').default);
Vue.component('question-answer', require('./components/ScoreBoardCategory/QuestionAnswerComponent.vue').default);
Vue.component('question-answer-rank', require('./components/ScoreBoardCategory/QuestionAnswerRankComponent.vue').default);

//Preliminary Rounds
Vue.component('preliminary-round', require('./components/PreliminaryComponent/PreliminaryRoundComponent.vue').default);

// Utilities
Vue.component('msgbox', require('./components/util/MsgBoxComponent.vue').default);
Vue.use(Notifications, { velocity });
Vue.use(VeeValidate);

//MAIN
const app = new Vue({
    el: '#app'
});
