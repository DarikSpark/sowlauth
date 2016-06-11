  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<script type="text/javascript">

// Holt-Winters.js

function forecast(data, alpha, beta, gamma, period, m) {
  var seasons, seasonal, a_0, b_0;

  if (!validArgs(data, alpha, beta, gamma, period, m))
    return;

  seasons = Math.round(data.length / period);
  st_1 = data[0];
  b_1 = initialTrend(data, period);
  seasonal = seasonalIndices(data, period, seasons);

  return calcHoltWinters(data, st_1, b_1, alpha, beta, gamma, seasonal, period, m);
}

// module.exports = forecast;

function validArgs(data, alpha, beta, gamma, period, m) {
  if (!data.length)
    return false;
  if (m <= 0)
    return false;
  if (m > period)
    return false;
  if (alpha < 0.0 || alpha > 1.0)
    return false;
  if (beta < 0.0 || beta > 1.0)
    return false;
  if (gamma < 0.0 || gamma > 1.0)
    return false;
  return true;
}

function initialTrend(data, period) {
  var sum = 0;
  for (var i = 0; i < period; i++) {
    sum += (data[period + i] - data[i]);
  }
  return sum / (period * period);
}

function seasonalIndices(data, period, seasons) {
  var savg, obsavg, si, i, j;

  savg = Array(seasons);
  obsavg = Array(data.length);

  si = Array(period);

  // zero-fill savg[] and si[]
  for (i = 0; i < seasons; i++) {
    savg[i] = 0.0;
  }
  for (i = 0; i < period; i++) {
    si[i] = 0.0;
  }

  // seasonal average
  for (i = 0; i < seasons; i++) {
    for (j = 0; j < period; j++) {
      savg[i] += data[(i*period) + j];
    }
    savg[i] /= period;
  }
  // averaged observations
  for (i = 0; i < seasons; i++) {
    for (j = 0; j < period; j++) {
      obsavg[(i*period) + j] = data[(i*period) + j] / savg[i];
    }
  }
  // seasonal indices
  for (i = 0; i < period; i++) {
    for (j = 0; j < seasons; j++) {
      si[i] += obsavg[(j*period) + i];
    }
    si[i] /= seasons;
  }

  return si;
}

function calcHoltWinters(data, st_1, b_1, alpha, beta, gamma, seasonal, period, m) {
  var len = data.length,
    st = Array(len),
    bt = Array(len),
    it = Array(len),
    ft = Array(len),
    i;
  
  // initial level st[1] = data[0]
  // initial trend b[1] = initialTrend(data, period)
  st[1] = st_1;
  bt[1] = b_1;

  // zero-fill ft[] (for cleanliness)
  for (i = 0; i < len; i++) {
    ft[i] = 0.0;
  }

  // initial seasonal indices
  for (i = 0; i < period; i++) {
    it[i] = seasonal[i];
  }

  for (var i = 2; i < len; i++) {
    // overall smoothing
    if (i - period >= 0) {
      st[i] = ((alpha * data[i]) / it[i - period]) +
          ((1.0 - alpha) * (st[i - 1] + bt[i - 1]));
    } else {
      st[i] = (alpha * data[i]) + ((1.0 - alpha) *
          (st[i - 1] + bt[i - 1]));
    }

    // trend smoothing
    bt[i] = (gamma * (st[i] - st[i - 1])) +
        ((1 - gamma) * bt[i - 1]);

    // seasonal smoothing
    if (i - period >= 0) {
      it[i] = ((beta * data[i]) / st[i]) +
          ((1.0 - beta) * it[i - period]);
    }

    // forecast
    if (i + m >= period) {
      ft[i + m] = (st[i] + (m * bt[i])) *
            it[i - period + m];
    }
  }

  // -> forecast[]
  return ft;
}


// Normal.js /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  // var forecast = require('../../index.js');

function test(realdata) {
   var 
  // data = [362, 385, 432, 341, 382, 409,
  //       498, 387, 473, 513, 582, 474,
  //       544, 582, 681, 557, 628, 707,
  //       773, 592, 627, 725, 854, 661 ],
    alpha = 0.5,
    beta = 0.4,
    gamma = 0.2,
    period = 52,
    m = 20,
    prediction;
    // crossCheck = [0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
    
    //   594.8043646513713, 357.12171044215734, 410.9203094983815,
    //   444.67743912921156, 550.9296957593741, 421.1681718160631,

    //   565.905732450577, 639.2910221068818, 688.8541669002238,
    //   532.7122406111591, 620.5492369959037, 668.5662327429854,

    //   773.5946568453546, 629.0602103529998, 717.0290609530134,
    //   836.4643466657625, 884.1797655866865, 617.6686414831381,

    //   599.1184450128665, 733.227872348479, 949.0708357438998,
    //   748.6618488792186 ];

  console.log('\nTesting "normal":');
  prediction = forecast(realdata, alpha, beta, gamma, period, m);
  // if (!match(crossCheck, prediction, 0.0000000000001))
    // return false;

  // console.log('--> avg abs err:', avgErr(data, prediction)); // DUMP
  // console.log('--> prediction:', prediction); // DUMP 







  return prediction;
}

// module.exports = test;



