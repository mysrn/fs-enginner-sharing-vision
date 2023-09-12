<template>
  <div class="container" v-if="!is_edit">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(post, index) in paginate(all_post)" 
          :key="post.id">
          <th scope="row">{{(currentPage - 1) * perPage + index + 1}}</th>
          <td>{{post.Title}}</td>
          <td>{{post.Category}}</td>
          <td>{{post.Status}}</td>
          <td>
            <a class="badge bg-primary" 
              @click="detailArticle(post.id)">
              <i class="bi bi-pencil"></i> edit</a>
          </td>
        </tr>
      </tbody>
    </table>
    <nav aria-label="...">
      <ul class="pagination pagination-sm">
        <li class="page-item" 
          :class="{ 'disabled': currentPage === 1 }">
          <a class="page-link" 
            @click="currentPage -= 1" 
            aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item" 
          v-for="page in Math.ceil(all_post.length / perPage)" 
          :key="page" 
          :class="{ 'active': currentPage === page }">
          <a class="page-link" 
            @click="currentPage = page">{{ page }}</a>
        </li>
        <li class="page-item" 
          :class="{ 'disabled': currentPage === Math.ceil(all_post.length / perPage) }">
          <a class="page-link" 
            @click="currentPage += 1" 
            aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="container mt-3">
    <EditArticle 
      :dataDetail="detail_article"
      @isDetail="isDetail"
      v-if="is_edit"/>
  </div>
</template>

<script>
  import axios from 'axios'
  import EditArticle from '../views/EditArticle.vue'
  export default{
    components:{
      EditArticle,
    },
    data() {
      return {
        all_post: [],
        currentPage: 1, 
        perPage: 10,
        detail_article: [],
        is_edit: false
      }
    },
    mounted() {
      this.allPosts()
    },
    methods: {
      allPosts(){
        axios.get('http://127.0.0.1:8000/api/article')
        .then((ress) => {this.all_post = 
          ress.data.data.filter((post) => post.Status === 'Trash')
        })
        .catch((err) => console.log(err))
      },
      detailArticle(id){
        axios.get('http://127.0.0.1:8000/api/article/'+id)
        .then((ress) => {
          this.detail_article = 
            ress.data.data
          this.is_edit = true
        })
        .catch((err) => console.log(err))
      },
      paginate(list) {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        return list.slice(start, end);
      },
      isDetail(data){
        this.is_edit = data
      },
    },
  }
</script>
