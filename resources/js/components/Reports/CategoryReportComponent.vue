<template>
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th class="text-center">Contestant</th>
        <th class="text-center">Judge 1</th>
        <th class="text-center">Judge 2</th>
        <th class="text-center">Judge 3</th>
        <th class="text-center">Judge 4</th>
        <th class="text-center">Judge 5</th>
        <th class="text-center">Total</th>
        <th class="text-center">Rank</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="result in resultset" :key="result.id">
        <td>{{ result.Contestants }}</td>
        <td class="text-center">{{ result.Judge1 }}</td>
        <td class="text-center">{{ result.Judge2 }}</td>
        <td class="text-center">{{ result.Judge3 }}</td>
        <td class="text-center">{{ result.Judge4 }}</td>
        <td class="text-center">{{ result.Judge5 }}</td>
        <td class="text-center">{{ result.T }}</td>
        <th scope="row" class="text-center">{{ result.counter }}</th>
      </tr>
    </tbody>
  </table>
</template>
<script>
import axios from "axios";
export default {
  props: ["vwname"],
  data() {
    return {
      resultset: []
    };
  },
  methods: {
    async getRankScores() {
      axios
        .get("/report/final/" + this.vwname)
        .then(response => {
          this.resultset = response.data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  created() {
    this.getRankScores();
  }
};
</script>