function match(a, b, errThresh) {
  var la = a.length, lb = b.length;

  for (var i = 0; i < la && i < lb; i++) {
    if (Math.abs(a[i]-b[i]) > errThresh) {
      // console.log('comparison (crossCheck <-> predicted) failed at [i] = ', i);
      // console.log('accuracy threshhold:', errThresh);
      // console.log('result[i] off by', Math.abs(a[i]-b[i]));
      return false;
    }
  }

  // console.log('--> success.');
  return true;
}

function avgErr(data, prediction) {
  var i, j, sum = 0, len = prediction.length;

  for (i = 0; i < len; i++) {
    if (prediction[i] !== 0) {
      j = i;
      break;
    }
  }

  while (i < len) {
    if (!(i in data && i in prediction)) break;
    sum += Math.abs(data[i] - prediction[i]);
    i++;
  }

  return sum / ((len - j) + 1);
}


// Google Charts ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      

      // var predict = test();
    //   predict.toString();
    //   document.getElementById("demo").innerHTML = predict;

    //   function myFunction() {
    // var predict = test();
    //   predict.toString();
    //   document.getElementById("demo").innerHTML = predict;
// }

      function drawChart() {
        
    
        // var realdata = [31963, 24994, 24441, 25616, 24378, 23075, 21446, 22009, 24621, 23888, 20883, 21344, 22196, 21718, 22533, 21227, 21387, 20636, 22089, 22194, 22461, 23248, 24978, 20911, 23585, 25766, 24486, 23961, 22362, 21175, 21462, 23010, 21743, 20601, 18848, 14645, 20775, 23789, 23817, 29074, 33075, 37880, 36158, 38330, 49333, 44189, 37080, 35266, 39212, 39207, 40773, 41782,

        //  31963, 24994, 24441, 25616, 24378, 23075, 21446, 22009, 24621, 23888, 20883, 21344, 22196, 21718, 22533, 21227, 21387, 20636, 22089, 22194, 22461, 23248, 24978, 20911, 23585, 25766, 24486, 23961, 22362, 21175, 21462, 23010, 21743, 20601, 18848, 14645, 20775, 23789, 23817, 29074, 33075, 37880, 36158, 38330, 49333, 44189, 37080, 35266, 39212, 39207, 40773, 41782,

        //  31963, 24994, 24441, 25616, 24378, 23075, 21446, 22009, 24621, 23888, 20883, 21344, 22196, 21718, 22533, 21227, 21387, 20636, 22089, 22194, 22461, 23248, 24978, 20911, 23585, 25766, 24486, 23961, 22362, 21175, 21462, 23010, 21743, 20601, 18848, 14645, 20775, 23789, 23817, 29074, 33075, 37880, 36158, 38330, 49333, 44189, 37080, 35266, 39212, 39207, 40773, 41782,

        //  31963, 24994, 24441, 25616, 24378, 23075, 21446, 22009, 24621, 23888, 20883, 21344, 22196, 21718, 22533, 21227, 21387, 20636, 22089, 22194, 22461, 23248, 24978, 20911, 23585, 25766, 24486, 23961, 22362, 21175, 21462, 23010, 21743, 20601, 18848, 14645, 20775, 23789, 23817, 29074, 33075, 37880, 36158, 38330, 49333, 44189, 37080, 35266, 39212, 39207, 40773, 41782,

        //  31963, 24994, 24441, 25616, 24378, 23075, 21446, 22009, 24621, 23888, 20883, 21344, 22196, 21718, 22533, 21227, 21387, 20636, 22089, 22194, 22461, 23248, 24978, 20911, 23585, 25766, 24486, 23961, 22362, 21175, 21462, 23010, 21743, 20601, 18848, 14645, 20775, 23789, 23817, 29074, 33075, 37880, 36158, 38330, 49333, 44189, 37080, 35266, 39212, 39207, 40773, 41782
        //  ];

         // var realdata = file('roses_data.txt');
         // var file = event.target.file;
         // var reader = new FileReader();
         // var txt=reader.readAsText(file);
         // var items=txt.split(",");

  
        // var realdata = new Array;
        // $.get('roses_data.txt', function(data){
        // realdata = data.split('\n');
        // });

        <?php 
          $lines = file('roses_data.txt');
          for ($i=0; $i < count($lines); $i++) { 
            $lines[$i] = rtrim($lines[$i]);
          }
          echo 'var realdata = '.json_encode($lines);
        ?>

        for (var i = 0; i <= realdata.length - 1; i++) {
          realdata[i] = parseInt(realdata[i]);
        }

        var predict = test(realdata);
        // var predictdata = [];

        // for (var i = 0; i <= predict.length - 1; i++) {
        //   predictdata.push([i,predict[i]]);
        // }

        // var data = google.visualization.arrayToDataTable([
        //   ['Year', 'Sales', 'Expenses'],
        //   ['2004',  1000,      400],
        //   ['2005',  1170,      460],
        //   ['2006',  660,       1120],
        //   ['2007',  1030,      540]
        // ]);

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Week');
      data.addColumn('number', 'Real');
      data.addColumn('number', 'Holter-Winters');

      data.addRows([]);
      for (var i = 0; i <= predict.length - 1; i++) {
        data.addRows([[i, realdata[i], predict[i]]]);
      }

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        
      }


    </script>
  </head>
  <body>
  <!-- <input type="file"/> -->
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <p id="demo"></p>
    <div class="quote"></div>
<!--     <button onclick="myFunction()">Try it</button> -->
  </body>
</html>