<template>
  <div class="produks">
    <AdminNavbar />
    <div class="container mt-5">
      <router-link
        :to="
          '/create-produks/' +
          this.$route.params.token +
          '/' +
          this.$route.params.role
        "
        class="btn btn-success"
        >Create Product</router-link
      >
    </div>
    <div class="container mt-3">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">No</th>
            <th class="text-center" scope="col">Nama Produk</th>
            <th class="text-center" scope="col">Harga</th>
            <th class="text-center" scope="col">Stok</th>
            <th class="text-center" scope="col">Deskrispi</th>
            <th class="text-center" scope="col">Detail</th>
            <th class="text-center" scope="col">Pathfoto</th>
            <th colspan="2" scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(produk, index) in produkdata"
            :key="produk.id"
            class="mt-2"
          >
            <th class="text-center" scope="row">{{ index + 1 }}</th>
            <td class="text-center">{{ produk.nama }}</td>
            <td class="text-center">Rp. {{ produk.harga }}</td>
            <td class="text-center">{{ produk.stok }}</td>
            <td class="text-center">{{ produk.deskripsi }}</td>
            <td class="text-center">{{ produk.detailproduk }}</td>
            <td class="text-center">
              <img
                :src="path + '/storage/' + produk.pathfoto"
                class="admin-img-size"
              />
            </td>
            <td class="text-center">
              <router-link :to="'/edit-produks/'+produk.id+'/'+ $route.params.token+'/'+$route.params.role" 
              class="btn btn-primary action-btn">Edit</router-link>
            </td>
            <td class="text-center">
              <button
                @click="deleteproduk(produk.id)"
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
import axios from "axios";
import AdminNavbar from "../../components/AdminNavbar.vue";
export default {
  name: "Produks",
  components: {
    AdminNavbar,
  },
  data() {
    return {
      produkdata: [],
      path: "http://127.0.0.1:8000",
    };
  },
  methods: {
    getprodukdata() {
      axios
        .get(
          "http://127.0.0.1:8000/v1/kebunku?token=" + this.$route.params.token
        )
        .then((Response) => [
          (this.produkdata = Response.data),
          console.log(this.produkdata),
        ]);
    },
    deleteproduk(id) {
      axios
        .delete(
          "http://127.0.0.1:8000/v1/kebunku/" +
            id +
            "?token=" +
            this.$route.params.token
        )
        .then(() => [
          axios
            .get(
              "http://127.0.0.1:8000/v1/kebunku?token=" +
                this.$route.params.token
            )
            .then((Response) => [
              (this.produkdata = Response.data),
              console.log(this.produkdata),
            ]),
          this.$toast.danger("Produk Deleted", {
            type: "danger",
            duration: "3000",
            position: "top-right",
            dismisable: "true",
          }),
        ]);
    },
  },
  mounted() {
    this.getprodukdata();
  },
};
</script>

<style>
.action-btn {
  width: 70px;
}
.admin-img-size {
  max-width: 200px;
  max-height: 200px;
}
tr {
  border: none;
}
</style>