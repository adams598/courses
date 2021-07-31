<template>
    <div>
        progressBar
    </div>
</template>

<script>
export default {
    props: ['watchedEpisodes', 'episodes'],

    mounted() {
        console.log(this.watchedEpisodes, this.episodes);
    },
}
</script>