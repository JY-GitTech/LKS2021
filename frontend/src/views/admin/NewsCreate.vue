<template>
  <div class="NewsCreate">
    <Admin-navbar />
    <div class="container crud-form mt-5 mb-5">
        <h1 class="text-center">Create News</h1>
        
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
        <button @click="createnews" class="btn btn-success">Create</button>
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
      createnews(){
        //   console.log(this.$route.params.token)
          axios
            .post("http://127.0.0.1:8000/v1/admin_news?token="+this.$route.params.token, this.news)
            .then(()=>[
                this.$toast.success("News Create Success",{
                    type: "success",
                    duration: "3000",
                    dismisable: "true",
                    position: "top-right"
                }),
                this.$router.push({path: "/news/"+this.$route.params.token+"/"+this.$route.params.role})

            ])
            .catch((err)=>console.log(err))
      }
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