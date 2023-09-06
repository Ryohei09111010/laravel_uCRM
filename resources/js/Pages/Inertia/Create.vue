<script setup>
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

// バリデーションでエラーがあった場合はerrorsの中にオブジェクトとして代入される
defineProps({
    errors: Object
})

// オブジェクトを操作するときはreactiveを指定する。
const form = reactive({
    title: null,
    content: null,
});

const submitFunction = () => {
    Inertia.post("/inertia", form);
};
</script>

<template>
    <!-- 自作したバリデーションコンポーネントにdefinePropsで指定したerrorを渡す -->
    <BreezeValidationErrors :errors="errors"/>
    <!-- @submit.preventとすると、送信ボタンを押下した際にページの読み込みが行われなくなる。 -->
    <!-- また""の中に送信ボタンを押下した際のイベントを指定することが出来る。 -->
    <form @submit.prevent="submitFunction">
        <!-- v-modelで指定したものはreactiveに指定したものがその場で反映される -->
        <p><input type="text" name="title" v-model="form.title" /></p>
        <div v-if="errors.title">{{ errors.title }}</div>
        <p><input type="text" name="content" v-model="form.content" /></p>
        <div v-if="errors.content">{{ errors.content }}</div>
        <p><button>送信</button></p>
    </form>
</template>
