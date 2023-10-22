<template>
    <div class="space-y-5">

        <h5 v-if="isLoading" class="text-primary-500 text-center">Mapping Data...</h5>

        <Card title="Search Information" imaClass="rounded-md" noborder>
            <SearchInfo :search="searchDetails" />
        </Card>

        <Card title="Fluctuation Graph for URLs (clicking on points will open URL)">
            <RankFluctuationGraph v-if="!isLoading" :analytics="rankAnalytics" :repetitions="searchDetails.repetitions" />
        </Card>

        <Card title="Scatter Graph for Domains">
            <ScatterChart v-if="!isLoading" :analytics="rankAnalytics" />
        </Card>

        <div>
            <Card noborder>
                <div class="md:flex justify-between pb-6 md:space-y-0 space-y-3 items-center">
                    <h5>Ranks</h5>
                </div>

                <vue-good-table :columns="columns" styleClass=" vgt-table bordered centered-IGNORE" :rows="rankAnalytics" :pagination-options="{
                    enabled: true,
                    perPage: perpage,
                }" :search-options="{
                    enabled: true,
                    externalQuery: searchTerm,
                }" :select-options="{
                    enabled: false,
                    selectOnCheckboxOnly: true,
                    selectioninfoClass: 'custom-class',
                    selectionText: 'rows selected',
                    clearSelectionText: 'clear',
                    disableSelectinfo: true,
                    selectAllByGroup: true,
                }">
                    <template v-slot:table-row="props">
                        <span v-if="props.column.field == 'date'" class="text-slate-500">
                            {{ props.row.date }}
                        </span>
                        <span v-if="props.column.field == 'url'" class="text-blue-700">
                            <a :href="props.row.url" target="_blank">
                                {{ limitString(props.row.url) }}
                            </a>
                        </span>
                    </template>

                    <template #pagination-bottom="props">
                        <div class="py-4 px-3">
                            <Pagination :total="rankAnalytics?.length" :current="current" :per-page="perpage" :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged" :perPageChanged="props.perPageChanged" enableSearch> > </Pagination>
                        </div>
                    </template>
                </vue-good-table>
            </Card>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import { ref, reactive, onMounted } from 'vue'
import Dropdown from "@/components/Dropdown"
import Card from "@/components/Card"
import Icon from "@/components/Icon"
import Tooltip from "@/components/Tooltip"
import InputGroup from "@/components/InputGroup"
import Pagination from "@/components/Pagination"
import SearchInfo from "./SearchInfo"
import ScatterChart from "./ScatterChart"
import { MenuItem } from "@headlessui/vue"
import endpoints from '@/api/endpoints'
import { useRoute } from 'vue-router'
import progress from '@/plugins/progress'
import { useToast } from "vue-toastification"
import RankFluctuationGraph from './RankFluctuationGraph.vue'

export default {
    components: {
        Pagination,
        Tooltip,
        InputGroup,
        Dropdown,
        Icon,
        Card,
        MenuItem,
        SearchInfo,
        ScatterChart,
        RankFluctuationGraph
    },

    data () {
        return {
            current: 1,
            perpage: 30,
            pageRange: 5,
            searchTerm: "",
            actions: [
                {
                    name: "view",
                    icon: "heroicons-outline:eye",
                },
                {
                    name: "edit",
                    icon: "heroicons:pencil-square",
                },
                {
                    name: "delete",
                    icon: "heroicons-outline:trash",
                },
            ],

            columns: [
                {
                    label: "Id",
                    field: "id",
                },
                {
                    label: "URL",
                    field: "url",
                },
                {
                    label: "Title",
                    field: "title",
                },
                {
                    label: "Rank",
                    field: "rank_absolute",
                },
                {
                    label: "Repetition",
                    field: "repetition",
                },
                // {
                //     label: "Description",
                //     field: "description",
                // },
                {
                    label: "Date",
                    field: "date",
                },
            ],
        }
    },


    setup () {
        const toast = useToast()
        const route = useRoute()
        const searchDetails = reactive({})
        const rankAnalytics = ref([])
        const isLoading = ref(true)

        const limitString = (str, maxLength = 80) => str.length <= maxLength
            ? str
            : str.slice(0, maxLength) + '...'

        const fetchSearch = async (searchID = 1) => {
            progress.start()
            try {
                isLoading.value = true

                const response = await axios.get(endpoints.searchDetails(searchID))

                const { analytics, ...searchDetailsData } = response.data.data.search

                Object.assign(searchDetails, searchDetailsData)

                rankAnalytics.value = analytics.map(analytic => ({
                    ...analytic,
                    date: moment(analytic.created_at).format('YYYY-MM-DD hh:mm Z'),
                }))

                isLoading.value = false

                progress.done()
            } catch (error) {
                toast.error("Error fetching details: " + error.message, {
                    timeout: 2000,
                })
            }
        }

        onMounted(() => {
            fetchSearch(route.params.id)
        })

        return {
            isLoading,
            fetchSearch,
            searchDetails,
            rankAnalytics,
            limitString,
        }
    }
};
</script>

<style lang="scss" scoped>
</style>
