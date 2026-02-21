/*! For license information please see adminux-project-projects.js.LICENSE.txt */
"use strict";

document.addEventListener("DOMContentLoaded", function () {
    window.randomScalingFactor = function () {
        return Math.round(20 * Math.random());
    };

    window.randomScalingFactor2 = function () {
        return Math.round(10 * Math.random());
    };

    // --- Green Chart (mediumchartgreen1) ---
    var ctxGreen = document.getElementById("mediumchartgreen1").getContext("2d");

    var gradientGreen1 = ctxGreen.createLinearGradient(0, 0, 0, 150);
    gradientGreen1.addColorStop(0, "rgba(8, 160, 70, 0.35)");
    gradientGreen1.addColorStop(1, "rgba(8, 160, 70, 0)");

    var gradientGreen2 = ctxGreen.createLinearGradient(0, 0, 0, 150);
    gradientGreen2.addColorStop(0, "rgba(8, 160, 70, 0.85)");
    gradientGreen2.addColorStop(1, "rgba(8, 160, 70, 0.25)");

    var greenChartConfig = {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [
                {
                    label: "# of Votes",
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: gradientGreen1,
                    borderColor: "rgba(8, 160, 70, 0.5)",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.5,
                    barThickness: 10,
                    borderRadius: 5,
                },
                {
                    label: "# of Votes",
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: gradientGreen2,
                    borderColor: "#08a046",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.5,
                    barThickness: 10,
                    borderRadius: 5,
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    ticks: {
                        color: "#999999",
                    },
                    display: true,
                    beginAtZero: true,
                    grid: {
                        display: false,
                        zeroLineColor: "rgba(0,0,0,0.3)",
                        drawBorder: true,
                        lineWidth: 1,
                        zeroLineWidth: 1,
                    },
                },
                x: {
                    ticks: {
                        color: "#999999",
                    },
                    display: true,
                    grid: {
                        display: false,
                        zeroLineColor: "rgba(0,0,0,0.3)",
                        drawBorder: true,
                        lineWidth: 1,
                        zeroLineWidth: 1,
                    },
                },
            },
        },
    };

    var greenChart = new Chart(ctxGreen, greenChartConfig);

    setInterval(function () {
        greenChartConfig.data.datasets.forEach(function (dataset) {
            dataset.data = dataset.data.map(function () {
                return randomScalingFactor();
            });
        });
        greenChart.update();
    }, 1500);

    // --- Red Chart (mediumchartred1) ---
    var ctxRed = document.getElementById("mediumchartred1").getContext("2d");

    var gradientRed1 = ctxRed.createLinearGradient(0, 0, 0, 150);
    gradientRed1.addColorStop(0, "rgba(200, 0, 54, 0.35)");
    gradientRed1.addColorStop(1, "rgba(200, 0, 54, 0)");

    var gradientRed2 = ctxRed.createLinearGradient(0, 0, 0, 160);
    gradientRed2.addColorStop(0, "rgba(200, 0, 54, 0.85)");
    gradientRed2.addColorStop(1, "rgba(200, 0, 54, 0.25)");

    var redChartConfig = {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [
                {
                    label: "# of Votes",
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    radius: 0,
                    backgroundColor: gradientRed1,
                    borderColor: "rgba(200, 0, 54, 0.35)",
                    borderWidth: 1,
                    borderRadius: 5,
                    fill: true,
                    tension: 0.5,
                    barThickness: 10,
                },
                {
                    label: "# of Votes",
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    radius: 0,
                    backgroundColor: gradientRed2,
                    borderColor: "#c80036",
                    borderWidth: 1,
                    borderRadius: 5,
                    fill: true,
                    tension: 0.5,
                    barThickness: 10,
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    ticks: {
                        color: "#999999",
                    },
                    display: true,
                    beginAtZero: true,
                    grid: {
                        display: false,
                        zeroLineColor: "rgba(0,0,0,0.3)",
                        drawBorder: true,
                        lineWidth: 1,
                        zeroLineWidth: 1,
                    },
                },
                x: {
                    ticks: {
                        color: "#999999",
                    },
                    display: true,
                    grid: {
                        display: false,
                        zeroLineColor: "rgba(0,0,0,0.3)",
                        drawBorder: true,
                        lineWidth: 1,
                        zeroLineWidth: 1,
                    },
                },
            },
        },
    };

    var redChart = new Chart(ctxRed, redChartConfig);

    setInterval(function () {
        redChartConfig.data.datasets.forEach(function (dataset) {
            dataset.data = dataset.data.map(function () {
                return randomScalingFactor();
            });
        });
        redChart.update();
    }, 1500);

    // --- Doughnut Charts ---
    var ctxDoughnut1 = document.getElementById("doughnutchart").getContext("2d");
    var ctxDoughnut2 = document.getElementById("doughnutchart2").getContext("2d");

    var doughnutChartConfig = {
        type: "doughnut",
        data: {
            labels: ["Kids Play", "Tools", "Electronics", "Decorative", "Other"],
            datasets: [
                {
                    label: "Expense categories",
                    data: [40, 10, 15, 25, 10],
                    backgroundColor: [
                        "rgba(255, 193, 7, 1)",
                        "rgba(8, 160, 70, 1)",
                        "rgba(200, 0, 54, 1)",
                        "rgba(0, 73, 232, 1)",
                        "rgba(111, 66, 193, 1)",
                    ],
                    borderWidth: 0,
                },
            ],
        },
        options: {
            responsive: true,
            cutout: 35,
            tooltips: {
                position: "nearest",
                yAlign: "bottom",
            },
            plugins: {
                legend: {
                    display: false,
                    position: "top",
                },
                title: {
                    display: false,
                    text: "Chart.js polarArea Chart",
                },
            },
        },
    };

    new Chart(ctxDoughnut1, doughnutChartConfig);
    new Chart(ctxDoughnut2, doughnutChartConfig);

    // --- Dragula (Drag and Drop) ---
    dragula([
        document.querySelector("#todocolumn"),
        document.querySelector("#inprogresscolumn"),
        document.querySelector("#completedcolumn"),
        document.querySelector("#approvedcolumn"),
    ]);
});