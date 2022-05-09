<template>
  <div class="ProdukDetail">
    <UserNavbar />
    <div class="container mt-5">
      <div class="pd-container">
        <div class="img-container">
          <img
            :src="path + '/storage/' + produkdetail.pathfoto"
            class="produkdetail-img-size"
            alt=""
          />
        </div>
        <div class="items-container">
          <div class="card-body">
            <h5 class="card-title">{{ produkdetail.nama }}</h5>
            <p class="card-text">
              {{ produkdetail.deskripsi }}
            </p>
            <p class="card-text">
             {{ produkdetail.detailproduk}}
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Harga : {{ produkdetail.harga }}</li>
            <li class="list-group-item">Stok : {{ produkdetail.stok }}</li>
            <li class="list-group-item">
              <input 
              type="number" 
              class="form-control mb-2"
              v-model="qty"
              placeholder="Jumlah Yang Dipesan"
              />
              <button class="btn btn-success button-long" @click="tambahkeranjang()">Tambahkan Ke Keranjang</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <Contact />
  </div>
</template>

<script>
import axios from "axios";
import UserNavbar from "../../components/UserNavbar.vue";
import Contact from "../../components/Contact.vue";
export default {
  name: "ProdukDetail",
  components: {
    UserNavbar,
    Contact,
  },
  data() {
    return {
      produkdetail: {},
      path: "http://127.0.0.1:8000",
      qty: 0
    };
  },
  methods: {
    getprodukdetail() {
      axios
        .get(
          "http://127.0.0.1:8000/v1/produk/" +
            this.$route.params.id +
            "?token=" +
            this.$route.params.token
        )
        .then((Response) => [
          (this.produkdetail = Response.data),
        ]);
    },
    tambahkeranjang(){
      axios
      .post("http://127.0.0.1:8000/v1/chart/"+this.$route.params.id+"?token="
      +this.$route.params.token, {qty: this.qty})
      .then(()=>this.$router.push({path: "/chart/"+this.$route.params.token}))
    }
  },
  mounted() {
    this.getprodukdetail();
  },
};
</script>

<style>
.pd-container {
  display: flex;
  justify-content: center;
  align-items: center;
  /* background-color: green; */
  width: 100%;
  height: 70vh;
  flex-direction: row;
}
.pd-container .img-container {
  width: 50%;
  /* background-color: blue; */
  height: 100%;
}
.pd-container .items-container {
  width: 50%;
  /* background-color: yellow; */
  height: 100%;
}
.produkdetail-img-size {
  width: 100%;
  height: 100%;
}
.button-long{
  width: 100%;
}
</style>