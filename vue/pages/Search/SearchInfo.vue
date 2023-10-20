<template>
    <h6 class="mb-5">
        <span class="text-gray-600 pr-2"> Keyword: </span>
        {{ search.keyword }}
    </h6>
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 items-start font-bold">
        <p>
            <span class="text-gray-600 pr-2"> ID: </span>
            {{ search?.id }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> User: </span>
            {{ search?.user?.name }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> Location: </span>
            {{ search?.location?.label }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> Repetitions: </span>
            {{ search?.repetitions }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> Device: </span>
            {{ search?.device }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> OS: </span>
            {{ search?.os }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> Depth: </span>
            {{ search?.depth }}
        </p>
        <p>
            <span class="text-gray-600 pr-2"> Language: </span>
            {{ search?.language_code }}
        </p>
    </div>
</template>

<script>
import Card from "@/components/Card"

export default {
    components: {
        Card,
    },

    props: {
        search: {
            type: Object,
            default: {},
        },
    }
}
</script>

<style scoped>
</style>
