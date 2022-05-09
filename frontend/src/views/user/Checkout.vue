<template>
  <div class="checkout">
      <div class="container img-container">
          <img src="../../assets/success.png" class=" checkout-img" />
          <router-link :to="'/home/'+$route.params.token" class="btn btn-success">Back To Home</router-link>
      </div>
  </div>
</template>

<script>
export default {
    
}
</script>

<style>
.img-container{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.checkout-img{
    height: 80vh;
}
</style>