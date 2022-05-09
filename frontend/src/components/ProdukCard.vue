<template>
  <div class="produkcard">
    <div class="container">
      <div class="row row-cols-3">
        <div class="col mt-5" v-for="produk in produks" :key="produk.id">
          <div class="card" style="width: 18rem">
            <img 
            :src="path+ '/storage/'+produk.pathfoto" 
            class="card-img-top produk-img-size" 
            alt="" />
            <div class="card-body">
              <h5 class="card-title">{{produk.nama}}</h5>
              <p class="card-text" style="height: 100px;">
                {{ produk.deskripsi}}}
              </p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Harga : {{produk.harga}}</li>
              <li class="list-group-item">Stok : {{produk.stok}}</li>
            </ul>
            <div class="card-body">
              <router-link :to="'/produk_detail/'+produk.id+'/'+$route.params.token" class="card-link btn btn-success">Lihat Details</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "ProdukCard",
  data() {
    return {
      produks: [],
      path: "http://127.0.0.1:8000",
    };
  },
  methods: {
    getproduks() {
      axios
        .get(
          "http://127.0.0.1:8000/v1/produk?token=" + this.$route.params.token
        )
        .then((Response) => [
          console.log(Response.data),
          (this.produks = Response.data),
        ]);
    },
  },
  mounted() {
    this.getproduks();
  },
};
</script>

<style>
.produk-img-size {
  max-height: 200px;
}
</style>