<script setup>
    const props = defineProps({
        player: {
            type: Object,
            required: true,
        }
    })
</script>

<template>
    <section>
        <div class="circle">
            {{ player.shirt_number }}
        </div>
        <small>
            {{ player.name }}
        </small>
    </section>
</template>



<style scoped>
    .circle {
        border: 1px solid gray;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
        display: flex;
        font-size: 1.5rem;
        margin-bottom: 8px;
    }
    section {
        display: inline-flex;
        align-items: center;
        flex-direction: column;
    }
</style>
