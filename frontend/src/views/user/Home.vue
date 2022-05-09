<template>
  <div class="home">
    <UserNavbar />
    <div class="container logo-kebunku-container">
      <img src="../../assets/logo2.png" alt="" class="logo-kebunku" />
    </div>
    <div class="container mb-5">
      <h1 class="text-center">Promotion</h1>
    </div>
    <div class="container">
      <div class="container">
        <div class="row row-cols-2">
          <div class="col" v-for="news in newsdata" :key="news.id">
            <div class="card">
              <h5 class="card-header">Expired : {{ news.tanggal }}</h5>
              <div class="card-body">
                <h5 class="card-title">{{ news.judul }}</h5>
                <p class="card-text">
                  {{ news.konten }}
                </p>
                <router-link :to="'/produk/'+$route.params.token" class="btn btn-success">Go To Produk</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Contact />
  </div>
</template>

<script>
import UserNavbar from "../../components/UserNavbar.vue";
import Contact from "../../components/Contact.vue";
import axios from 'axios';
export default {
  name: "Home",
  components: {
    UserNavbar,
    Contact,
  },
  data(){
    return{
      newsdata: [],
    }
  },
  methods: {
    getnews(){
      axios
      .get("http://127.0.0.1:8000/v1/news?token="+this.$route.params.token)
      .then((Response)=>[
        // console.log(Response.data),
        this.newsdata = Response.data
      ])
    },
  },
  mounted(){
    this.getnews();
  }
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
}
.logo-kebunku-container {
  display: flex;
  justify-content: center;
  width: 100%;
  height: auto;
  margin-top: -5%;
}
.logo-kebunku {
  width: 800px;
  height: 800px;
}
@media (max-width: 1000px) {
  .logo-kebunku-container {
    margin-top: -15%;
  }
}
@media (max-width: 800px) {
  .logo-kebunku-container {
    margin-top: -20%;
  }
}
@media (max-width: 600px) {
  .logo-kebunku {
    width: 500px;
    height: 500px;
  }
}
@media (max-width: 370px) {
  .logo-kebunku {
    width: 400px;
    height: 400px;
  }
}
</style>