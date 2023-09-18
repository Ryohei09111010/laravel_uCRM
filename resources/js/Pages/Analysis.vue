<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, reactive, ref, computed } from "vue";
import { getToday } from '@/common' // 別ファイルをインポート
import dayjs from 'dayjs'
// グラフを表示するためのコンポネント
import Chart from '@/Components/Chart.vue'

// リアクティブな変数にする
const data = reactive({})

// 非同期通信を使用するときはasyncを使用する
const getData = async () => {
    try {
        // この処理が終わるまで次の処理を行わない
        // getでURLにデータを送信する
        await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type
            }
        })
            // ここで/api/analysis/送信し返ってきたレスポンスを取得する
            .then(res => {
                data.data = res.data.data
                data.labels = res.data.labels
                data.totals = res.data.totals
            })
    } catch (e) {
        console.log(e.message)
    }
}


// 入力フォームで変更されたものが入る
onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})
const form = reactive({ startDate: null, endDate: null, type: 'perDay' })
</script>

<template>
    <Head title="データ分析" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="getData"> From:<input type="date" name="startDate" v-model="form.startDate"> To:<input type="date" name="endDate" v-model="form.endDate">
                            <p><button type="" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">分析する</button></p>
                        </form>
                        <div v-show="data.data">
                            <Chart :data ="data"/>
                        </div>
                        <div v-if="data.data" class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">年月日</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in data.data" :key="item.data">
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ dayjs(item.date).format('YYYY年MM月DD日') }}</td>
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.total.toLocaleString() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
