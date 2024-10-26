// File: public/js/pages/dashboard.js

// Sales Chart Configuration
const salesChartConfig = {
    series: [{
        name: "Digital Goods",
        data: [28, 48, 40, 19, 86, 27, 90]
    }, {
        name: "Electronics",
        data: [65, 59, 80, 81, 56, 55, 40]
    }],
    chart: {
        height: 300,
        type: "area",
        toolbar: { show: false }
    },
    legend: { show: false },
    colors: ["#0d6efd", "#20c997"],
    dataLabels: { enabled: false },
    stroke: { curve: "smooth" },
    xaxis: {
        type: "datetime",
        categories: [
            "2023-01-01", "2023-02-01", "2023-03-01",
            "2023-04-01", "2023-05-01", "2023-06-01",
            "2023-07-01"
        ]
    },
    tooltip: {
        x: { format: "MMMM yyyy" }
    }
};

// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    if (document.querySelector("#revenue-chart")) {
        const salesChart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            salesChartConfig
        );
        salesChart.render();
    }

    // World Map
    if (document.querySelector("#world-map")) {
        new jsVectorMap({
            selector: "#world-map",
            map: "world"
        });
    }

    // Sparkline Charts
    const sparklineConfig = {
        chart: {
            type: "area",
            height: 50,
            sparkline: { enabled: true }
        },
        stroke: { curve: "straight" },
        fill: { opacity: 0.3 },
        yaxis: { min: 0 },
        colors: ["#DCE6EC"]
    };

    const sparklineData = {
        "sparkline-1": [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
        "sparkline-2": [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
        "sparkline-3": [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]
    };

    Object.entries(sparklineData).forEach(([id, data]) => {
        const element = document.querySelector(`#${id}`);
        if (element) {
            const chart = new ApexCharts(element, {
                ...sparklineConfig,
                series: [{ data }]
            });
            chart.render();
        }
    });
});