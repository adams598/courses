<template>
    <app-layout>
        <template #header>
            Liste des formations
        </template>
        <div class="py-3" v-for="course in this.courseList" v-bind:key="course.id">
            <div class="mx-8 bg-white rounded shadow p-4">
              <div class="text-sm text-gray-500">Mise en ligne par {{ course.user.name }} - <span
              class="text-gray-500 text-sm">{{ course.participants }} participant<span v-if="parseInt
              (course.participants) > 1 ">s</span>
              </span>
              </div>
              <div class="flex justify-between items-center rounded">
                  <div class="text-4xl">{{ course.title }}</div>
                  <div class="text-sm text-gray-400"> {{ course.episodes_count }} </div>
              </div>
              <div class="text-sm text-gray-500">{{ course.description }}</div>

              <div class="flex items-center justify-between rounded">
                <a :href="'course/' + course.id" class="bg-indigo-500 text-white px-2 py-1
                text-sm mt-3 inline-block rounded hover:bg-indigo-700">Voir la formation</a>
                <a :href="'courses/edit/' + course.id" class="bg-gray-500 text-white px-2 py-1 
                text-sm mt-3 inline-block rounded hover:bg-gray-700">Modifier la formation</a>
              </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
export default {
    components: {
        AppLayout
    },

    data() {
        return {
            courseList: this.courses
        }
    },

    props: ['courses'],

    mounted() {
        console.log(this.coursesList);
    }
}
</script>