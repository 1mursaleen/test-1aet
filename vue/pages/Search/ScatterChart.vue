<template>
    <apexchart type="scatter" height="350" :options="chartOptions" :series="chartSeries"></apexchart>
</template>

<script>
import window from "@/mixins/window"
import { ref, reactive, onMounted } from 'vue'

export default {
    mixins: [window],
    props: {
        analytics: {
            type: Array,
            default: []
        }
    },
    setup (props) {
        const { analytics } = props

        const chartSeries = ref([])
        const numberOfDomains = ref(0)

        /**
         * Generating random colors for plotting.
         *
         * @param {number} numberOfColors
         */
        const generateRandomHexColors = (numberOfColors = 1) => {
            const colors = []
            const characters = '0123456789ABCDEF'

            for (let i = 0; i < numberOfColors; i++) {
                let color = '#'
                for (let j = 0; j < 6; j++) {
                    color += characters[Math.floor(Math.random() * 16)]
                }
                colors.push(color)
            }

            return colors
        }

        /**
         * Map chart data.
         */
        const mapChartSeries = () => {

            const mapToObjectAlgorithm = {}
            const series = []

            /**
             * populate mapToObjectAlgorithm
             *
             * url * domain * rank_absolute * repetition
             *
             * mapToObjectAlgorithm = {
             *     [analytic.domain]: {
             *         [analytic.rank_absolute]: repetitions,
             *     }
             * }
             */
            analytics.map((analytic) => {

                if (!mapToObjectAlgorithm.hasOwnProperty(analytic.domain)) {
                    mapToObjectAlgorithm[analytic.domain] = {}
                }

                if (!mapToObjectAlgorithm[analytic.domain].hasOwnProperty(analytic.rank_absolute)) {
                    mapToObjectAlgorithm[analytic.domain][analytic.rank_absolute] = 0
                }

                mapToObjectAlgorithm[analytic.domain][analytic.rank_absolute] =
                    mapToObjectAlgorithm[analytic.domain][analytic.rank_absolute] + 1
            })

            // console.log('Object rank:repetition', mapToObjectAlgorithm)

            numberOfDomains.value = Object.keys(mapToObjectAlgorithm).length

            // Populate series
            for (const domain in mapToObjectAlgorithm) {
                series.push({
                    name: domain,
                    data: Object.entries(mapToObjectAlgorithm[domain]).map((entry) => ([Number(entry[0]), Number(entry[1])]))
                })
            }

            // console.log('series', series)

            // apply series
            chartSeries.value = [...series]

        }

        const chartOptions = reactive({
            colors: generateRandomHexColors(numberOfDomains),
            chart: {
                zoom: {
                    enabled: true,
                    type: "xy",
                },
                toolbar: {
                    show: false,
                },
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
            },
            legend: {
                show: false,
            },
            xaxis: {
                tickAmount: 10,
            },
            yaxis: {
            },
        })

        onMounted(() => {
            mapChartSeries()
        })

        return {
            chartOptions,
            chartSeries,
        }
    }
};
</script>
