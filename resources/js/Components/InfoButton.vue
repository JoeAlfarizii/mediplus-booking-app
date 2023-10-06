<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    value: {
        type: String,
    },
    href: {
        type: String,
        default: ''
    },
    icon: {
        type: String,
    },
    iconClass: {
        type: String,
        default: ''
    }
});
</script>
<template>
    <template v-if="href.length > 0">
        <Link :href="href" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <slot />
        </Link>
    </template>
    <template v-else>
        <button
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
    </template>
</template>

