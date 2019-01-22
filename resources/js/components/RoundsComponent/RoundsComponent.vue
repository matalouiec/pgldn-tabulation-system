<template>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rounds</div>
                <div class="panel-body">
                  <table class="table table-primary table-bordered table-striped">
                      <thead>
                          <tr>
                            <th style="width:50%;">Round Name</th>
                            <th>Top</th>
                            <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <round v-for="round in rounds" :key="round.id" :round="round"></round>
                      </tbody>
                  </table>
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
            rounds:[]
        }
    },
    methods:{
        getRounds:function(){
            axios.get('/round/getRounds')
                 .then(response => {
                     this.rounds = response.data;
                 })
                 .catch(err => {

                 });
        }
    },
    created(){
        this.getRounds();
    }
}
</script>
