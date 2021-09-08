<template>
    <Head title="Edit User" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div>
            <BreezeLabel for="job" value="Job" />
            <BreezeInput id="job" type="text" class="mt-1 block w-full" v-model="form.job" required autocomplete="job" />
        </div>

        <div>
            <BreezeLabel for="dob" value="Dob" />
            <BreezeInput id="dob" type="date" class="mt-1 block w-full" v-model="form.dob" required autocomplete="dob" />
        </div>

        <div>
            <BreezeLabel for="address" value="Address" />
            <BreezeInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autocomplete="address" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Update Data
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: ['user'],

    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                job: this.user.job,
                dob: this.user.dob,
                address: this.user.address,
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.put(this.route('users.update', this.user.id))
        }
    }
}
</script>