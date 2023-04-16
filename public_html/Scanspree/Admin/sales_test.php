<?php
// Connect to database


?>

<!-- HTML code for chart -->
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- JavaScript code for chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <title>Document</title>
</head>
<body>
<canvas id="myChart"></canvas>

<script>
const chartData = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June'],
  datasets: [{
    label: 'Sales',
    data: [65, 59, 80, 81, 56, 55],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

const chartOptions = {
  scales: {
    x: {
      display: true,
      title: {
        display: true,
        text: 'Month'
      }
    },
    y: {
      display: true,
      title: {
        display: true,
        text: 'Sales'
      }
    }
  }
};

const lineChart = new Chart(document.getElementById('myChart'), {
  type: 'line',
  data: chartData,
  options: chartOptions
});

</script>

</body>
</html>