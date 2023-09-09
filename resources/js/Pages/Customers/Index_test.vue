<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'

defineProps({
    // コントローラーでget()で取得した際は型がArrayになるが、paginateで取得した際はObject型になるので注意
    // customers: Array
    customers: Object
})
</script>

<template>
    <!-- Inertiaでのページネーションの機能はObject型になっているのでcustomers.dataの中にデータが入っている。 -->
    <ul v-for="customer in customers.data" :key="customer.id">
        <li>{{ customer.id }}</li>
        <li>{{ customer.name }}</li>
    </ul>
    <Pagination class="mt-6" :links="customers.links"></Pagination>
</template>
