<template>
  <div class="col-md-4" style="margin-bottom:5px;">
    <div class="row">
      <div class="col-md-12">
        <div class="card" :id="rating.id">
          <div class="card-header clearfix">
            <div class="card-title">
              #{{ rating.number }} - {{ rating.name }}
              <button
                v-if="rating.is_final!=1"
                class="btn btn-success float-sm-right"
                title="Modify"
                data-toggle="modal"
                :data-target="'#MyModal'+rating.id"
                aria-label="Left Align"
              >
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                EDIT
              </button>
              <button
                v-else
                class="btn btn-danger float-sm-right"
                title="Final"
                aria-label="Left Align"
                data-toggle="modal"
                data-target="#msgBox01"
              >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                LOCKED
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <center>
                  <img :src="'/storage/cover_image/'+rating.cover_image" class="img-fluid">
                </center>
              </div>
              <div class="col-sm-8">
                <ul class="list-group">
                  <li
                    v-for="ratingentry in ratingEntries"
                    :key="ratingentry.id"
                    class="list-group-item d-flex justify-content-between align-items-center"
                    style="font-size:0.9em;"
                  >
                    {{ ratingentry.criteria_name }}
                    <span
                      class="badge badge-primary badge-pill"
                    >{{ parseFloat(ratingentry.acquired_rating).toFixed(2) }}</span>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                    style="background:#B3ECEC;"
                  >
                    <b>Total</b>
                    <span class="badge badge-info badge-pill">{{ totalScore.toFixed(2) }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <scoreboard-modal :rating="rating" :ratingEntries="ratingEntries"></scoreboard-modal>
    <msgbox :params="params" :data="data"></msgbox>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["rating"],
  data() {
    return {
      ratingEntries: [],
      totalScore: 0,
      params: {
        title: "Locked!",
        message:
          "Locked scores can no longer be modified. Please contact the official tabulator.",
        type: "info"
      },
      data: {
        id: "01"
      }
    };
  },
  created() {
    this.fetchRatingEntries();
  },
  mounted() {
    setInterval(() => {
      this.computeTotalScore();
    }, 2000);
  },
  methods: {
    fetchRatingEntries: function() {
      axios
        .get("/scoreboard/rating-entries/" + this.rating.id)
        .then(response => {
          this.ratingEntries = response.data.ratingentries;
          this.computeTotalScore();
        })
        .catch(error => {
          console.log(error);
        });
    },
    computeTotalScore: function() {
      this.totalScore = 0;
      for (var i = 0; i < this.ratingEntries.length; i++) {
        this.totalScore =
          parseFloat(this.totalScore) +
          parseFloat(this.ratingEntries[i].acquired_rating);
      }
    }
  }
};
</script>
<style scoped>
img {
  margin-top: 10px;
  margin-bottom: 10px;
  /* border: 2px solid #acb0b7; */
  height: 80%;
  width: 80%;
}
#seqno {
  height: 30px;
  width: 30px;
  background: url("/storage/img/star.png") no-repeat;
  position: absolute;
}

#seqno span {
  font-size: 17px;
  font-weight: bold;
  margin-left: 12px;
}
</style>