<template>
  <div>
    <form @submit.prevent="addArticle()">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" v-model="form.Title">
      </div>
      <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" class="form-control" v-model="form.Category">
      </div>
      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea cols="30" rows="10" class="form-control" v-model="form.Content"></textarea>
      </div>
      <div>
        <label>Select Status:</label>
        <select v-model="form.Status" class="form-control">
          <option value="Publish">Publish</option>
          <option value="Draft">Drafts</option>
        </select>
      </div>
      <button type="submit" 
        class="btn btn-primary mt-3">Submit</button>
    </form>
  </div>
</template>

<script>
  import axios from 'axios'
  export default{
    data() {
      return {
        form:{
          Title: '',
          Content: '',
          Category: '',
          Status: '',
        }
      }
    },
    methods: {
      addArticle(){
        if (!this.form.Title 
          || !this.form.Category 
          || !this.form.Content 
          || !this.form.Status) {
          alert('Mohon isi semua field sebelum mengirimkan form.')
          return
        }
        if (this.form.Title.length < 20) {
          alert('Judul harus memiliki minimal 20 karakter.');
          return;
        }
        if (this.form.Content.length < 200) {
          alert('Content harus memiliki minimal 200 karakter.');
          return;
        }
        if (this.form.Category.length < 3) {
          alert('Category harus memiliki minimal 3 karakter.');
          return;
        }
        const form = this.form
        axios.post('http://127.0.0.1:8000/api/article', form)
        .then((ress) => document.location="/")
        .catch((err) => console.log(err))
      }
    },
  }
</script>