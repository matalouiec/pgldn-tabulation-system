<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">PRELIMINARY CATEGORY SCOREBOARD</div>
          <div class="card-body">
            <div class="row">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Festival Costume</th>
                    <th class="text-center" scope="col">Cocktail Dress</th>
                    <th class="text-center" scope="col">Swim Wear</th>
                    <th class="text-center" scope="col">Maranao Inspired Gown</th>
                    <th class="text-center" scope="col">Preliminary</th>
                    <th class="text-center" scope="col">Total</th>
                    <th class="text-center" scope="col">Rank</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="rank in rankList" :key="rank.id">
                    <td class="text-center">
                      <b-form-checkbox name="contestant"></b-form-checkbox>
                    </td>
                    <td class="text-left">#{{ rank.number }} - {{ rank.name }}</td>
                    <td class="text-center">{{ rank.fc }}</td>
                    <td class="text-center">{{ rank.cd }}</td>
                    <td class="text-center">{{ rank.sw }}</td>
                    <td class="text-center">{{ rank.mig }}</td>
                    <td class="text-center">{{ rank.pi }}</td>
                    <td class="text-center" style="color:red;font-weight:bold;">{{ rank.T }}</td>
                    <th class="text-center" scope="row">{{ rank.counter }}</th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { setInterval } from "timers";
export default {
  data() {
    return {
      rankList: []
    };
  },
  methods: {
    fetchRank() {
      axios
        .get("/api/finals/rank")
        .then(response => {
          this.rankList = response.data;
          console.log(response.data);
        })
        .catch(err => console.log(err));
    }
  },
  mounted() {
    this.fetchRank();
    setInterval(() => {
      this.fetchRank();
    }, 2000);
  }
};
</script>
