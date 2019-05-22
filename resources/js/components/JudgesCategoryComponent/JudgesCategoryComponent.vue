<template>
  <div>
    <div id="toast">
      <img src="/storage/img/loading.gif" alt="loading">
    </div>
    <div class="row" v-for="category in categories" :key="category.id">
      <div class="col-md-12">
        <div class="card border-warning mb-3">
          <div class="card-header">{{ category.name }}</div>
          <div class="card-body">
            <div class="container-fluid">
              <div class="row" v-if="category.contestants.length > 0">
                <contestant-thumbnail
                  v-for="contestant in category.contestants"
                  :key="contestant.id"
                  v-bind:data="contestant"
                  :category="category"
                  :contestant="contestant"
                ></contestant-thumbnail>
              </div>
              <div v-else>
                <center>
                  <a :href="category.link" class="btn btn-info">VIEW SCORES</a>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      categories: []
    };
  },
  mounted: function() {
    this.fetchCategory();
    setInterval(() => {
      this.fetchCategory();
    }, 2000);
  },
  methods: {
    fetchCategory: function() {
      axios
        .get("/judge-dashboard/getActiveCategory")
        .then(response => {
          this.categories = response.data.categories;
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>
<style scoped>
#toast {
  top: 0;
  left: 0;
  margin: 0;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 9999;
  background-color: rgba(255, 255, 255, 0.795);
  display: none;
}

#toast img {
  width: 20em;
  height: 20em;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

