<template>
    <Head title="Add User" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="product" value="Product" />
            <BreezeInput id="product" type="text" class="mt-1 block w-full" v-model="form.product" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="qty" value="qty" />
            <BreezeInput id="qty" type="number" class="mt-1 block w-full" v-model="form.qty" required autocomplete="qty" />
        </div>

        <div>
            <BreezeLabel for="price" value="Price" />
            <BreezeInput id="price" type="number" class="mt-1 block w-full" v-model="form.price" required autocomplete="price" />
        </div>

        <div>
            <BreezeLabel for="description" value="Description" />
            <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autocomplete="description" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Add Data
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

    data() {
        return {
            form: this.$inertia.form({
                product: '',
                qty: '',
                price: '',
                description: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('payments'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>