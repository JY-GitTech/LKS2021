<template>
  <div class="chart">
    <UserNavbar />
    <div class="container">
      <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Harga Satuan</th>
            <th scope="col">Jumlah Yang Dipesan</th>
            <th scope="col">Total</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, index) in chartdatas" :key="data.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ data.produk[0].nama }}</td>
            <td>Rp. {{ data.produk[0].harga }}</td>
            <td>{{ data.qty }}</td>
            <td>{{ data.total_harga }}</td>
            <td>
              <button class="btn btn-danger" @click="deleteproduk(data.id)">
                Delete
              </button>
            </td>
          </tr>
          <tr>
            <strong>Harga Total : {{ totalHarga }}</strong>
          </tr>
        </tbody>
      </table>
      <div>
        <b-button
          id="show-btn"
          @click="showModal"
          class="btn btn-success button-long"
          >Check Out</b-button
        >
        <b-modal ref="my-modal" hide-footer title="Check Out">
          <div class="d-block text-center mb-3">
            <h4>Apakah Ingin Melakukan Checkout?</h4>
          </div>
          <b-button
            class="mt-2"
            variant="outline-success"
            block
            @click="checkout"
            >YA</b-button
          >
          <b-button
            class="mt-3"
            variant="outline-danger"
            block
            @click="hideModal"
            >TIDAK</b-button
          >
        </b-modal>
      </div>
    </div>
    <Contact />
  </div>
</template>

<script>
import Contact from "../../components/Contact.vue";
import UserNavbar from "../../components/UserNavbar.vue";
import axios from "axios";
export default {
  name: "Chart",
  components: {
    UserNavbar,
    Contact,
  },
  data() {
    return {
      chartdatas: [],
      token: {},
    };
  },
  methods: {
    getchartdata() {
      axios
        .get("http://127.0.0.1:8000/v1/chart?token=" + this.$route.params.token)
        .then((Response) => [
          console.log(Response.data),
          (this.chartdatas = Response.data),
        ]);
    },
    deleteproduk(id) {
      axios
        .delete(
          "http://127.0.0.1:8000/v1/chart/" +
            id +
            "?token=" +
            this.$route.params.token
        )
        .then(() => [
          axios
            .get(
              "http://127.0.0.1:8000/v1/chart?token=" + this.$route.params.token
            )
            .then((Response) => [
              (this.chartdatas = Response.data),
              (this.hargasatuan = Response.data[0].harga),
              (this.qty = Response.data[0].qty),
            ]),
        ]);
    },
    showModal() {
      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
    },
    checkout() {
      axios
        .delete(
          "http://127.0.0.1:8000/v1/deletechart?token=" +
            this.$route.params.token
        )
        .then(() =>
          this.$router.push({ path: "/checkout/" + this.$route.params.token })
        );
    },
  },
  mounted() {
    this.getchartdata();
  },
  computed: {
    totalHarga() {
      return this.chartdatas.reduce(function (items, data) {
        return items + data.total_harga;
      }, 0);
    },
  },
};
</script>

<style>
.modal-checkout {
  font-size: 15px;
}
</style>