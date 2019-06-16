<template :id="bs-modal">
  <div>
    <div
      class="modal fade"
      :id="'myModal'+contestant.id+category.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">#{{ contestant.number }} - {{ contestant.name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row" id="caption">
                <div class="col-md-4">
                  <center style="font-weight:bold;">Contestant Details</center>
                </div>
                <div class="col-md-8">
                  <center style="font-weight:bold;">Criteria for Judging</center>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <center>
                    <img
                      :src="'/storage/cover_image/'+contestant.cover_image"
                      :alt="contestant.name"
                    >
                    <br>
                    <table>
                      <tr>
                        <td style="font-weight:bold;">Name :</td>
                        <td style="color:red;">{{ contestant.name }}</td>
                      </tr>
                      <tr>
                        <td style="font-weight:bold;">Representing :</td>
                        <td style="color:red;">{{ contestant.representing }}</td>
                      </tr>
                    </table>
                  </center>
                </div>
                <div class="col-md-8">
                  <table class="table">
                    <tbody>
                      <tr v-for="criteria in criterias" :key="criteria.id">
                        <td style="padding-top:10px;width:10em;">
                          <span style="font-size:1vw;" class="criteria">{{ criteria.criteria_name }}</span>
                          <span style="font-size:0.8vw;color:green;">({{ criteria.percentage }}%)</span>
                        </td>
                        <td>
                          <input
                            @change="computeTotalScore"
                            v-validate="'between:0,'+criteria.percentage"
                            v-model="cvalue[criteria.id]"
                            type="range"
                            step="0.5"
                            :id="criteria.id"
                            min="0"
                            :max="criteria.percentage"
                            style="width:100%;"
                            class="custom-range"
                            :name="'scores'+contestant.id+category.id+criteria.id"
                            tabindex="-1"
                            required
                          >
                        </td>
                        <td width="95px">
                          <input
                            @change="computeTotalScore"
                            v-validate="'between:0,'+criteria.percentage"
                            v-model="cvalue[criteria.id]"
                            type="number"
                            :max="criteria.percentage"
                            style="width:100%;font-size:1.2vw;"
                            id="txtScore"
                            :name="'scores'+contestant.id+category.id+criteria.id"
                            v-bind:class="{error_input: errors.has('scores'+contestant.id+category.id+criteria.id)}"
                          >
                        </td>
                      </tr>
                    </tbody>
                    <tfoot v-if="criterias.length!=0">
                      <tr>
                        <td></td>
                        <td
                          align="center"
                          style="color:#000;font-size:1.2vw;font-weight:bold;"
                        >Total</td>
                        <td style="font-size:1.2vw;font-weight:bold;">{{ totalScore.toFixed(2) }}%</td>
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
            <button
              v-bind:disabled="errors.items.length>0"
              @click="onFormSubmit"
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
            >Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["contestant", "category"],
  components: { Notification },
  data() {
    return {
      criterias: [],
      cvalue: [],
      payload: [],
      scores: [],
      totalScore: 0,
      x: document.getElementById("toast")
    };
  },
  created: function() {
    this.fetchCriterias();
  },
  methods: {
    setDefaultValue: function() {
      for (var i = 0; i < this.criterias.length; i++) {
        this.cvalue[this.criterias[i].id] = 0;
      }
    },
    computeTotalScore: function() {
      this.totalScore = 0;
      for (var i = 0; i < this.criterias.length; i++) {
        this.totalScore =
          parseFloat(this.totalScore) +
          parseFloat(this.cvalue[this.criterias[i].id]);
      }
    },
    onFormSubmit: function() {
      this.x.style.display = "block"; //diplay loading gif
      // this will convert row scores into json format
      for (let i = 0; i < this.cvalue.length; i++) {
        if (this.cvalue[i] != null) {
          let x = {
            criteriaid: i,
            value: this.cvalue[i]
          };
          this.scores.push(x);
        }
      }

      // initiate payload to be transmitted to the server
      this.payload = {
        category: {
          id: this.category.id,
          name: this.category.name
        },
        contestant: this.contestant,
        score: this.scores,
        totalScore: this.totalScore
      };
      //end payload

      axios
        .post("/judge-dashboard/rating", {
          payload: this.payload
        })
        .then(response => {
          if (response.status == 200) {
            if (response.data.id > 0) {
              this.$parent.fetch(); // re - fetch data
              this.x.style.display = "none";
              this.$notify({
                group: "app-notification",
                type: "success",
                title: "Success!!!",
                text: "Your scores are saved."
              });
            }
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchCriterias: function() {
      axios
        .get("/judge-dashboard/category/criteria/" + this.category.id)
        .then(response => {
          this.criterias = response.data.criterias;
          this.setDefaultValue();
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>
<style scoped>
img {
  margin-top: 10px;
  margin-bottom: 10px;
  width: inherit;
  height: 70%;
  width: 70%;
}
.modal-title {
  font-weight: bold;
}
.table {
  margin-top: 10px;
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
  background: url("/storage/img/flower.png") no-repeat;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 48px;
  height: 48px;
  background: url("/storage/img/flower.png") no-repeat;
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
  max-width: 70% !important;
}
.label-primary {
  font-weight: bold;
}
.label-warning {
  color: red;
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