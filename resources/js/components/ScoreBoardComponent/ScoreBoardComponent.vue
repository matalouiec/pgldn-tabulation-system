<template>
    <div>
        <div class="row" v-for="category in categories" :key="category.id">
             <judge-individual-rank></judge-individual-rank>
            <div class="col-md-12" >
                <div class="card" v-if="category.ratings.length > 0">
                    <div class="card-header clearfix">
                        <div class="card-title">
                            {{ category.name }}
                            <button v-bind:disabled="errors.items.length>0" class="btn btn-danger float-sm-right" data-toggle="modal" :data-target="'#msgBox'+category.id">MARK ALL AS FINAL</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding-left:5px;padding-right:5px;">
                            <scoreboard-thumbnail v-for="rating in category.ratings"
                                :key="rating.id" v-bind:data="rating"
                                :rating="rating"></scoreboard-thumbnail>
                        </div>
                    </div>
                    <!-- <footer class="panel-footer text-right">
                        <button class="btn btn-primary" data-toggle="modal" :data-target="'#msgBox'+category.id">Finalize Scores</button>
                    </footer> -->
                </div>
            </div>
            <msgbox @clicked="onClickChild" :params="params" :data="category"></msgbox>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                categories:[],
                params : { // this is for the modal window
                    message : "This will finalize all your scores on this category. Would you like to continue?",
                    title : 'Confirm',
                    type: 'confirm'
                }
            }
        },
        methods:{
             onClickChild (value) {
                if(value.yes){
                    this.finalizeRatings(value.data); // this will finalize all the scores in a specfic category
                }
            },
            finalizeRatings:function(id){
                axios.post('/scoreboard/finalizeratings',{ id: id })
                    .then(response => {
                        if(response.status == 200)
                        {
                            this.$notify({
                                group: 'app-notification',
                                type: 'success',
                                title: 'Success!!!',
                                text: 'Your scores are finalized.',
                            });
                        }
                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            fetchCategory:function(){
                axios.get('/scoreboard/getCategories')
                .then(response => {
                    this.categories = response.data.categories;
                })
                .catch(e => {
                   console.log(e);
                });
            }
        },
        created(){
            this.fetchCategory();
            setInterval(()=>{
                this.fetchCategory();
            },2000);
        }
    }
</script>
<style scoped>
    ul{
         list-style-type: none;
         float: left;
    }

    .panel-heading{
            font-weight:bold;
            font-size: 20px;
    }
</style>