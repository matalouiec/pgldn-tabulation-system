<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div v-for="round in rounds" :key="round.id" class="card">
                    <div class="card-header">Final Rank</div>
                    <div class="card-body">
                       <div class="row">
                           <!-- <category-rank-main :round="round"></category-rank-main> -->
                           <final-rank></final-rank>
                           <judges-gauge :round="round"></judges-gauge>
                       </div><br />
                       <div class="row">
                           <judge-rank v-for="judge in judgesList" :key="judge.id" :judge="judge"></judge-rank>
                            <!-- <category-rank v-for="category in round.categories" :key="category.id" :category="category"></category-rank> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return {
            rounds:[],
            judgesList:[]
        }
    },
    created(){
        this.getRounds();
        this.getActiveJudges();
    },
    methods: {
        getRounds:function(){
            axios.get('/round/getRoundsWithCategories')
                    .then(response => {
                        this.rounds = response.data;
                    })
                    .catch(err => {
                        return err;
                    });
        },
        getActiveJudges:function(){
            axios.get('/judges')
                    .then(response => {
                        this.judgesList = response.data;
                    })
                    .catch(err =>{
                        return err;
                    });
        }
    }
}
</script>
