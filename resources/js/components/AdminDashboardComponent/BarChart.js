import { HorizontalBar,mixins } from 'vue-chartjs';
const { reactiveProp } = mixins

export default {
  extends: HorizontalBar,
  props: ['options'],
  mixins : [reactiveProp],
  mounted () {
    this.renderChart(this.chartData, this.options,{responsive: false, maintainAspectRatio: false})
  }
}