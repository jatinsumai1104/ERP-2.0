Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


var allLabels;
var allMonthData;
$("#timeperiod").change(function () {
  // console.log(allLabels);
  $("#bar-chart-grouped").remove();
  $("#chart-container").append('<canvas id="bar-chart-grouped"></canvas>');
  var year = $("#timeperiod").val();
  if (year == "year-wise") {
    renderChart(allLabels[1], [0, 0]);
  } else {
    var yearData = allMonthData[year];
    var chartData = fitInMonthData(yearData);
    renderChart(data[0], chartData);
  }
})

function loadCharts(data, monthdata) {
  // console.log(data);
  allLabels = data;
  allMonthData = monthdata;
  var year = $("#timeperiod").val();
  if (year == "year-wise") {
    renderChart(allLabels[1], [0, 0]);
  } else {
    // renderChart(allLabels[0]);
    var yearData = allMonthData[year];
    var chartData = fitInMonthData(yearData);
    renderChart(data[0], chartData);
  }


}

function fitInMonthData(yearData) {
  chartData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

  yearData.forEach(element => {
    // console.log(element['year']);
    chartData[element['year'] - 1] = element['amount'];
  });
  return chartData;
}


function renderChart(labels, data) {
  // console.log(labels);
  new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: "Africa",
        backgroundColor: "#3e95cd",
        data: data
      }, {
        label: "Europe",
        backgroundColor: "#8e5ea2",
        data: [408, 547, 675, 734]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Population growth (millions)'
      },
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
    }
  });

}
var dynamicColors = function() {
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  return "rgb(" + r + "," + g + "," + b + ")";
};

function renderPieChart(data,labels,title){
  var pie = document.getElementById("myPieChart");
  var borderColors= [];
  var backgroundColors = [];
  for(var i in data){
    borderColors.push(dynamicColors());
    backgroundColors.push(dynamicColors());
  }


  var myChart = new Chart(pie, {
      type: 'pie',
      data: {
          labels: labels,
          datasets: [
              {
                  data: data,
                  borderColor: borderColors,
                  backgroundColor: backgroundColors,
              }
          ]
      },
      options: {
          title: {
              display: true,
              text: title
          }
      }
  });
  }