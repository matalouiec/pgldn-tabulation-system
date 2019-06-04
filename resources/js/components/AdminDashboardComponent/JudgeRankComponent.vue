<template>
  <div class="col-md-4">
    <div class="card border-primary mb-3">
      <div class="card-header">
        {{ judge.name }}
        <a :href="'/report/qa/'+judge.id" target="other" class="btn float-sm-right">
          <span class="material-icons">print</span>
        </a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Contestant</th>
              <th class="text-center">Score</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="rank in ranks" :key="rank.id">
              <th>{{ rank.seqno }}</th>
              <td>{{ rank.Contestants }}</td>
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
  props: ["judge"],
  data() {
    return {
      ranks: []
    };
  },
  methods: {
    getIndividualRank: function() {
      axios
        .get("/judges/qa/" + this.judge.id)
        .then(response => {
          this.ranks = response.data;
        })
        .catch(err => {
          return err;
        });
    }
  },
  created() {
    this.getIndividualRank();
    setInterval(() => {
      this.getIndividualRank();
    }, 2000);
  }
};
</script>

