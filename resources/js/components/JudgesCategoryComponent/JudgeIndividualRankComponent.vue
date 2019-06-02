<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" rowspan="2">Rank</th>
              <th class="text-center" rowspan="2">Contestant</th>
              <th
                class="text-center"
                colspan="4"
                style="background:rgba(64, 160, 255,0.5);"
              >PERFORMANCE</th>
              <th class="text-center" rowspan="2">TOTAL (100%)</th>
            </tr>
            <tr>
              <th class="text-center">Voice Quality (40%)</th>
              <th class="text-center">Choreography (30%)</th>
              <th class="text-center">Costume/Props (20%)</th>
              <th class="text-center">Overall Impact (10%)</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="rank in rankList" v-bind:key="rank.id">
              <th scope="row" class="text-center">{{ rank.seqno }}</th>
              <td>{{ rank.Contestants }}</td>
              <td class="text-center">{{ rank.Voice_Quality }}</td>
              <td class="text-center">{{ rank.Choreography }}</td>
              <td class="text-center">{{ rank.Costume_Props }}</td>
              <td class="text-center">{{ rank.Overall_Impact }}</td>
              <td class="text-center">{{ parseFloat(rank.TOTAL).toFixed(2) }}%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <br>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      rankList: []
    };
  },
  methods: {
    getRank() {
      axios
        .get("/scoreboard/rank")
        .then(response => {
          this.rankList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    this.getRank();
    setInterval(() => {
      this.getRank();
    }, 2000);
  }
};
</script>
