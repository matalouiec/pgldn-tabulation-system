<template>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-title">
        <div class="card-header">Best in Festival Costume</div>
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
              <th
                class="text-center"
                title="Creativity, Style and Design of the Costume"
              >Creativity, Style and Design (40%)</th>
              <th
                class="text-center"
                title="Ethnicity of Materials used"
              >Ethnicity of Materials (30%)</th>
              <th class="text-center" title="Fitness of the Attire">Fitness of the Attire (20%)</th>
              <th
                class="text-center"
                title="Confidence/ Poise/ Projection"
              >Confidence/ Poise/ Projection (10%)</th>
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
              <td class="text-center">{{ rank.creativity }}</td>
              <td class="text-center">{{ rank.ethnicity }}</td>
              <td class="text-center">{{ rank.fitness }}</td>
              <td class="text-center">{{ rank.confidence }}</td>
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
        .post("/scoreboard/festival-costume/rank")
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
