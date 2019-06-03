<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">MARANAO INSPIRED GOWN</div>
          <div class="card-body">
            <div class="row">
              <final-rank vwname="vw_maranao"></final-rank>
              <judges-gauge :catid="16" :levelid="3"></judges-gauge>
            </div>
            <br>
            <div class="row">
              <prelim-mi
                v-for="judge in judgesList"
                :key="judge.id"
                :judge="judge"
                style="margin-top:20px;"
              ></prelim-mi>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      rounds: [],
      judgesList: []
    };
  },
  created() {
    this.getRounds();
    this.getActiveJudges();
  },
  methods: {
    getRounds: function() {
      axios
        .get("/round/getRoundsWithCategories")
        .then(response => {
          this.rounds = response.data;
        })
        .catch(err => {
          return err;
        });
    },
    getActiveJudges: function() {
      axios
        .get("/judges")
        .then(response => {
          this.judgesList = response.data;
        })
        .catch(err => {
          return err;
        });
    }
  }
};
</script>


