<template>
  <div class="container mt-3"
    v-if="all_article">
    <button type="button" 
      class="btn btn-primary"
      @click="buttonAddArticle()">
      Add New
    </button>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12" 
        v-for="post in paginate(all_post)" 
        :key="post.id">
        <div class="card mt-3">
          <div class="card-header">
            <h5>Title : {{post.Title}}</h5>
          </div>
          <div class="card-body">
            <p class="card-title text-muted small">Category : {{post.Category}}</p>
            <p class="card-text"
              @click="postDetail(post.id)">Content : {{post.Content.substring(0, 50)}}... 
              <span class="small text-muted">
                read more</span></p>
          </div>
        </div>
      </div>
    </div>
    <nav aria-label="...">
      <ul class="pagination pagination-sm mt-4">
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
          :class="{ 'disabled': currentPage === 
            Math.ceil(all_post.length / perPage) }">
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
    <ArticleDetail 
      :dataDetail="post_detail"
      @isDetail="isDetail"
      v-if="is_detail"/>
  </div>
  <div class="container mt-3">
    <AddArticle 
      v-if="add_article"/>
  </div>
</template>

<script>
  import axios from 'axios'
  import ArticleDetail from '../views/ArticleDetail.vue'
  import AddArticle from '../views/AddArticle.vue'
  export default{
    components:{
      ArticleDetail,
      AddArticle,
    },
    data() {
      return {
        all_post: [],
        post_detail: [],
        currentPage: 1, 
        perPage: 6,
        is_detail: false,
        add_article: false,
        all_article: true,
      }
    },
    mounted() {
      this.allPosts()
      window.addEventListener('resize', this.handleWindowResize)
    },
    beforeDestroy() {
      window.removeEventListener('resize', this.handleWindowResize);
    },
    methods: {
      allPosts(){
        axios.get('http://127.0.0.1:8000/api/article')
        .then((ress) => this.all_post = 
          ress.data.data.filter((post) => post.Status === 'Publish'))
        .catch((err) => console.log(err))
      },
      postDetail(id){
        axios.get('http://127.0.0.1:8000/api/article/'+id)
        .then((ress) => {
          this.post_detail = ress.data.data
          this.is_detail = true
          this.all_article = false
        })
        .catch((err) => console.log(err))
      },
      paginate(list) {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        return list.slice(start, end);
      },
      handleWindowResize() {
        window.innerWidth <= 768 ? this.perPage = 3 : this.perPage = 10
      },
      isDetail(data){
        this.is_detail = data
        this.all_article = true
      },
      buttonAddArticle(){
        this.add_article = true
        this.all_article = false
      }
    },
  }
</script>