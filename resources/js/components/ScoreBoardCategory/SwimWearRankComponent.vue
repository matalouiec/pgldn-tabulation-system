<template>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-title">
        <div class="card-header">Best in Swim Wear</div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" rowspan="2">Rank</th>
              <th class="text-center" rowspan="2">Contestants</th>
              <th
                class="text-center"
                colspan="4"
                style="background:rgba(64, 160, 255,0.5);"
              >CRITERIA FOR JUDGING</th>
              <th class="text-center" rowspan="2">TOTAL (100%)</th>
            </tr>
            <tr>
              <th class="text-center">Beauty of Figure (40%)</th>
              <th class="text-center">Beauty of the Face (30%)</th>
              <th class="text-center">Poise/Bearing/Personality (20%)</th>
              <th class="text-center">Overall Impact (20%)</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="rank in rankList"
              v-bind:key="rank.id"
              :style="'background-color:'+rank.backcolor"
            >
              <th scope="row" class="text-center">{{ rank.seqno }}</th>
              <td>{{ rank.Contestants }}</td>
              <td class="text-center">{{ rank.figure }}</td>
              <td class="text-center">{{ rank.face }}</td>
              <td class="text-center">{{ rank.personality }}</td>
              <td class="text-center">{{ rank.impact }}</td>
              <td class="text-center">{{ rank.TOTAL }}%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["categoryid"],
  data() {
    return {
      rankList: []
    };
  },
  methods: {
    getRankFemale() {
      axios
        .post("/scoreboard/swim-wear/rank")
        .then(response => {
          this.rankList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    this.getRankFemale();
    setInterval(() => {
      this.getRankFemale();
    }, 2000);
  }
};
</script>
