import { Doughnut, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins

export default {
  extends: Doughnut,
  props: ['options'],
  mixins: [reactiveProp],
  mounted() {
    this.renderChart(this.data, this.options);
  }
}