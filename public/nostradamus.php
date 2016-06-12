  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>


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




function match(a, b, errThresh) {
  var la = a.length, lb = b.length;

  for (var i = 0; i < la && i < lb; i++) {
    if (Math.abs(a[i]-b[i]) > errThresh) {
      // console.log('comparison (crossCheck <-> predictioned) failed at [i] = ', i);
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

function precise_round(num, decimals) {
    var t=Math.pow(10, decimals);
    return (Math.round((num * t) + (decimals>0?1:0)*(Math.sign(num) * (10 / Math.pow(100, decimals)))) / t).toFixed(decimals);
}


// Google Charts ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);
      var optimised = 0;

      function drawChart() {
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

        <?php 
          $lines = file('roses_1_year_forecast.txt');
          for ($i=0; $i < count($lines); $i++) { 
            $lines[$i] = rtrim($lines[$i]);
          }
          echo 'var realdataFore = '.json_encode($lines);
        ?>

        for (var i = 0; i <= realdataFore.length - 1; i++) {
          realdataFore[i] = parseInt(realdataFore[i]);
        }

        var
        alpha = 0.5,
        beta = 0.4,
        gamma = 0.2,
        period = 52,
        m = 52,
        bestAlpha = 0.1,
        bestBeta = 0.1,
        bestGamma = 0.1,
        bestAvgErr = 0;

        var prediction = new Array;
        var bestPrediction = new Array;

        prediction = forecast(realdata, alpha, beta, gamma, period, m);
        bestPrediction = prediction;
        bestAvgErrVar = avgErr(realdata, prediction);
        console.log('--> DEFAULT avg abs err:', bestAvgErrVar);
        console.log('--> DEFAULT Alpha:', alpha);
        console.log('--> DEFAULT Beta:', beta);
        console.log('--> DEFAULT Gamma:', gamma);
        console.log('############################');

        if (optimised == 0){
          for (var i = 0.01; i <= 1; i+=0.03) {
            for (var j = 0.01; j <= 1; j+=0.03) {
              for (var k = 0.01; k <= 1; k+=0.03) {
                prediction = forecast(realdata, i, j, k, period, m);
                avgErrVar = avgErr(realdata, prediction);
                if (avgErrVar < bestAvgErrVar) {
                  bestAvgErrVar = avgErrVar;
                  bestAlpha = i;
                  bestBeta = j;
                  bestGamma = k;
                  bestPrediction = prediction;
                  // console.log('--> best avg abs err:', bestAvgErrVar);
                  // console.log('--> bestAlpha:', bestAlpha);
                  // console.log('--> bestBeta:', bestBeta);
                  // console.log('--> bestGamma:', bestGamma);
                  // console.log('############################');
                }
              }
            }
          }
          $('#js-input-alpha').val(precise_round(bestAlpha, 2));
          $('#js-input-beta').val(precise_round(bestBeta, 2));
          $('#js-input-gamma').val(precise_round(bestGamma, 2));
          // $('#js-out-alpha').val(bestAlpha);
          // $('#js-out-beta').val(bestBeta);
          // $('#js-out-gamma').val(bestGamma);
          // $('#js-out-avgErr').val(bestAvgErrVar);

          $('#js-out-alpha').text(precise_round(bestAlpha, 2));
          $('#js-out-beta').text(precise_round(bestBeta, 2));
          $('#js-out-gamma').text(precise_round(bestGamma, 2));
          $('#js-out-avgErr').text(Math.round(bestAvgErrVar));
          optimised = 1;
        }

        console.log('--> best avg abs err:', bestAvgErrVar);
        console.log('--> bestAlpha:', bestAlpha);
        console.log('--> bestBeta:', bestBeta);
        console.log('--> bestGamma:', bestGamma);
        console.log('############################');

        


        alpha = parseFloat($('#js-input-alpha').val());
        beta = parseFloat($('#js-input-beta').val());
        gamma = parseFloat($('#js-input-gamma').val());
        prediction = forecast(realdata, alpha, beta, gamma, period, m);
        avgErrVar = avgErr(realdata, prediction);
        bestPrediction = prediction;
        $('#js-out-alpha').text(precise_round(alpha, 2));
        $('#js-out-beta').text(precise_round(beta, 2));
        $('#js-out-gamma').text(precise_round(gamma, 2));
        $('#js-out-avgErr').text(Math.round(avgErrVar));

        


      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Неделя');
      data.addColumn('number', 'Реальный ряд');
      data.addColumn('number', 'Хольтер-Винтерс');
      data.addColumn('number', 'Продолжение реального ряда');

      data.addRows([]);
      
      for (var i = 0; i <= prediction.length - 1; i++) {

        if ((i >= realdata.length - 1) && ($('#js-input-type').data('current') == 1)) {
          data.addRows([[i, realdata[i], bestPrediction[i], realdataFore[i]]]);
        }
        else {
          data.addRows([[i, realdata[i], bestPrediction[i], undefined]]);
        }
        
      }

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' },
          series: {
            4: {
              annotations: {
                textStyle: {fontSize: 12, color: 'green' }
              }
            }
          }
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart'));

        chart.draw(data, options);
        
      }


      // Interface /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      // Кнопка прибавления
function pe_increment() {

    var typeSystem = ["Не продлевать", "Продлить"];
    var myOptions = ["Очень низкий", "Низкий", "Номинальный", "Высокий", "Очень высокий"];

    obj = $(this).parent().prev('input');
    current = obj.data('current');
    max = obj.data('max');


    current = parseFloat(current);
    max = parseFloat(max);
    var curVal = parseFloat(obj.val());

//    Обработчик для поля количество строк
    if (obj.data('type') == 'kdsi') {
        if (curVal+0.05 < 1){
            obj.val(precise_round(curVal+ 0.05, 2));
        }
        else{
            obj.val(0.99);
            $(this).attr('disabled',true);
        }
    }

    if (current+1 < max) {
//      Проверка: Кнопка принадлежит выбору типа системы или опций системы
        if (obj.data('type') == 'type-system') {
            obj.val(typeSystem[current+1].toString());
        }
        else {
            obj.val(myOptions[current+1].toString())
        }

        obj.data('current', current+1);
//        Отдельный else для отключения функционирования кнопки
    } else if (current+1 == max) {
        if (obj.data('type') == 'type-system') {
            obj.val(typeSystem[current+1].toString());
        }
        else {
            obj.val(myOptions[current+1].toString())
        }
        obj.data('current', current+1);
        $(this).attr('disabled',true);
    }
    $(this).prev('button').attr('disabled',false);

    // recalculate_widget();
    drawChart();   
}







//  Кнопка убавления
function pe_decrement() {

    var typeSystem = ["Не продлевать", "Продлить"];
    var myOptions = ["Очень низкий", "Низкий", "Номинальный", "Высокий", "Очень высокий"];

    obj = $(this).parent().prev('input');
    current = obj.data('current');
    max = obj.data('max');
    min = obj.data('min');

    current = parseFloat(current);
    max = parseFloat(max);
    if (min == undefined) {min = 0} else {min = parseFloat(min)}

//    Обработчик для поля количество строк
    if (obj.data('type') == 'kdsi') {
        if (obj.val()-0.05 > 0){
            obj.val(precise_round(obj.val()-0.05, 2));
        }
        else{
            obj.val(0.01);
            $(this).attr('disabled',true);
        }

    }

    if (current-1 > min & obj.data('type') != 'kdsi') {
//      Проверка: Кнопка принадлежит выбору типа системы или опций системы
        if (obj.data('type') == 'type-system') {
            obj.val(typeSystem[current-1].toString());
        }
        else {
            obj.val(myOptions[current-1].toString())
        }

        obj.data('current', current-1);
//        Отдельный else для отключения функционирования кнопки
    } else if (current-1 == min) {
        if (obj.data('type') == 'type-system') {
            obj.val(typeSystem[current-1].toString());
        }
        else {
            obj.val(myOptions[current-1].toString())
        }
        obj.data('current', current-1);
        $(this).attr('disabled',true);

    }
    $(this).next('button').attr('disabled',false);

    // recalculate_widget();
    drawChart();    
}

//  Кнопка убавления
function optimize() {

    optimised = 0;
    drawChart();    
}





// // Animated bar chart
// $(function() {
//   $("#bars li .bar").each( function( key, bar ) {
//     var percentage = Math.round(parseFloat($('#js-out-stagework'+key).text()) / parseFloat($('#js-out-stagetime'+key).text()));
    
//     $(this).animate({
//       'height' : percentage + '%'
//     }, 1000);
//   });
// });


$(function() {

    $('.js-increment').click(pe_increment);
    $('.js-decrement').click(pe_decrement);

    $('.js-widget-input').change(function() {
        // recalculate_widget();
        drawChart();
    });
});


    </script>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
  </head>
  <body>

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">

<div class="row">


    <main>
        <h3 align="center">Сезонный метод прогнозирования Хольта-Винтерса</h3>
           <div id="curve_chart" style="width: 700px; height: 300px"></div>





        <table class="table table-hover pe-blog-post"> 
            <tr>
                <th>Сглаживание</th>
                <th>Тренд</th>
                <th><strong>Сезонность</strong></th>
                <th>Среднеквадратичное отклонение</th>
            </tr>
            <tr>
                <td><var id="js-out-alpha">0.97</var></td>
                <td><var id="js-out-beta">0.97</var></td>
                <td><var id="js-out-gamma">0.13</var></td>
                <td><var id="js-out-avgErr">5000</var></td>
            </tr>
        </table>
    </main>



    
  
  <div class="pe-blog-post">
    <div class="form-group col-sm-4">
    <label for="js-input-kdsi" class="control-label small text-muted">Коэффициент сглаживания</label>
    <div class="input-group suffix">
        <!--                            <span class="suffix">%</span>-->
        <input type="number" tabindex="2" id="js-input-alpha" name="js-input-alpha"
               class="form-control mrs mbs js-widget-input"
               data-type="kdsi" pattern="^(?=.)([+-]?([0-9]*)(\.([0-9]+))?)$" data-target="#js-in-RELY" value="0.01">
        <div class="input-group-btn">
            <button type="button" class="btn btn-default js-decrement" tabindex="-1">–</button>
            <button type="button" class="btn btn-default js-increment" tabindex="-1">+</button>
        </div>
    </div>
  </div>

  <div class="form-group col-sm-4">
    <label for="js-input-kdsi" class="control-label small text-muted">Коэффициент тренда</label>

    <div class="input-group suffix">
        <!--                            <span class="suffix">%</span>-->
        <input type="number" tabindex="2" id="js-input-beta" name="js-input-beta"
               class="form-control mrs mbs js-widget-input"
               data-type="kdsi" pattern="^(?=.)([+-]?([0-9]*)(\.([0-9]+))?)$" data-target="#js-in-RELY" value="0.97">

        <div class="input-group-btn">
            <button type="button" class="btn btn-default js-decrement" tabindex="-1">–</button>
            <button type="button" class="btn btn-default js-increment" tabindex="-1">+</button>
        </div>
    </div>
  </div>

  <div class="form-group col-sm-4">
    <label for="js-input-kdsi" class="control-label small text-muted">Коэффициент сезонности</label>

    <div class="input-group suffix">
        <!--                            <span class="suffix">%</span>-->
        <input type="number" tabindex="2" id="js-input-gamma" name="js-input-gamma"
               class="form-control mrs mbs js-widget-input"
               data-type="kdsi" pattern="^(?=.)([+-]?([0-9]*)(\.([0-9]+))?)$" data-target="#js-in-RELY" value="0.13">

        <div class="input-group-btn">
            <button type="button" class="btn btn-default js-decrement" tabindex="-1">–</button>
            <button type="button" class="btn btn-default js-increment" tabindex="-1">+</button>
        </div>
    </div>
  </div>

  <div class="form-group col-sm-6">
      <label for="js-input-type" class="control-label small text-muted">Продлить реальный ряд:</label>

      <div class="input-group prefix suffix">
          <!--                            <span class="prefix">$</span>-->
          <!--                            <span class="suffix">M</span>-->
          <input type="text" tabindex="1" id="js-input-type" name="js-input-type"
                 class="form-control mrs mbs js-widget-input"
                 data-current="0" data-max="1" data-type="type-system" pattern="\d*" data-target="#js-in-kdsi"
                 value="Не продлевать"
                 disabled style="cursor: default; background: #ffffff;">

          <div class="input-group-btn">
              <button type="button" class="btn btn-default js-decrement" tabindex="-1" disabled>–</button>
              <button type="button" class="btn btn-default js-increment" tabindex="-1">+</button>
          </div>
      </div>
  </div>

  <div class="col-sm-6">
      <input type="submit" tabindex="6" onClick="optimize()" class="form-control mts btn btn-primary btn-block" value="Оптимизация" id="calculate-btn">
  </div>

</div>
</div>
</div>
</div>
</div>



  </body>
</html>