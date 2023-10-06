<script setup>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';

const date = ref();

defineProps({
    isRequired: {
        type: Boolean,
        default: false
    },
});
</script>
<template>
    <template v-if="isRequired === true">
        <VueDatePicker v-model="date" placeholder="Start Typing ..." text-input required/>
    </template>
    <template v-else>
        <VueDatePicker v-model="date" placeholder="Start Typing ..." text-input/>
    </template>
</template>