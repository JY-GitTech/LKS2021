<template>
  <div class="ProduksCreate">
    <Admin-navbar />
    <div class="container crud-form mt-5 mb-5">
        <h1 class="text-center">Create Produk</h1>
        <div class="form-group mt-5">
            <label for="Nama">Nama Produk :</label>
            <input 
            type="text"
            class="form-control"
            v-model="produks.nama"
            >
        </div>
        <div class="form-group">
            <label for="Harga">Harga :</label>
            <input 
            type="number"
            class="form-control"
            v-model="produks.harga"
            >
        </div>
        <div class="form-group">
            <label for="Stok">Stok :</label>
            <input 
            type="number"
            class="form-control"
            v-model="produks.stok"
            >
        </div>
        <div class="form-group">
            <label for="dekskripsi">Deskrispi Produk :</label>
           <textarea 
           name="" 
           id="" 
           cols="30" 
           rows="2"
           class="form-control"
           v-model="produks.deskripsi"
           ></textarea>
        </div>
        <div class="form-group">
            <label for="detail">Detail Produk :</label>
           <textarea 
           name="" 
           id="" 
           cols="30" 
           rows="5"
           class="form-control"
           v-model="produks.detailproduk"
           ></textarea>
        </div>
        <div class="form-group">
            <label for="pathfoto">Path Foto :</label>
            <input 
            type="file"
            class="form-control"
            @change="onfilechange"
            >
        </div>
        <button @click="createproduk" class="btn btn-success">Create</button>
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
          produks: {}
      }
  },
  methods: {
     onfilechange(e){
         this.produks.pathfoto = e.target.files[0];
     },
     createproduk(){
         const formdata = new FormData();
         formdata.append("nama", this.produks.nama);
         formdata.append("harga", this.produks.harga);
         formdata.append("stok", this.produks.stok);
         formdata.append("deskripsi", this.produks.deskripsi);
         formdata.append("detailproduk", this.produks.detailproduk);
         formdata.append("pathfoto", this.produks.pathfoto);
         let config = {
             header: {
                 "Content-type": "multipart/form-data",
             }
         };
         axios
         .post("http://127.0.0.1:8000/v1/kebunku?token="+this.$route.params.token,
         formdata, config)
         .then(()=>[
             this.$toast.success("Create Success", {
                 type: "success",
                 duration: "3000",
                 dismisable: "true",
                 position: "top-right"
             }),
             this.$router.push({path: "/produks/"+this.$route.params.token+"/"+this.$route.params.role})
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