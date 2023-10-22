<template>
    <!-- The chart container -->
    <div ref="chartDiv" style="width: 100%; height: 3000px;"></div>
</template>

  <script>
import { ref, onMounted, onBeforeUnmount, watch } from "vue"
import * as am4core from "@amcharts/amcharts4/core"
import * as am4charts from "@amcharts/amcharts4/charts"

export default {
    props: {
        analytics: {
            type: Array,
            default: [],
        },
    },
    setup (props) {
        const { analytics } = props

        const chartDiv = ref(null)
        let chart

        const generateChartData = () => {
            const data = []

            if (analytics.length === 0) return data

            const urls = Array.from(new Set(analytics.map((item) => item.url)))
            const repetitions = Array.from(
                new Set(analytics.map((item) => item.repetition))
            )

            repetitions.forEach((iteration) => {
                const dataPoint = { iteration }

                urls.forEach((url) => {
                    const rank = analytics.find(
                        (item) => item.url === url && item.repetition === iteration
                    )
                    dataPoint[url] = rank ? rank.rank_absolute : 100
                })

                data.push(dataPoint)
            })

            return data
        }

        const createChart = () => {
            chart = am4core.create(chartDiv.value, am4charts.XYChart)
            chart.data = generateChartData()

            const categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis())
            categoryAxis.dataFields.category = "iteration"
            categoryAxis.title.text = "Repetition"

            const valueAxis = chart.yAxes.push(new am4charts.ValueAxis())
            valueAxis.renderer.inversed = true
            valueAxis.title.text = "Ranking"

            const urls = Array.from(new Set(analytics.map((item) => item.url)))
            urls.forEach((url, index) => {
                const series = chart.series.push(new am4charts.LineSeries())
                series.dataFields.valueY = url
                series.dataFields.categoryX = "iteration"
                series.name = url

                series.groupFields.valueY = url
                series.groupData = true

                const bullet = series.bullets.push(new am4charts.CircleBullet())
                bullet.fill = am4core.color(`#${ Math.floor(Math.random() * 16777215).toString(16) }`)
                bullet.tooltipText = `{name}: {valueY}`

                bullet.events.on("over", (event) => {
                    const dataItem = event.target.dataItem
                    chart.tooltipText = `{name}: {${ dataItem.component.dataFields.valueY }}`
                })

                bullet.events.on("out", () => {
                    chart.tooltipText = ""
                })

                bullet.events.on("hit", (event) => {
                    const dataItem = event.target.dataItem
                    const url = dataItem.component.name
                    window.open(url, "_blank")
                })
            })

            chart.cursor = new am4charts.XYCursor()
        }

        onMounted(() => {
            createChart()
        })

        onBeforeUnmount(() => {
            if (chart) {
                chart.dispose()
            }
        })

        watch(() => analytics, () => {
            if (chart) {
                chart.dispose()
            }
            createChart()
        })

        return {
            chartDiv,
        }
    },
};
  </script>
