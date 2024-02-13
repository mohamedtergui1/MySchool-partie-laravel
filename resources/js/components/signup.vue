

<template>
     <div class="container">
    <div>
      <div class="mb-3">
        <label for="exampleInputfullname1" class="form-label">fullname address</label>
        <input type="text" class="form-control" id="exampleInputfullname1" aria-describedby="fullnameHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" v-model= "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div>{{ email }}</div>
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
      <button type="submit" @click="register" class="btn btn-primary">Submit</button>
    </div>
  </div>
</template>
<script>
import axios from 'axios';  

export default {
  data() {
    return {
      user: {
        id:'',
        name: '',
        email: '',
        password: ''
      },
      errorMessage: '', // New property to store error message
      successMessage: '' // New property to store success message
    };
  },
  methods: {
    register() {
      var nameInput = document.getElementById('exampleInputfullname1').value;
      var emailInput = document.getElementById('exampleInputEmail1').value;
      var passwordInput = document.getElementById('exampleInputPassword1').value;
        
         this.user.name =nameInput;
          this.user.email = emailInput;
          this.user.password = passwordInput;
          console.log(this.user)
      axios.post('/api/register', this.user)
        .then(response => {
          // Assuming your backend sends messages in the response
          if (response.data.success) {
           console.log( response.data.success);
            
          }
          
          this.user.name = '';
          this.user.email = '';
          this.user.password = '';
        })
        .catch(error => {
          console.error('Error registering user:', error);
          this.errorMessage = 'An error occurred during registration.';
          this.successMessage = ''; // Clear success message
        });
    }
  }
}
</script>

