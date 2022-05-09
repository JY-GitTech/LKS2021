<template>
  <div class="index">
    <div class="box-index">
        <h1>Login</h1>
        <input 
            type="text" 
            name="" 
            id="" 
            placeholder="Username"
            v-model="data.username"
            >
        <input 
            type="password" 
            name="" 
            id="" 
            placeholder="Password"
            v-model="data.password"
            >
        <button class="submit-btn" @click="sendlogin">Login</button>
        <span>Haven't Register? <router-link to="/register" class="register-btn">CLick Here</router-link></span>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "Index",
    data(){
        return{
            data: {}
        }
    },
    methods: {
        sendlogin(){
            axios
            .post("http://127.0.0.1:8000/v1/auth/login", this.data)
            .then((Response)=>[
                this.token = Response.data.token,
                this.role = Response.data.role,
                this.role == "admin" && this.$router.push({ path: "/produks/"+this.token+"/"+this.role}),
                this.role == "user" && this.$router.push({ path: "/home/"+this.token}),
            ])
            .catch(()=>
             this.role == null && this.$toast.error("User Error",{
                    type: "error",
                    position: "top-right",
                    duration: "3000",
                    dismissable: "true"
                })
            )
        }
    },
    mounted(){
    }
}
</script>

<style>
    .index{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        /* background-color: rgba(30,165,131,255); */
        background-image: url("../../../Images/logo1.jpeg");
        background-size: contain;
    }
    .box-index{
        width: 500px;
        height: 300px;
        border-radius: 20px;
        background-color: rgba(30, 165, 131, 0.900);
        box-shadow: 0 0 5px 1px gray;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .box-index h1{
        color: white;
        text-shadow: 0 0 5px rgba(30,165,131,255), 0 0 5px black;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }
    .box-index input{
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
    .box-index .submit-btn{
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
    .box-index .submit-btn:hover{
        background-color: rgb(25, 138, 110);
        color: white;
        transition-duration: 0.3s;
    }
    .box-index .register-btn{
        color: white;
    }
</style>