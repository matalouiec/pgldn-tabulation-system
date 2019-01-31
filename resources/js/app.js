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

//Preliminary Round
Vue.component('preliminary-round', require('./components/CategoryComponent/PreliminaryComponent.vue'));

// Utilities
Vue.component('msgbox', require('./components/util/MsgBoxComponent.vue'));
Vue.use(Notifications, { velocity });
Vue.use(VeeValidate);

//MAIN
const app = new Vue({
    el: '#app'
});
