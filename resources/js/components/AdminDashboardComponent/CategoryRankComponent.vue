<template>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading clearfix">
               <div class="panel-title">
                   {{ category.name }}
                   <span class="badge">{{ category.percentage }}%</span>
                   <button class="btn btn-default pull-right">
                       <span class="glyphicon glyphicon-th-list"></span>
                   </button>
               </div>
            </div>
            <div class="panel-body">
                <bar-chart :chart-data="datacollection" :options="options" :height="250"></bar-chart>
            </div>
        </div>
    </div>
</template>
<script>
import BarChart from './BarChart';
import Axios from 'axios';
export default {
    props: ['category'],
    components : {
        'bar-chart': BarChart
    },
    data(){
        return {
            datacollection:null,
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                legend:{
                    display: false
                }
            }
        }
    },
    methods:{
        changeData:function(){
            let chartLabels = null;
            let chartData = null;
            let graphColor = null;

           Axios.get('/round/CategoryRank/'+this.category.id)
                    .then(response => {
                        chartLabels = response.data.map(function(e){
                            return '#'+e.number+' '+e.name;
                        });
                        chartData = response.data.map(function(e){
                            return e.score;
                        });
                        graphColor = response.data.map(function(e){
                            return e.graphcolor;
                        });

                        this.datacollection = {
                            labels: chartLabels,
                            datasets: [{
                                label: this.category.name,
                                data: chartData,
                                backgroundColor: graphColor,
                                borderWidth: 1
                            }]
                        }
                    }).catch(err => {
                        console.log(err);
                    });
        }
    },
    mounted(){
        setInterval(()=>{
            this.changeData();
        },2000);
    }
}
</script>
