<template>
  <div class="register">
    <div class="box-register">
      <h1>Register</h1>
      <input
        type="text"
        name=""
        id=""
        placeholder="Username"
        v-model="data.username"
      />
      <input
        type="password"
        name=""
        id=""
        placeholder="Password"
        v-model="data.password"
      />
      <input
        type="password"
        name=""
        id=""
        placeholder="Confirm Password"
        v-model="confirmed"
      />
      <button @click="sendregister" class="submit-btn">Register</button>
      <span
        >Already Register?
        <router-link to="/" class="login-btn">Login Here</router-link></span
      >
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Index",
  data() {
    return {
      data: {},
      confirmed: null,
    };
  },
  methods: {
    sendregister() {
      if (this.data.password == this.confirmed) {
        axios
          .post("http://127.0.0.1:8000/v1/auth/register", this.data)
          .then((Response) => [
            (this.token = Response.data.token),
            (this.role = Response.data.role),
            this.role == "user" &&
              this.$router.push({ path: "/home/" + this.token }),
          ]);
      } else {
        this.$toast.error("Sukses Hapus Keranjang", {
          type: "error",
          position: "top-right",
          duration: 3000,
          dismissble: "true",
        });
      }
    },
  },
};
</script>

<style>
.register {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  /* background-color: rgba(30,165,131,255); */
  background-image: url("../../../Images/logo1.jpeg");
  background-size: contain;
}
.box-register {
  width: 500px;
  height: 400px;
  border-radius: 20px;
  background-color: rgba(30, 165, 131, 0.9);
  box-shadow: 0 0 5px 1px gray;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.box-register h1 {
  color: white;
  text-shadow: 0 0 5px rgba(30, 165, 131, 255), 0 0 5px black;
  margin-bottom: 20px;
  letter-spacing: 1px;
}
.box-register input {
  width: 80%;
  margin: 5px;
  padding: 10px;
  background-color: white;
  outline: none;
  border: 1px solid gray;
  font-size: 20px;
  border-radius: 20px;
  text-align: center;
}
.box-register .submit-btn {
  width: 80%;
  margin: 5px;
  padding: 10px;
  background-color: white;
  outline: none;
  border: 1px solid gray;
  font-size: 20px;
  border-radius: 20px;
  text-align: center;
  text-decoration: none;
  color: black;
}
.box-register .submit-btn:hover {
  background-color: rgb(25, 138, 110);
  color: white;
  transition-duration: 0.3s;
}
.box-register .login-btn {
  color: white;
}
</style>