<template>
  <div>
    <h1>Edit Article</h1>
    <form @submit.prevent="editArticle()">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" v-model="dataDetail.Title">
      </div>
      <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" class="form-control" v-model="dataDetail.Category">
      </div>
      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea cols="30" rows="10" class="form-control" v-model="dataDetail.Content"></textarea>
      </div>
      <button type="submit" 
        class="btn btn-primary mt-3">Submit</button>
    </form>
  </div>
</template>

<script>
  import axios from 'axios'
  export default {
    emits: ['isDetail'],
    props:{dataDetail:{}},
    methods: {
      editArticle(){
        if (!this.dataDetail.Title 
          || !this.dataDetail.Category 
          || !this.dataDetail.Content 
          || !this.dataDetail.Status) {
          alert('Mohon isi semua field sebelum mengirimkan form.')
          return
        }
        if (this.dataDetail.Title.length < 20) {
          alert('Judul harus memiliki minimal 20 karakter.');
          return;
        }
        if (this.dataDetail.Content.length < 200) {
          alert('Content harus memiliki minimal 200 karakter.');
          return;
        }
        if (this.dataDetail.Category.length < 3) {
          alert('Category harus memiliki minimal 3 karakter.');
          return;
        }
        const form = this.dataDetail
        axios.put('http://127.0.0.1:8000/api/article/${form.id}', form)
        .then((ress) => {
          this.$emit('isDetail', false)
          document.location="/"
        })
        .catch((err) => console.log(err))
      }
    },
  }
</script>