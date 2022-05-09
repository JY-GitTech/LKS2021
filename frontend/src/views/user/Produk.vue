<template>
  <div class="produk">
    <UserNavbar />
    <div class="container search-bar">
      <div class="row mt-3">
        <div class="col">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Cari Makanan Kesukaan Anda"
              aria-label="Cari "
              aria-describedby="basic-addon1"
            />
            <!-- @keyup="searchProduk" -->
            <!-- v-model="search" -->
            <span class="input-group-text search-color" id="basic-addon1">
              <b-icon-search variant="success"></b-icon-search>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <Produk-card />
    </div>
    <Contact />
  </div>
</template>

<script>
import UserNavbar from "../../components/UserNavbar.vue";
import ProdukCard from "../../components/ProdukCard.vue";
import Contact from "../../components/Contact.vue";

export default {
  name: "Produk",
  components: {
    UserNavbar,
    ProdukCard,
    Contact,
  },
};
</script>

<style>
.search-bar {
  margin-top: 20px;
  margin-bottom: 5px;
}
.card {
  margin-bottom: 20px;
}
</style>