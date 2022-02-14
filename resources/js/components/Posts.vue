<template>
    <div class="main-component flex flex-column">

        <div v-if="display_message" class="flex justify-center mx-[25%] py-4" :class="message_class">{{ display_message }}</div>

        <div class="flex flex-column" id="tasks">
            <div class="text-2xl text-black p-5 ">TASKS</div>
            <div class="top bg-white">
                <div class="output border-2 border-gray-200 max-h-[500px] overflow-scroll" >
                    <div v-if="posts">
                        <post-component v-for="(post, index) in posts" :key="index" v-bind:post="post" @edit="stagePost(post)" @delete="deletePost(post)"></post-component>
                    </div>
                </div>
            </div>
        </div>



    <div class="flex flex-column my-5">
        <h2 id="TaskForms" class="p-5 text-center text-2xl text-black">Task Forms</h2>
        <div class=" forms flex flex-column md:grid md:grid-cols-2 md:gap-2">

                <div class="flex justify-center">
                    <form class="lg:min-h-[500px] lg:min-w-[500px] p-2">
                        <div class="mb-5 flex">
                            <h2>Add Task</h2>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Title:</label><input type="text" v-model="new_post.title" name="title" placeholder="title" value="" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Body:</label><textarea name="body" v-model="new_post.body" placeholder="body" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required></textarea>
                        </div>
                        <div class="my-5 flex flex-column">
                            <button type="submit" class=" text-2xl p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" @click="addPost">Save</button>
                        </div>
                    </form>
                </div>

                <div class="flex justify-center">
                    <form class="md:min-h-[300px] md:min-w-[300px] lg:min-h-[500px] lg:min-w-[500px] p-2">
                        <div class="mb-5 flex">
                            <h2 id="EditForm">Edit Task</h2>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Title:</label><input type="text" v-model="edit_post.title" name="title" placeholder="title" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                        </div>
                        <div class="my-5 flex flex-column">
                            <label class="">Body:</label><textarea name="body" id="body" v-model="edit_post.body" rows="10" placeholder="body" class="px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required></textarea>
                        </div>
                        <div class="my-5 flex flex-column">
                            <button type="submit" class="text-2xl p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" @click="editPost">Update</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    </div>
</template>

<script>
import PostComponent from "./PostComponent.vue";
const Swal = require('sweetalert2')

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
                Swal.fire({ title: 'Error!', text: 'invalid entries', icon: 'error', confirmButtonText: 'Ok' })
                return
            }

            this.new_post.userId = Math.floor(Math.random() * 100);
            let URL = 'http://laravel-todo.appp/posts/add'
            axios.post(URL, this.new_post)
                .then((response) => {
                    console.log(response.data)
                    this.posts.unshift( response.data )
                }).then(() => {
                    Swal.fire({
                        title: 'Success!',
                        text: this.posts[0].title + ' added',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                 }).catch((err) => {
                     console.log("Error")
                     console.error('Error', err)
                    Swal.fire({ title: 'Error!', text: 'Something went wrong', icon: 'error', confirmButtonText: 'Ok' })
                }).then(() => {
                window.location ='#tasks'
            })
        },

        stagePost(p){
            this.edit_post.postId = p.id
            this.edit_post.title = p.title
            this.edit_post.body = p.body
            this.edit_post.userId = p.userId;
            // window.location ='#TaskForms'
            window.location ='#EditForm'
        },

        editPost(e){
            e.preventDefault();
            if( !this.validate(this.edit_post) ){
                Swal.fire({ title: 'Error!', text: 'invalid entries', icon: 'error', confirmButtonText: 'Ok' })
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
                    Swal.fire({ title: 'Success!', text: this.posts[0].title + 'added', icon: 'success', confirmButtonText: 'Ok' })
                }).catch((err) => {
                    Swal.fire({ title: 'Error!', text: 'Something went wrong', icon: 'error', confirmButtonText: 'Ok' })
                    console.log(err)
                })

                this.edit_post.title = ''
                this.edit_post.body = ''
                window.location ='#tasks'
                console.log('edited')
        },

        deletePost(p){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    let URL = 'http://laravel-todo.appp/posts/delete/'+p.id;
                    axios.get(URL)
                        .then((response)=> {
                            if(response.status == 200){
                                this.posts = this.posts.filter((post) => { return post.id != p.id; })
                                Swal.fire('Deleted!', 'Your post has been deleted.', 'success' )
                            } else {
                                Swal.fire({ title: 'Error!', text: 'Something went wrong', icon: 'error', confirmButtonText: 'Ok' })
                            }
                        }).then(() => {
                            console.log(this.posts);
                        }).catch((err) => {
                            console.error('Error', err)
                        })
                }
            })
        }
    }

}

</script>

<style>
.forms{

}
/*.main-component{*/
/*    display: flex;*/
/*    flex-direction: column;*/
/*    padding: 10px;*/
/*}*/

/*@media screen and (min-width: 800px) {*/
/*    .main-component{*/
/*        display: grid;*/
/*        grid-template-columns: 1fr 1fr;*/
/*    }*/
/*}*/

</style>
