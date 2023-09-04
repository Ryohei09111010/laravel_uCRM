<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue"; // リアクティブ
const newTitle = ref("");
const newContent = ref("");
</script>

<template>
    Inertiaテストです。<br />
    <a href="/">aタグ経由です</a><br />
    <Link href="/">Linkタグ経由です</Link><br />
    <Link :href="route('inertia.index')">名前付きルート</Link><br />
    <Link :href="route('inertia.show', { id: 1 })">リンクパラメータのテストです。</Link><br />

    <div class="mb-8"></div>
    <input type="text" name="newTitle" v-model="newTitle" /><br />
    <input type="text" name="newContent" v-model="newContent" /><br />
    <!-- asでbottonを指定する。 -->
    <Link
        as="botton"
        method="post"
        :href="route('inertia.store')"
        :data="{
            title: newTitle,
            content: newContent,
        }"
        >DB保存テスト</Link><br />
</template>
