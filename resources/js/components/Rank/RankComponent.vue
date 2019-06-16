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
                      <b-form-checkbox v-model="selectedCandidates" :value="rank" :name="rank.name"></b-form-checkbox>
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
                <tfoot>
                  <tr>
                    <td colspan="9">
                      <button
                        class="btn btn-success float-sm-right"
                        data-toggle="modal"
                        data-target="#finalistModal"
                      >Proceed to finals</button>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="finalistModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="finalistModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div v-if="xcount>0" class="modal-header">
            <h5 class="modal-title" id="finalistModalLabel">Confirm Finalist</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div v-if="xcount>0" class="modal-body">
            Top {{ xcount }} candidates who will proceed to the finals:
            <br>
            <ul>
              <b>
                <li
                  v-for="candidate in selectedCandidates"
                  :key="candidate.id"
                >#{{ candidate.number }} - {{ candidate.name }} ({{ candidate.T }})</li>
              </b>
            </ul>Previous records will be overwritten. Are you sure?
          </div>
          <div v-else class="modal-body">
            <h2>Please select at least one candidate.</h2>
          </div>
          <div v-if="xcount>0" class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button
              type="button"
              class="btn btn-primary"
              v-on:click="saveTopFinalist"
              data-dismiss="modal"
            >YES</button>
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
      rankList: [],
      selectedCandidates: []
    };
  },
  methods: {
    fetchRank() {
      axios
        .get("/api/finals/rank")
        .then(response => {
          this.rankList = response.data;
        })
        .catch(err => console.log(err));
    },
    saveTopFinalist() {
      axios
        .post("/api/finals/topcandidates", { payload: this.selectedCandidates })
        .then(response => {
          if (response.data.code == 201) {
            this.$notify({
              group: "app-notification",
              type: "success",
              title: "Success!!!",
              text: "Success."
            });
          } else {
            this.$notify({
              group: "app-notification",
              type: "error",
              title: "Failed!!!",
              text: "Failed."
            });
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  mounted() {
    this.fetchRank();
    setInterval(() => {
      this.fetchRank();
    }, 2000);
  },
  computed: {
    xcount: function() {
      return this.selectedCandidates.length;
    }
  }
};
</script>
