<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses'],
      ['2004',  1000,      400],
      ['2005',  1170,      460],
      ['2006',  660,       1120],
      ['2007',  1030,      540],
        ['2000','400', '900'],
        ['2001','500', '800'],
        ['2002','600', '700'],
        ['2003','700', '600'],
        ['2004','800', '500'],
        ['2005','700', '400'],
        ['2006','600', '500'],
        ['2007','500', '600'],
        ['2008','400', '700'],
        ['2009','500', '800'],
        ['2010','600', '700'],
        ['2011','700', '600'],
        ['2012','800', '500'],
        ['2013','900', '400'],
    ]);

    var options = {
      title: 'Company Performance',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                   <!--  Your Application's Landing Page.
                    <hr>
                    Login: admin@site.com
                    <br>
                    Password: password
                    <br> -->     
                    <div id="curve_chart" style="width: 900px; height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
</div>