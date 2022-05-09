<template>
  <div class="news">
    <AdminNavbar />
    <div class="container mt-5">
      <router-link
        :to="
          '/create-news/' +
          this.$route.params.token +
          '/' +
          this.$route.params.role
        "
        class="btn btn-success"
        >Create News</router-link
      >
    </div>
    <div class="container mt-3">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">No</th>
            <th class="text-center" scope="col">Tanggal</th>
            <th class="text-center" scope="col">Judul</th>
            <th class="text-center" scope="col">Konten</th>
            <th colspan="2" scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(news, index) in newsdata"
            :key="news.id"
            class="mt-2"
          >
            <th class="text-center" scope="row">{{ index + 1 }}</th>
            <td class="text-center">{{ news.tanggal }}</td>
            <td class="text-center">{{ news.judul }}</td>
            <td class="text-center">{{ news.konten }}</td>
            <td class="text-center">
              <router-link :to="'/edit-news/'+news.id+'/'+ $route.params.token+'/'+$route.params.role" 
              class="btn btn-primary action-btn">Edit</router-link>
            </td>
            <td class="text-center">
              <button
                @click="deletenews(news.id)"
                class="btn btn-danger action-btn"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import AdminNavbar from '../../components/AdminNavbar.vue'
export default {
  name: "News",
  components: {
    AdminNavbar
  },
  data(){
    return{
      newsdata: []
    }
  },
  methods: {
    getnews(){
      axios
      .get("http://127.0.0.1:8000/v1/admin_news?token="+this.$route.params.token)
      .then((Response)=>[
        // console.log(Response.data),
        this.newsdata = Response.data
      ])
    },
    deletenews(id){
      axios
      .delete("http://127.0.0.1:8000/v1/admin_news/"+id+"?token="+this.$route.params.token)
      .then(()=>[
        this.$toast.success("News Deleted", {
          type: "success",
          duration: "3000",
          position: "top-right",
          dismissable: "true"
        }),
        axios
        .get("http://127.0.0.1:8000/v1/admin_news?token="+this.$route.params.token)
        .then((Response)=>[
          this.newsdata = Response.data
        ])
      ])
    }
  },
  mounted(){
    this.getnews();
  }
}
</script>

<style>

</style>