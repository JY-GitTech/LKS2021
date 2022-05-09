<template>
  <div class="NewsEdit">
    <Admin-navbar />
    <div class="container crud-form mt-5 mb-5">
        <h1 class="text-center">Edit News</h1>
        
        <div class="form-group mt-5">
            <label for="Harga">Judul :</label>
            <input 
            type="text"
            class="form-control"
            v-model="news.judul"
            >
        </div>
        <div class="form-group">
            <label for="Stok">Konten :</label>
            <textarea 
            name="" 
            id="" 
            cols="30" 
            rows="5"
            class="form-control"
            v-model="news.konten"
            ></textarea>
        </div>
        <div class="form-group">
            <label for="Nama">Tanggal :</label>
            <input 
            type="date"
            class="form-control"
            v-model="news.tanggal"
            >
        </div>
        <button @click="updatenews" class="btn btn-success">Edit</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import AdminNavbar from "../../components/AdminNavbar.vue";

export default {
  name: "ProduksCreate",
  components: {
    AdminNavbar,
  },
  data(){
      return{
          news: {}
      }
  },
  methods: {
      getnews(){
          axios
          .get("http://127.0.0.1:8000/v1/admin_news/"+this.$route.params.id+"?token="+this.$route.params.token)
          .then((Response)=>[
              this.news = Response.data,
            //   console.log(this.news)
          ])
      },
      updatenews(){
          axios
          .put("http://127.0.0.1:8000/v1/admin_news/"+this.$route.params.id+"?token="+this.$route.params.token, this.news)
          .then(()=>[
              this.$toast.success("News Edited",{
                  type: "success",
                  duration: "3000",
                  dismissable: "true",
                  position: "top-right"
              }),
              this.$router.push({path: "/news/"+this.$route.params.token+"/"+this.$route.params.role})
          ])

      }
  },
  mounted(){
      this.getnews();
  }
};
</script>

<style>
.crud-form{
    width: 50%;
    box-shadow: 0 0 10px 2px lightgreen;
    padding: 50px;
}
</style>