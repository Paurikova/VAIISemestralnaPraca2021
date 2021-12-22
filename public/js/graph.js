let chart;

function createChart() {
    let options = {
        series: [
            {
                name: "Months",
                height: 30,
                data: []
            }
        ],

        title: {
            text: "My reading this year",
            align: 'center',
            style: {
                fontSize: '30px'
            },
        },

        chart: {
            width: '90%',
            position: 'center',
            height: 400,
            type: "bar",
        },

        colors: ["#34fbea",
            "#4ba5ff",
            "#fbda34",
            "#76fb34",
            "#f57107",
            "#e53935",
            "#b41a10",
            "#fb9e34",
            "#8a5a43",
            "#699f52",
            "#31436b",
            "#b8c5de"],

        plotOptions: {
            bar: {
                columnWidth: "45%",
                distributed: true
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        grid: {
            show: false
        },
        xaxis: {
            categories: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],

            labels: {
                style: {
                    fontSize: "14px"
                }
            }
        },

        yaxis: {
            title: {
                text: "Min",
            }
        }
    };

    chart = new ApexCharts(document.querySelector("#myChart"), options);
    chart.render();
}

function readingChart() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '?c=reading&a=getTimesInYear');
    xhr.onreadystatechange = function () {
        if (xhr.status === 200) {
            let result = JSON.parse(xhr.responseText);
            chart.updateSeries([{
                data: [result[0],result[1],result[2],result[3],result[4],result[5],result[6], result[7], result[8], result[9], result[10], result[11]]
            }])
        } else {
            console.log('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();
}

function sendTime() {
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let xhrRequest = new XMLHttpRequest();
    xhrRequest.open('POST', '?c=reading&a=addReading&date=' + date + '&time=' + time, true);
    xhrRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhrRequest.onreadystatechange = function () {
        if (xhrRequest.status === 200) {
            let result = JSON.parse(xhrRequest.responseText);
            if (result == 'success') {
                readingChart()
            }
        } else {
            console.log('Request failed.  Returned status of ' + xhrRequest.status);
        }
    }
    xhrRequest.send();
}

window.onload = function () {
    if (window.location.href.split("/")[4] == '?c=reading&a=reading') {
        createChart();
        readingChart();
        document.getElementById("newReading").onclick = () => {
            sendTime();
        }
    }
};


