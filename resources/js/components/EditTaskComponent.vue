<template>

</template>

<script>
export default {
    name: "EditTaskComponent",
    data(){
        return {
            edit_post: {
                postId: null,
                title:'',
                body:'',
                userId: null
            },
        }
    },
    methods: {
        emitEdit(){
            this.$emit(edit);
        }
    }
}
</script>

<style>

</style>
