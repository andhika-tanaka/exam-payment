<template>
  <Head title="Data User" />

  <div class="container">
    <div class="row">
      <h1 class="text-center">Data User</h1>
    </div>

    <div class="row justify-content-between">
      <div class="col-md-3">
        <Link :href="route('users.create')" class="btn btn-primary"
          >Add User</Link
        >
      </div>
      <div class="col-md-5">
        <form>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Search"
              name="search"
              v-model="search"
            />
            <button class="btn btn-outline-primary" type="submit">
              Search
            </button>
          </div>
        </form>

      </div>
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
          <tr v-for="user in users.data" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.job }}</td>
            <td>{{ user.dob }}</td>
            <td>{{ user.address }}</td>
            <td>
              <Link
                :href="'/users/' + user.id + '/edit'"
                class="btn btn-success"
                >Edit</Link
              >
              <button class="btn btn-danger" @click="deleteUser(user.id)">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      
      <pagination :links="users.links" />
    </div>
  </div>
</template>

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import Pagination from '@/Components/Pagination.vue'
import { Head, Link, InertiaLink } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default {
  layout: BreezeAuthenticatedLayout,

  components: {
    Head,
    Link,
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Pagination,
  },

  props: {
    users: Object,
  },

  data() {
    return {
      search: null,
    };
  },

  methods: {
    submit() {
      this.search.get(this.route("users.index", search));
    },

    deleteUser(id) {
      axios.delete(`/users/${id}`).then((response) => {
        let i = this.users.map((data) => id).indexOf(id);
        this.users.splice(i, 1);
      });
    },
  },
};
</script>