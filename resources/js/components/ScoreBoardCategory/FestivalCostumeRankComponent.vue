<template>
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-title">
        <div class="card-header">Best Festival Costume</div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
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
              v-bind:class="{ final: rank.isFinal==1 }"
            >
              <th scope="row" class="text-center">{{ rank.seqno }}</th>
              <td>
                <a
                  href="#"
                  data-toggle="modal"
                  :data-target="'#MyModal'+rank.parent"
                  v-if="rank.isFinal==0"
                >{{ rank.Contestants }}&nbsp;</a>
                <a href="#" data-toggle="modal" data-target="#msgBox01" v-if="rank.isFinal==1">
                  {{ rank.Contestants }}&nbsp;
                  <i class="fa fa-lock" style="color:red;"></i>
                </a>
              </td>
              <td class="text-center">{{ rank.creativity }}</td>
              <td class="text-center">{{ rank.ethnicity }}</td>
              <td class="text-center">{{ rank.fitness }}</td>
              <td class="text-center">{{ rank.confidence }}</td>
              <td class="text-center">{{ rank.TOTAL.toFixed(2) }}%</td>
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

