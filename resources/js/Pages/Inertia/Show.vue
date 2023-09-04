<script setup>
import { Inertia } from "@inertiajs/inertia";

// コントローラーから渡ってきた変数はここで型を定義する必要がある
defineProps({
    id: String,
    blog: Object
})

// jsのアロー関数で引数が１つの時は(id)のかっこを省略できる
const deleteConfirm = id => {
    // Inertiaのdeleteを使用する。第一引数に``でURLを指定し、第二引数に確認をするためのonBeforeを使用する
    Inertia.delete(`/inertia/${id}`, {
    onBefore: () => confirm('本当に削除しますか？')
})
}
</script>

<template>
    {{ id }}<br>
    {{ blog.title }}<br>
    <!-- クリックした際にメソッドが実行されるようにする -->
    <button @click="deleteConfirm(blog.id)">削除</button>
</template>
