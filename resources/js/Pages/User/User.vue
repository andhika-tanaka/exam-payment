<template>
  <Head title="Data User" />

  <div class="container">
      <div class="row">
            <h1 class="text-center">Data User</h1>
      </div>
      
      <div class="row">
          <Link :href="route('users.create')" class="btn btn-primary">Add User</Link>
      </div>
      <div class="row">
        <table class="table-responsive-md table-striped">
        <thead>
          <tr> 
            <th>Name</th>
            <th>E-mail</th>
            <th>Job</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>  
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.job }}</td>
            <td>{{ user.dob }}</td>
            <td>{{ user.address }}</td>
            <td>
              <Link :href="'/users/' + user.id + '/edit'" class="btn btn-success">Edit</Link>
              <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
            </td>
          </tr>  
        </tbody>
      </table>
      </div>
  </div>
</template>

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from 'axios';

export default {
  layout: BreezeAuthenticatedLayout,

  components: {
    Head,
    Link,
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
  },

  props:
      ['users'],

  methods: {
      deleteUser(id) { 
                axios
                    .delete(`/users/${id}`)
                    .then(response => {
                        let i = this.users.map(data => id).indexOf(id);
                        this.users.splice(i, 1)
                    });
            }
  }
};
</script>