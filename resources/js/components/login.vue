
<template>
    <div class="container" >  
        
      <div>
        <div id="alert"  class="alert alert-success  d-none " role="alert">
 
</div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button  @click="login()" type="submit" class="btn btn-primary">Submit</button>
</div>
         </div>
</template>


<script  >
      import axios from 'axios';  

export default {
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      errorMessage: '',  
      successMessage: ''  
    };
  },
  methods: {
    login() {
  var emailInput = document.getElementById('exampleInputEmail1').value;
  var passwordInput = document.getElementById('exampleInputPassword1').value;

  var button = $(this);  

  this.user.email = emailInput;
  this.user.password = passwordInput;

  button.prop('disabled', true); 

  axios.post('/api/login', this.user)
    .then(response => {
      $("#alert").removeClass("d-none");
      if (response.data.error) {
        $("#alert").removeClass("alert-success").addClass("alert-danger").html(response.data.error);
      }else
      if (response.data.success) {
       
        $("#alert").removeClass("alert-danger").addClass("alert-success").html(response.data.success);
      } 
    })
    .catch(error => {
      console.error('Error logging in:', error);
      $("#alert").removeClass("d-none").addClass("alert-danger").html('An error occurred during login.');
    })
    .finally(() => {
      button.prop('disabled', false);  
    });
}

  }
}
</script>