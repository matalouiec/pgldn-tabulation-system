<template>
  <div class="col-md-3">
    <div
      class="card border-primary mb-3"
      data-toggle="modal"
      :data-target="'#myModal'+contestant.id+category.id"
    >
      <center class="contestant-label">
        <img
          :src="'/storage/cover_image/'+contestant.cover_image"
          class="img-thumbnail"
          :alt="contestant.name"
        >
        <span class="label-name">#{{ contestant.number }} - {{ contestant.name }}</span>
        <br>
        <span class="label-address">({{ contestant.representing }})</span>
      </center>
    </div>
    <scoresheet-component :contestant="contestant" :category="category"></scoresheet-component>
  </div>
</template>
<script>
module.exports = {
  props: ["contestant", "category"],
  methods: {
    fetch() {
      this.$parent.fetchCategory();
    }
  }
};
</script>
<style scoped>
.contestant-label {
  margin-bottom: 10px;
}

.label-name {
  font-size: 1.4vw;
  font-weight: bolder;
}

.label-address {
  font-size: 1vw;
}

img {
  display: block;
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: auto;
  margin-right: auto;
  width: 70%;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  transition: 0.3s;
  width: auto;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 2px 16px;
}
</style>