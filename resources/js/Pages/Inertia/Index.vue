<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    blogs: Array,
});
</script>

<template>
    <!-- 登録が成功したらセッションに保存されたメッセージを表示する -->
    <div v-if="$page.props.flash.message" class="bg-blue-300">
        {{ $page.props.flash.message }}
    </div>
    <ul>
        <!-- 繰り返し処理の際は、単数形 in 複数形と記述する。またお作法でkeyを指定する -->
        <li v-for="blog in blogs" :key="blog.id">
            件名：<Link
                class="text-blue-400"
                :href="route('inertia.show', { id: blog.id })"
                >{{ blog.title }}</Link>
            本文：{{ blog.content }}
            <br />
        </li>
    </ul>
</template>
