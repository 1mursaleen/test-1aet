<template>
    <div class="space-y-5">
        <div>
            <Card>
                <SearchForm />
            </Card>
        </div>
        <SearchTable />
    </div>
</template>

<script>
import Card from "@/components/Card"
import SearchForm from "@/pages/Search/SearchForm"
import SearchTable from "@/pages/Search/SearchTable"
import progress from '@/plugins/progress'

export default {
    components: {
        Card,
        SearchTable,
        SearchForm,
    },
    setup () {
        progress.start()
    }
};
</script>

<style lang="scss">
.vgt-inner-wrap {
    @apply shadow-none;
}
</style>
