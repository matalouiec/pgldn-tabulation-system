<template>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <doughnut-chart :chart-data="datacollection" :options="options" :height="310"></doughnut-chart>
      </div>
    </div>
  </div>
</template>
<script>
import DoughnutChart from "./DoughnutChart";
import axios from "axios";
import "chart.piecelabel.js";

export default {
  props: ["levelid", "catid"],
  components: {
    "doughnut-chart": DoughnutChart
  },
  data() {
    return {
      datacollection: null,
      options: {
        tooltips: {
          enabled: false
        },
        pieceLabel: {
          render: "percentage",
          fontColor: ["white"],
          fontSize: 20,
          precision: 2
        }
      }
    };
  },
  methods: {
    getStats: function() {
      axios
        .get("/round/PercentageStats/" + this.levelid + "/" + this.catid)
        .then(response => {
          let stats = response.data.stats;
          let total = response.data.total;
          stats = Math.round((stats / total) * 100, 2);
          total = 100 - stats;
          this.datacollection = {
            labels: ["Status", "Overall"],
            datasets: [
              {
                label: "Finalize Scores",
                backgroundColor: ["#90ee90", "#add8e6"],
                data: [stats, total],
                borderColor: "#e3e6e1",
                borderWidth: 1
              }
            ]
          };
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  created() {
    setInterval(() => {
      this.getStats();
    }, 2000);
  }
};
</script>

