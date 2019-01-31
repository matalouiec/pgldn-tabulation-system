<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ categoryname }}</div>
          <div class="card-body">
            <div class="row">
              <h1>{{ categoryid }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["categoryid", "categoryname"],
  methods: {},
  created() {}
};
</script>
