<template>
    <div class="col-md-8">
        <div class="panel panel-success">
            <div class="panel-body">
                <bar-chart :chart-data="datacollection" :options="options" :height="145"></bar-chart>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import BarChart from './BarChart';
export default {
   props:['round'],
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
                },
                title:{
                    display:true,
                    text:'Final Ranking'
                }
            }
        }
    },
    methods:{
        getFinalRank:function(){
            axios.get('/round/FinakRank/'+this.round.id)
                    .then(response =>{
                        let labels = response.data.map(function(e){
                            return "#"+e.number+" "+e.con_name;
                        });
                        let bgcolor = response.data.map(function(e){
                            return e.graphcolor;
                        });
                        let data = response.data.map(function(e){
                            return e.score;
                        });

                        this.datacollection = {
                            labels: labels,
                            datasets: [
                                {
                                label: 'Final Ranking',
                                backgroundColor: bgcolor,
                                data: data
                                }
                            ]
                        };

                    }).catch(err => {
                        console.log(err);
                    });
        }
    },
    mounted(){
        setInterval(()=>{
            this.getFinalRank();
        },2000);
    }
}
</script>
