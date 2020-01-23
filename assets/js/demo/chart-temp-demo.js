Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


var allLabels;
var allData;

function loadCharts(data,monthdata){
  allLabels = data;
  allData = monthdata;
  var year = $("#timeperiod").val();
  if(year=="year-wise"){
    var yearlyData = allData[allData.length-1];
    var chartData = [];
    yearlyData.forEach(element=>{
      chartData.push(element['amount']);
    });
    renderChart(allLabels[1],chartData);
  }else{
    var yearData = allData[year];
    var chartData = fitInMonthData(yearData);
    renderChart(allLabels[0],chartData);
  }
}

$("#timeperiod").change(function (){
  $("#bar-chart-grouped").remove();
  $("#chart-container").append('<canvas id="bar-chart-grouped"></canvas>');
  var year = $("#timeperiod").val();
  if(year=="year-wise"){
    var yearlyData = allData[allData.length-1];
    var chartData = [];
    yearlyData.forEach(element=>{
      chartData.push(element['amount']);
    });
    renderChart(allLabels[1],chartData);
  }else{
    var yearData = allData[year];
    var chartData = fitInMonthData(yearData);
    renderChart(allLabels[0],chartData);
  }
})


function fitInMonthData(yearData){
  chartData = [0,0,0,0,0,0,0,0,0,0,0,0];

  yearData.forEach(element => {
    chartData[element['month']-1] = element['amount'];
  });
  return chartData;
}


function renderChart(labels,data){
new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: "Purchase(Rupees)",
          backgroundColor: "#3e95cd",
          data: data
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Purchase Revenue (Rupees)'
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