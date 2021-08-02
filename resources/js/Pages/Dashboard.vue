<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-200 text-green-500 p-3 alert" v-if="$page.props.flash.success">
                    {{ $page.props.flash.success }}
                </div>
            <div class="w-full">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Titre de la formation
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text"
                 v-model="form.title">
                </div>
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description de la formation
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                leading-tight focus:outline-none focus:shadow-outline" id="description" type="text"  
                v-model="form.description"></textarea>
                </div>
                <div class="mb-4">
                    <h2 class="text-2xl"> Episodes de la formation</h2>
                    <div v-for="(episode, index) in form.episodes" v-bind:key="index">

                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-'
                        +index">
                            Titre de l'épisode n° {{ index + 1 }}
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        :id="'title-'+index" type="text"
                        v-model="form.episodes[index].title">

                        .bg-red-600



                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-'
                        +index">
                            Description de l'épisode n° {{ index + 1 }}
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        :id="'description-'+index" type="text"
                        v-model="form.episodes[index].description">

                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'video_url-'
                        +index">
                            URL de la vidéo de l'épisode n° {{ index + 1 }}
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" 
                        :id="'video_url-'+index" type="text"
                        v-model="form.episodes[index].video_url">

                    </div>
                </div>
                <button class="bg-green-600 rounded py-2 px-4 my-2 text-white block" v-if="form.episodes.length < 50" @click.prevent="add">+</button>

                <button class="bg-red-600 rounded py-2 px-4 my-2 text-white block" v-if="form.episodes.length > 1" @click.prevent="remove">🗑️</button>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Créer ma formation
                </button>
           
            </form>
            </div>
            </div>
        </div>
    </app-layout>
</template>



<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia3'    
    export default {
        props: {
            errors: Object,
        },
        components: {
            AppLayout,
        },

        setup () {
          const form = reactive({
            title: null,
            description: null,
            episodes: [
                {title: null, description: null, video_url: null}
            ]
         })

          function submit() {
            Inertia.post('/courses', form)
          }
          function add() {
              this.form.episodes.push({title: null, description: null, video_url: null})
          }
          function remove() {
              this.form.episodes.pop()
          }
          

          return { form, submit , add, remove}
  },
    }
</script>
