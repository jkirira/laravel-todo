<template>
    <div class="main-component">

        <div class="left max-h-[700px] ">
            <div>
                <form>
                    <input type="text" name="search" id="search" placeholder="search" value="" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                    <button type="submit" class="p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" v-bind="search_tag" @click="findPost">Search</button>
                </form>
            </div>

            <div class="output border-2 border-gray-200 max-h-[500px] overflow-scroll mt-4" >
                <div v-if="posts">
                    <post-component v-for="(post, index) in posts" :key="index" v-bind:post="post" @edit="stagePost(post)" @delete="deletePost(post)"></post-component>
                </div>
            </div>
        </div>




        <div class="h-[700px] flex justify-center ">

            <div v-if="display_message" class="flex justify-center mx-[25%] py-4" :class="message_class">{{ display_message }}</div>

            <div class=" w-[500px] flex overflow-scroll">
                <div class="flex justify-center w-screen">
                    <form class="min-h-[500px] min-w-[500px] p-2">
                        <div class="my-5 flex">
                            <h2>Add Task</h2>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Title:</label><input type="text" v-model="new_post.title" name="title" placeholder="title" value="" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Body:</label><textarea name="body" v-model="new_post.body" placeholder="body" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required></textarea>
                        </div>
                        <div class="my-5 flex flex-column">
                            <button type="submit" class="p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" @click="addPost">Add</button>
                        </div>
                    </form>
                </div>

                <div class="flex justify-center w-screen">
                    <form class="min-h-[500px] min-w-[500px] p-2">
                        <div class="my-5 flex">
                            <h2>Edit Task</h2>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Title:</label><input type="text" v-model="edit_post.title" name="title" placeholder="title" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Body:</label><textarea name="body" id="body" v-model="edit_post.body" rows="10" placeholder="body" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required></textarea>
                        </div>
                        <div class="my-5 flex flex-column">
                            <button type="submit" class="p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" @click="editPost">Edit</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
import PostComponent from "./PostComponent.vue";
import axios from 'axios';
export default {
    name: "Posts",
    components: {
        PostComponent,
    },

    data(){
       return{
            posts: null,
            new_post: {
                title: '',
                body:'',
                userId: null
            },
            edit_post: {
                postId: null,
                title:'',
                body:'',
                userId: null
            },
            search_tag: '',
            display_message: null,
            message_class: null,

       }
    },
    mounted() {
        console.log('Component mounted.')
        let URL = 'http://laravel-todo.appp/posts/get'

        axios.get(URL)
            .then((response)=> {
                this.posts = response.data
                console.log(this.posts)
            }).catch((err) => {
                console.error('Error', err)
            })
    },

    methods: {

        validate(post){
            if( !post.title || !post.body ){
                this.display_message = "Cannot send empty values"
                this.message_class = "bg-red-200 text-white"
                return false;
            }
            return true;
        },

        addPost(e){
            e.preventDefault();
            if( !this.validate(this.new_post) ){
                return
            }

            this.new_post.userId = Math.floor(Math.random() * 100);
            let URL = 'http://laravel-todo.appp/posts/add'
            axios.post(URL, this.new_post)
                .then((response) => {
                    console.log(response.data)
                    this.posts.unshift( response.data )
                }).then(() => {
                    this.display_message = "Success"
                    this.message_class = "bg-green-200 text-white"
                 }).catch((err) => {
                     console.log("Error")
                     console.error('Error', err)
                })
        },

        findPost(e){
            e.preventDefault();
            if( !this.search_tag ){
                this.display_message = "Cannot send empty values"
                this.message_class = "bg-red-200 text-white"
                return;
            }

            let URL = 'http://laravel-todo.appp/posts/' + search_tag
            axios.post(URL, this.new_post)
                .then((response) => {
                    console.log(response.data)
                    this.posts.unshift( response.data )
                }).then(() => {
                    this.display_message = "Success"
                    this.message_class = "bg-green-200 text-white"
                }).catch((err) => {
                    this.display_message = "Error: "+ err
                    this.message_class = "bg-green-200 text-white"
                    console.log("Error")
                    console.error('Error', err)
                })
        },

        stagePost(p){
            this.edit_post.postId = p.id
            this.edit_post.title = p.title
            this.edit_post.body = p.body
            this.edit_post.userId = p.userId;
        },

        editPost(e){
            e.preventDefault();
            if( !this.validate(this.edit_post) ){
                return
            }

            let URL = 'http://laravel-todo.appp/posts/edit'
            axios.post(URL, this.edit_post)
                .then((response)=> {
                    console.log(this.posts)
                    this.posts = this.posts.filter((post) => {
                        return post.id != response.data.id
                    })
                    this.posts.unshift( response.data)
                }).then(() => {
                    this.display_message = "Success"
                    this.message_class = "bg-green-200 text-white"
                }).catch((err) => {
                    console.error('Error', err)
                })
        },

        deletePost(p){
            let URL = 'http://laravel-todo.appp/posts/delete/'+p.id;
            axios.get(URL)
                .then((response)=> {
                    if(response.status == 200){
                        this.display_message = "success"
                        this.message_class = "bg-green-200"
                        this.posts = this.posts.filter((post) => {
                            return post.id != p.id;
                        })
                    } else {
                        this.display_message = "error"
                        this.message_class = "bg-red-200"
                    }
                    console.log(this.posts)
                }).catch((err) => {
                    console.error('Error', err)
                })
        }
    }

}

</script>

<style>
.main-component{
    display: flex;
    flex-direction: column;
    padding: 10px;
}

@media screen and (min-width: 800px) {
    .main-component{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
}

</style>
