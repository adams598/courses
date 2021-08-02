<template>
    <div>
        <div class="bg-gray-200 w-full">
            <div class="bg-green-500 text-white rounded text-center transition-width duration-500" :style="'width:' + percentage + '%'"> {{percentage}}%</div>
        </div>
    </div>
</template>

<script>
// import { eventBus } from '../../app.js';
export default {
    props: ['watchedEpisodes', 'episodes'],

    data() {
        return {
            watchedEpisodesData: this.watchedEpisodes
        }
    },

    computed: {
        percentage() {
            let filteredEp = this.episodes.filter(courseEp => {
                return this.watchedEpisodesData.find(watchedEp => {
                    return watchedEp.id === courseEp.id;
                });
            });

            return Math.ceil(filteredEp.length / this.episodes.length * 100);
        }
    },

    mounted() {
      //  this.eventBus.on('toggleProgress', data => this.watchedEpisodesData = data);
    },
}
</script>