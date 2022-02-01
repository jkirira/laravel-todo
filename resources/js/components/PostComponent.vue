<template>
    <div class="border border-gray-200 rounded-1 p-7">
        <p>Id: {{post.id}} </p>
        <p>Title: {{post.title}}</p>
        <p>Body: {{post.body}}</p>
        <button class="bg-green-100 p-3 rounded-md hover:bg-green-300" @click="editClick">Edit</button>
        <button class="bg-red-100 p-3 rounded-md hover:bg-red-300" @click="deleteClick">Delete</button>
    </div>
</template>

<script>

export default {
    name: 'PostComponent',
    props: ['post'],

    methods:{
        editClick(){
            this.$emit('edit');
        },
        deleteClick(){
            this.$emit('delete');
        }
    }
}
</script>

<style>

</style>
