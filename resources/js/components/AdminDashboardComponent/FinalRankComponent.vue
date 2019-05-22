<template>
  <div class="col-md-8">
    <div class="card border-success">
      <div class="card-header clearfix">
        <div class="card-title">
          Question and Answer
          <span class="badge"></span>
          <a href="/report/final-result" target="other" class="btn btn-default float-sm-right">
            <i class="fas fa-print"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Contingent</th>
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
            <tr v-for="rank in ranks" :key="rank.id">
              <td>{{ rank.Contestants }}</td>
              <td class="text-center">{{ rank.Judge1 }}</td>
              <td class="text-center">{{ rank.Judge2 }}</td>
              <td class="text-center">{{ rank.Judge3 }}</td>
              <td class="text-center">{{ rank.Judge4 }}</td>
              <td class="text-center">{{ rank.Judge5 }}</td>
              <td class="text-center" style="color:green;">{{ rank.T }}</td>
              <th class="text-center" style="color:red;">{{ rank.counter }}</th>
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
  data() {
    return {
      ranks: []
    };
  },
  methods: {
    fetchRank() {
      axios
        .get("/report/final")
        .then(response => {
          this.ranks = response.data;
        })
        .catch(err => {
          return err;
        });
    }
  },
  created() {
    this.fetchRank();
    setInterval(() => {
      this.fetchRank();
    }, 3000);
  }
};
</script>
