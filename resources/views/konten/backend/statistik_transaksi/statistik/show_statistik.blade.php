 <script src="/plugins/highcharts/highcharts.js"></script>
 <script src="/plugins/highcharts/modules/exporting.js"></script>




<div id="statistik-penjualan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">

       $(function () {
        console.log(getAllUrlParams().bln);
            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                },
                colors: [ '#F97C00', '#5B79EA'],
        
            });

            $('#statistik-penjualan').highcharts({
                chart: {
                    zoomType: 'xy'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Statistik Penjualan Bulan Juni 2016'
                },
    //             subtitle: {
                   
    //                 text: 'Total Keuntungan ' + "Rp0" + ' (' + 0 + ' Item Terjual)'
                // },
                xAxis: [{
                    title: {
                        text: 'Tanggal',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    categories: [
                        @foreach($transaksi as $tgl => $jml)
                            "{!! $tgl !!}",
                        @endforeach
                    ],
                    crosshair: true
                }],
                yAxis: [
                 
                { // Primary yAxis
                    labels: {
                        format: '',

                        style: {
                            color: Highcharts.getOptions().colors[0]

                        },
                        formatter: function () {
                            return 'Rp ' + Highcharts.numberFormat(this.value,0);
                        }
                    },
                    title: {
                        text: 'Nominal Transaksi',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true

                }, 
                                { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Produk Terjual',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value} item',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }

                }],
                tooltip: {
                    shared: true,
                    borderColor: '#bbbbbb',
                    shadow: false,
                    useHTML: true,
                    headerFormat: 'Tanggal {point.key}<table>',
                    pointFormat: '<tr><td style="color: {series.color}"><b>{series.name}</b>: </td>' +
                        '<td style="text-align: right"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                },

                legend: {
                    layout: 'horizontal',
                    align: 'left',
                    lineHeight: 16,
                    x: 0,
                    verticalAlign: 'top',
                   lineHeight: 50,
                    y: 0,
                    // floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                series: [ 
                                
                {
                    name: 'Nominal Transaksi',
                    type: 'column',
                     yAxis: 0,
                    data: [
                        @foreach($transaksi_tunai as $tgl => $nominal)  
                            {!! $nominal !!},
                        @endforeach
                    ],
                    tooltip: {
                        valuePrefix: 'Rp '
                    }
                },
                {
                    name: 'Produk Terjual',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @foreach($transaksi as $tgl => $jml)
                            @if($jml == '')
                                0,
                            @else
                                {!! $jml !!},
                            @endif
                        @endforeach
                    ],
                    tooltip: {
                        valueSuffix: ' Item'
                    }

                }
                                
                ]
            });
            
            
        });

 function getAllUrlParams(url) {

  // get query string from url (optional) or window
  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

  // we'll store the parameters here
  var obj = {};

  // if query string exists
  if (queryString) {

    // stuff after # is not part of query string, so get rid of it
    queryString = queryString.split('#')[0];

    // split our query string into its component parts
    var arr = queryString.split('&');

    for (var i = 0; i < arr.length; i++) {
      // separate the keys and the values
      var a = arr[i].split('=');

      // set parameter name and value (use 'true' if empty)
      var paramName = a[0];
      var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

      // (optional) keep case consistent
      paramName = paramName.toLowerCase();
      if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

      // if the paramName ends with square brackets, e.g. colors[] or colors[2]
      if (paramName.match(/\[(\d+)?\]$/)) {

        // create key if it doesn't exist
        var key = paramName.replace(/\[(\d+)?\]/, '');
        if (!obj[key]) obj[key] = [];

        // if it's an indexed array e.g. colors[2]
        if (paramName.match(/\[\d+\]$/)) {
          // get the index value and add the entry at the appropriate position
          var index = /\[(\d+)\]/.exec(paramName)[1];
          obj[key][index] = paramValue;
        } else {
          // otherwise add the value to the end of the array
          obj[key].push(paramValue);
        }
      } else {
        // we're dealing with a string
        if (!obj[paramName]) {
          // if it doesn't exist, create property
          obj[paramName] = paramValue;
        } else if (obj[paramName] && typeof obj[paramName] === 'string'){
          // if property does exist and it's a string, convert it to an array
          obj[paramName] = [obj[paramName]];
          obj[paramName].push(paramValue);
        } else {
          // otherwise add the property
          obj[paramName].push(paramValue);
        }
      }
    }
  }

  return obj;
}

</script>