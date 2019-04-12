<template>
  <div>
    <div class="row" v-for="category in categories" :key="category.id">
      <question-answer-rank :categoryid="category.id"></question-answer-rank>
      <div class="col-md-12">
        <div class="cardborder-warning mb-3" v-if="category.ratings.length > 0">
          <div class="card-header clearfix">
            <div class="card-title">
              <button
                class="btn btn-danger float-sm-right"
                data-toggle="modal"
                :data-target="'#msgBox'+category.id"
              >LOCK SCORES</button>
            </div>
          </div>
          <div class="card-body">
            <div class="row" style="padding-left:5px;padding-right:5px;">
              <scoreboard-thumbnail
                v-for="rating in category.ratings"
                :key="rating.id"
                v-bind:data="rating"
                :rating="rating"
              ></scoreboard-thumbnail>
            </div>
          </div>
        </div>
      </div>
      <msgbox @clicked="onClickChild" :params="params" :data="category"></msgbox>
    </div>
  </div>
</template>
<script>
import axios from "axios";
const cid = 14; // category id
export default {
  data() {
    return {
      categories: [],
      params: {
        // this is for the modal window
        message:
          "This will finalize all your scores on this category. Would you like to continue?",
        title: "Confirm",
        type: "confirm"
      }
    };
  },
  methods: {
    onClickChild(value) {
      if (value.yes) {
        this.finalizeRatings(value.data); // this will finalize all the scores in a specfic category
      }
    },
    finalizeRatings: function(id) {
      axios
        .post("/scoreboard/finalizeratings", { id: id })
        .then(response => {
          if (response.status == 200) {
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
    fetchCategory: function() {
      axios
        .get("/scoreboard/getCategories")
        .then(response => {
          this.categories = response.data.categories;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchSpecificCategory: function() {
      axios
        .post("/scoreboard/getCategory/" + cid)
        .then(response => {
          this.categories = response.data.categories;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  created() {
    this.fetchSpecificCategory();
    setInterval(() => {
      this.fetchSpecificCategory();
    }, 2000);
  }
};
</script>
<style scoped>
ul {
  list-style-type: none;
  float: left;
}
</style>