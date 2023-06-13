<template>
    <Doughnut id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Doughnut } from "vue-chartjs";
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";

ChartJS.register(ArcElement, Tooltip, Legend);

const chartData = ref({
    labels: [],
    datasets: [
        {
            backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
            data: [],
        },
    ],
});

const props = defineProps({
    priceByCategory: Array,
});

const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: false,
});

props.priceByCategory.forEach((category) => {
    chartData.value.labels.push(category.category);
    chartData.value.datasets[0].data.push(category.total_price);
});
onMounted(() => {
    // Access the chart instance if needed
});
</script>
