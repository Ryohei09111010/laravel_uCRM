<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';

defineProps({
    // コントローラーでget()で取得した際は型がArrayになるが、paginateで取得した際はObject型になるので注意
    // customers: Array
    customers: Object
})

const search = ref("")

const searchCustomers = () => {
    // refの値を取得するには.valueまで指定する必要がある
    Inertia.get(route('customers.index', { search: search.value }))
}
</script>

<template>
    <Head title="顧客一覧" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <FlashMessage />
                                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                    <div>
                                        <input class="mr-4" type="text" name="search" v-model="search">
                                        <!-- クリックしたらsearchCustomersメソッドが実行される。 -->
                                        <button class="bg-indigo-500 text-white py-2 px-2" @click="searchCustomers">検索</button>
                                    </div>
                                    <Link as="button" :href="route('customers.create')" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">顧客登録</Link>
                                </div>
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="customer in customers.data" :key="customer.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3"><Link class="text-blue-400" :href="route('customers.show', { customer: customer.id })">{{ customer.id }}</Link></td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.name }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.kana }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.tel }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- コントローラからpaginateで渡ってきたObject内のLinkの中にある情報をPaginationコンポーネントに渡す -->
                                <Pagination class="mt-6 flex pl-14 my-4 lg:w-3/4 w-full mx-auto" :links="customers.links"></Pagination>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
