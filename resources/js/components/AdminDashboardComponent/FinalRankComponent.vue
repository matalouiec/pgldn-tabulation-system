<template>
  <div class="col-md-8">
    <div class="card border-primary">
      <div class="card-header clearfix">
        <div class="card-title">
          <button
            class="btn btn-info float-sm-right"
            v-on:click="saveRank()"
            data-toggle="modal"
            data-target="#msgBox1"
          >
            <span class="material-icons">check_circle</span>
          </button>
          <a
            :href="'/report/final-result/'+this.vwname"
            target="other"
            class="btn btn-success float-sm-right"
            style="margin:1px;"
          >
            <span class="material-icons">print</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Contestant</th>
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
    <msgbox :params="msgbox" :data="data"></msgbox>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["vwname"],
  data() {
    return {
      ranks: [],
      msgbox: {
        title: "Confirm",
        message: "Confirm saving rank?",
        type: "confirm"
      },
      data: { id: 1 }
    };
  },
  methods: {
    fetchRank() {
      axios
        .get("/report/final/" + this.vwname)
        .then(response => {
          this.ranks = response.data;
        })
        .catch(err => {
          return err;
        });
    },
    saveRank() {}
  },

  created() {
    this.fetchRank();
    setInterval(() => {
      this.fetchRank();
    }, 3000);
  }
};
</script>
