<template :id="bs-modal">
  <div
    class="modal fade"
    :id="'MyModal'+rating.id"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">#{{ rating.number }} - {{ rating.name }}</h5>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row" id="caption">
              <div class="col-md-4">
                <center style="font-weight:bold;">Contingent Details</center>
              </div>
              <div class="col-md-8">
                <center style="font-weight:bold;">Criteria for Judging</center>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <center>
                  <img
                    :src="'/storage/cover_image/'+rating.cover_image"
                    class="img-fluid"
                    :alt="rating.name"
                  >
                  <br>
                  <span class="label label-primary">Name</span> :
                  <span class="label label-warning">{{ rating.name }}</span>
                  <br>
                  <span class="label label-primary">Age</span> :
                  <span class="label label-warning">{{ rating.age }} years old</span>
                  <br>
                  <span class="label label-primary">Representing</span> :
                  <span class="label label-warning">{{ rating.representing }}</span>
                  <br>
                  <span class="label label-primary">Address</span> :
                  <span class="label label-warning">{{ rating.short_description }}</span>
                </center>
              </div>
              <div class="col-md-8">
                <table class="table">
                  <tbody>
                    <tr v-for="entry in ratingEntries" :key="entry.id">
                      <td style="padding-top:10px;width:10em;">
                        <span style="font-size:1vw;" class="criteria">{{ entry.criteria_name }}</span>
                        <span style="font-size:0.8vw;color:green;">({{ entry.percentage }}%)</span>
                      </td>
                      <td>
                        <input
                          @change="computeTotalScore"
                          v-validate="'between:0,'+entry.percentage"
                          v-model="entry.acquired_rating"
                          type="range"
                          step="0.5"
                          :id="entry.id"
                          min="0"
                          :max="entry.percentage"
                          style="width:350px;"
                          class="custom-range"
                          :name="'scores'+entry.id"
                          tabindex="-1"
                          required
                        >
                      </td>
                      <td>
                        <input
                          @change="computeTotalScore"
                          v-validate="'between:0,'+entry.percentage"
                          v-model="entry.acquired_rating"
                          type="number"
                          min="0"
                          :max="entry.percentage"
                          style="width:72px;"
                          id="txtScore"
                          :name="'scores'+entry.id"
                          v-bind:class="{error_input: errors.has('scores'+entry.id)}"
                        >
                      </td>
                    </tr>
                  </tbody>
                  <tfoot v-if="ratingEntries.length!=0">
                    <tr>
                      <td></td>
                      <td align="center" style="color:#000;font-size:20px;font-weight:bold;">Total</td>
                      <td style="font-size:20px;font-weight:bold;">{{ totalScore }}%</td>
                    </tr>
                  </tfoot>
                  <tfoot v-else>
                    <tr>
                      <td colspan="3" align="center" style="padding-top:50px;">No Criteria Found</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <span v-show="errors.items.length>0" class="error_label">Score out of range!!!&nbsp;</span>
          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Left Align">
            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
            Close
          </button>-->
          <button
            v-bind:disabled="errors.items.length>0"
            type="button"
            class="btn btn-primary"
            data-dismiss="modal"
            aria-label="Left Align"
            @click="onFormSubmit"
          >
            <span class="glyphicon glyphicon-floppy-disk" arial-hidden="true"></span>
            Save
          </button>
          <button
            v-bind:disabled="errors.items.length>0"
            type="button"
            class="btn btn-success"
            data-dismiss="modal"
            aria-label="Left Align"
            @click="finalizeRating"
          >
            <span class="glyphicon glyphicon-ok" arial-hidden="true"></span>
            Save & Lock
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["rating", "ratingEntries"],
  data() {
    return {
      totalScore: 0,
      payload: []
    };
  },
  created() {
    this.totalScore = this.rating.totalrating;
  },
  methods: {
    computeTotalScore: function() {
      this.totalScore = 0;
      for (var i = 0; i < this.ratingEntries.length; i++) {
        this.totalScore =
          parseFloat(this.totalScore) +
          parseFloat(this.ratingEntries[i].acquired_rating);
      }
    },
    finalizeRating: function() {
      let id = this.rating.id;
      this.onFormSubmit();
      axios
        .post("/scoreboard/finalize", {
          id: id
        })
        .then(response => {
          if (response.status == 200 && response.data == true) {
            this.$notify({
              group: "app-notification",
              type: "success",
              title: "Success!!!",
              text: "Your scores are finalized."
            });
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    onFormSubmit: function() {
      this.payload = {
        rating: this.rating,
        ratingEntries: this.ratingEntries,
        totalScore: this.totalScore
      };

      axios
        .post("/scoreboard/rating", {
          payload: this.payload
        })
        .then(response => {
          if (response.status == 200 && response.data == true) {
            this.$notify({
              group: "app-notification",
              type: "success",
              title: "Success!!!",
              text: "Your scores are saved."
            });
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
<style scoped>
img {
  height: 70%;
  width: 70%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 7px;
  margin-top: 10px;
  border-radius: 5px;
  background: #006865;
  outline: none;
  opacity: 0.7;
  -webkit-transition: 0.2s;
  transition: opacity 0.2s;
}

.slider:hover {
  opacity: 10;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 48px;
  height: 48px;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 48px;
  height: 48px;
  cursor: pointer;
}
.criteria {
  color: #000;
  font-weight: bold;
}
#txtScore {
  order: none;
  border-color: transparent;
  font-weight: bold;
  font-size: 20px;
}
.modal-lg {
  max-width: 75% !important;
}
.error_label {
  color: red;
  font-size: 20px;
  font-weight: bold;
}
.error_input {
  color: red;
}
</style>


