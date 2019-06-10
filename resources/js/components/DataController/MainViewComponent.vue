<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <data-judges-list></data-judges-list>
          </div>
          <div class="col-md-8">
            <div v-for="category in filteredCategories" :key="category.id" class="card border-info">
              <b class="card-header">
                {{ category.name }}
                <span
                  class="badge badge-primary badge-pill"
                >{{ category.counter }}</span>
              </b>
              <div class="card-body">
                <data-contestant-tile
                  v-for="rating in category.ratings"
                  :key="rating.id"
                  :rating="rating"
                ></data-contestant-tile>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "mainDataControllerView",
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["selectedJudgeInfo", "filteredCategories"])
  }
};
</script>
<style scoped>
.card {
  margin-bottom: 10px;
}
</style>
