<template>
   <b-navbar toggleable type="dark" class="navbar-color">
       <div class="container">
           <b-navbar-brand href="#">Kebunku</b-navbar-brand>

    <b-navbar-toggle target="navbar-toggle-collapse"  class="toggle-color">
      <template #default="{ expanded }">
        <b-icon v-if="expanded" icon="chevron-bar-up"></b-icon>
        <b-icon v-else icon="chevron-bar-down" ></b-icon>
      </template>
    </b-navbar-toggle>

    <b-collapse id="navbar-toggle-collapse" is-nav>
      <b-navbar-nav class="ml-auto">
       <router-link :to='"/home/"+this.$route.params.token' class="btn nav-btn">
            <span class="nav-text">Home</span>
       </router-link>
       <router-link :to='"/produk/"+this.$route.params.token' class="btn nav-btn">
            <span class="nav-text">Produk</span>
       </router-link>
       <router-link :to='"/chart/"+this.$route.params.token' class="btn nav-btn">
            <span class="nav-text">Chart</span>
       </router-link>
      <hr>
       <button @click="sendlogout" class="btn nav-btn">
            <span class="nav-text">Logout</span>
       </button>
      </b-navbar-nav>
    </b-collapse>
       </div>
  </b-navbar>
</template>

<script>
import axios from 'axios'
export default {
    name: 'UserNavbar',
    methods: {
      sendlogout(){
        axios
        .get("http://127.0.0.1:8000/v1/auth/logout?token="+this.$route.params.token)
        .then(()=>[
          this.$toast.success("Logout Success",{
            type: "success",
            duration: "3000",
            position: "top-right",
            dismissable: "true"
          }),
          this.$router.push({path: "/"})
        ])
      }
    }
}
</script>

<style>
  .navbar-color{
    background-color: rgba(30, 165, 131, 0.900);
  }
  .toggle-color:hover{
    border: 1px solid lightgray;
    /* box-shadow: 0 0 5px 2px lightgray; */
    color: white;
  }
  .toggle-color:focus{
    color: white;
  }
  .nav-btn{
      text-decoration: none;
      color: white;
  }
  .nav-btn:hover{
    text-decoration: none;
    color: white;
    border: 1px solid white;
  }
  .nav-text{
    color: white;
  }
  hr{
    color: white;
  }
</style>