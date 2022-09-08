as.dashboard = {};

as.dashboard.initChart = function () {
    var data = {
        labels: months,
        datasets: [
            {
                label: trans.chartLabel,
                backgroundColor: "transparent",
                borderColor: "#179970",
                pointBackgroundColor: "#179970",
                data: users
            }
        ]
    };

    var ctx = document.getElementById("myChart").getContext("2d");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "#f6f6f6",
                        zeroLineColor: '#f6f6f6',
                        drawBorder: false
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    }
                }]
            },
            responsive: true,
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            tooltips: {
                titleMarginBottom: 15,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = tooltipItem.yLabel,
                            suffix = trans.new + " " + (value == 1 ? trans.user : trans.users);

                        return " " + value + " " + suffix;
                    }
                }
            }
        }
    })

};


as.dashboard.factureChart = function () {
    var data = {
        labels: months,
        datasets: [
            {
                label: trans.chartLabel,
                backgroundColor: "transparent",
                borderColor: "#179970",
                pointBackgroundColor: "#179970",
                data: factures
            }
        ]
    };

    var facture = document.getElementById("facture").getContext("2d");

    var factureChart = new Chart(facture, {
        type: 'line',
        data: data,
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "#f6f6f6",
                        zeroLineColor: '#f6f6f6',
                        drawBorder: false
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    }
                }]
            },
            responsive: true,
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            tooltips: {
                titleMarginBottom: 15,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = tooltipItem.yLabel,
                            suffix = trans.new + " " + 'Factures';

                        return " " + value + " " + suffix;
                    }
                }
            }
        }
    })

};




$(document).ready(function () {
    as.dashboard.initChart();
    as.dashboard.factureChart();
});
