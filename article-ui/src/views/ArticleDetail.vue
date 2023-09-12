<template>
  <button class="btn btn-primary" @click="isDetail()">Go to home</button>
  <div class="card mt-3">
    <div class="card-header">
      {{dataDetail.Title}}
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>{{dataDetail.Content}}</p>
        <footer class="blockquote-footer">
          Category : <cite title="Source Title">
            {{dataDetail.Category}}</cite></footer>
      </blockquote>
    </div>
  </div>
</template>

<script>
  export default {
    emits: ['isDetail'],
    props:{dataDetail:{}},
    methods: {
      isDetail(){
        this.$emit('isDetail', false)
      }
    },
  }
</script>