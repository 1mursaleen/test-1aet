<template>
    <div>
        <Card noborder>
            <div class="md:flex justify-between pb-6 md:space-y-0 space-y-3 items-center">
                <h5>History</h5>
                <!-- <InputGroup v-model="searchTerm" placeholder="Search" type="text" prependIcon="heroicons-outline:search" merged /> -->
            </div>

            <vue-good-table :columns="columns" styleClass=" vgt-table bordered centered" :rows="searchHistory" :pagination-options="{
                    enabled: true,
                    perPage: searchHistoryPagination.perpage,
                }" :search-options="{
                    enabled: false,
                    externalQuery: searchTerm,
                }" :select-options="{
                    enabled: false,
                    selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
                    selectioninfoClass: 'custom-class',
                    selectionText: 'rows selected',
                    clearSelectionText: 'clear',
                    disableSelectinfo: true,
                    selectAllByGroup: true,
                }">
                <template v-slot:table-row="props">
                    <span v-if="props.column.field == 'user'" class="flex items-center">
                        <span class="w-7 h-7 rounded-full mr-3 flex-none">
                            <img :src="props.row.user.image" :alt="props.row.user.name" class="object-cover w-full h-full rounded-full" />
                        </span>
                        <span class="text-sm text-slate-600  capitalize">{{ props.row.user.name }}</span>
                    </span>
                    <span v-if="props.column.field == 'keyword'" class="text-blue-500 ">
                        <router-link :to="{ name: 'search-details', params: { id: props.row.id } }">
                            {{ props.row.keyword }}
                        </router-link>
                    </span>
                    <span v-if="props.column.field == 'date'" class="text-slate-500 ">
                        {{ props.row.date }}
                    </span>
                    <span v-if="props.column.field == 'action'">
                        <div class="flex space-x-3 justify-center">
                            <Tooltip placement="top" arrow theme="dark">
                                <template #button>
                                    <router-link :to="{ name: 'search-details', params: { id: props.row.id } }">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:eye" />
                                        </div>
                                    </router-link>
                                </template>
                                <span></span>
                            </Tooltip>

                        </div>
                    </span>
                </template>

                <template #pagination-bottom="props">
                    <div class="py-4 px-3">
                        <Pagination :total="searchHistoryPagination.total" :current="searchHistoryPagination.current_page" :per-page="searchHistoryPagination.perpage" :pageRange="searchHistoryPagination.last_paage" @page-changed="searchHistoryPagination.current_page = $event" :pageChanged="props.pageChanged" :perPageChanged="props.perPageChanged" enableSearch :options="options">
                            >
                        </Pagination>
                    </div>
                </template>
            </vue-good-table>
        </Card>
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
import { MenuItem } from "@headlessui/vue"
import endpoints from '@/api/endpoints'
import progress from '@/plugins/progress'
import { useToast } from "vue-toastification"

export default {
    components: {
        Pagination,
        Tooltip,
        InputGroup,
        Dropdown,
        Icon,
        Card,
        MenuItem,
    },

    data () {
        return {
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
            options: [
                {
                    value: "1",
                    label: "1",
                },
                {
                    value: "3",
                    label: "3",
                },
                {
                    value: "5",
                    label: "5",
                },
            ],
            columns: [
                {
                    label: "Id",
                    field: "id",
                },
                {
                    label: "Keyword",
                    field: "keyword",
                },
                {
                    label: "User",
                    field: "user",
                },
                {
                    label: "Date",
                    field: "date",
                },

                {
                    label: "Device",
                    field: "device",
                },

                {
                    label: "Location",
                    field: "location",
                },

                {
                    label: "Repetitions",
                    field: "repetitions",
                },
                {
                    label: "Action",
                    field: "action",
                },
            ],
        }
    },

    setup () {
        const toast = useToast()

        const searchHistory = ref([])
        const searchHistoryPagination = reactive({})

        // id: id
        // keyword: keyword
        // device: device
        // date: created_at
        // user: {
        //     name: user.name,
        //         image: user.image,
        // }
        // location: location.label
        // repetitions: repetitions
        // // depth: depth
        // // language: language_code
        //     action: null,

        const fetchSearchHistory = async (page = 1) => {
            try {
                const response = await axios.get(endpoints.searchHistory(page))
                const { data: list, ...paginationMeta } = response.data.data.searches

                searchHistory.value = list.map(search => ({
                    ...search,
                    user: {
                        name: search.user.name,
                        image: search.user.image,
                    },
                    location: search.location.label,
                    date: moment(search.created_at).format('YYYY-MM-DD hh:mm Z'),
                }))

                Object.assign(searchHistoryPagination, paginationMeta)

                progress.done()
            } catch (error) {
                toast.error("Error fetching Search records", {
                    timeout: 2000,
                })
            }
        }

        onMounted(() => {
            fetchSearchHistory()
        })

        return {
            fetchSearchHistory,
            searchHistory,
            searchHistoryPagination,
        }
    }
};
</script>

<style lang="scss" scoped>
.action-btn {
    @apply h-6 w-6 flex flex-col items-center justify-center border border-slate-200 dark:border-slate-700 rounded;
}
</style>
