require('./bootstrap');
window.Vue = require('vue');

import Notifications from 'vue-notification';
import velocity from 'velocity-animate';
import VeeValidate from 'vee-validate';

//Admin Dashboard component
Vue.component('dashboard-component', require('./components/AdminDashboardComponent/DashboardComponent.vue'));
Vue.component('category-rank', require('./components/AdminDashboardComponent/CategoryRankComponent.vue'));
Vue.component('category-rank-main', require('./components/AdminDashboardComponent/CategoryRankMainComponent.vue'));
Vue.component('judges-gauge', require('./components/AdminDashboardComponent/JudgesGaugeComponent.vue'));
Vue.component('judge-rank', require('./components/AdminDashboardComponent/JudgeRankComponent.vue'));
Vue.component('final-rank', require('./components/AdminDashboardComponent/FinalRankComponent.vue'));


//Judges category component
Vue.component('category-component', require('./components/JudgesCategoryComponent/JudgesCategoryComponent.vue'));
Vue.component('scoresheet-component', require('./components/JudgesCategoryComponent/ScoresheetComponent.vue'));
Vue.component('contestant-thumbnail', require('./components/JudgesCategoryComponent/ContestantThumbnailComponent.vue'));
Vue.component('contestant-selection', require('./components/ContestantSelectionComponent/ContestantSelectionComponent.vue'));
Vue.component('judge-individual-rank', require('./components/JudgesCategoryComponent/JudgeIndividualRankComponent.vue'));

// Score board component
Vue.component('scoreboard', require('./components/ScoreBoardComponent/ScoreBoardComponent.vue'));
Vue.component('scoreboard-thumbnail', require('./components/ScoreBoardComponent/ScoreBoardThumbnailComponent.vue'));
Vue.component('scoreboard-modal', require('./components/ScoreBoardComponent/ScoreBoardModifyComponent.vue'));

// Rounds component
Vue.component('rounds', require('./components/RoundsComponent/RoundsComponent.vue'));
Vue.component('round', require('./components/RoundsComponent/RoundComponent.vue'));
Vue.component('rounds-modal', require('./components/RoundsComponent/LevelsModalComponent.vue'));

// Scoreboard per category
Vue.component('cocktail-dress', require('./components/ScoreBoardCategory/CocktailDressComponent.vue'));
Vue.component('cocktail-dress-rank', require('./components/ScoreBoardCategory/CocktailDressRankComponent.vue'));
Vue.component('festival-costume', require('./components/ScoreBoardCategory/FestivalCostumeComponent.vue'));
Vue.component('festival-costume-rank', require('./components/ScoreBoardCategory/FestivalCostumeRankComponent.vue'));
Vue.component('swim-wear', require('./components/ScoreBoardCategory/SwimWearComponent.vue'));
Vue.component('swim-wear-rank', require('./components/ScoreBoardCategory/SwimWearRankComponent.vue'));
Vue.component('maranao-inspired', require('./components/ScoreBoardCategory/MaranaoInspiredComponent.vue'));
Vue.component('maranao-inspired-rank', require('./components/ScoreBoardCategory/MaranaoInspiredRankComponent.vue'));
Vue.component('preliminary-interview', require('./components/ScoreBoardCategory/PreliminaryInterviewComponent.vue'));
Vue.component('preliminary-interview-rank', require('./components/ScoreBoardCategory/PreliminaryInterviewRankComponent.vue'));
Vue.component('question-answer', require('./components/ScoreBoardCategory/QuestionAnswerComponent.vue'));
Vue.component('question-answer-rank', require('./components/ScoreBoardCategory/QuestionAnswerRankComponent.vue'));

// Utilities
Vue.component('msgbox', require('./components/util/MsgBoxComponent.vue'));
Vue.use(Notifications, { velocity });
Vue.use(VeeValidate);

//MAIN
const app = new Vue({
    el: '#app'
});
