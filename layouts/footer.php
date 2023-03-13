        <footer>          
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
  
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.js"></script>
    <script src="vendors /datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Switchery -->
      <script src="vendors/switchery/dist/switchery.min.js"></script>

    <!-- Input mask -->
    <script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

    <!-- Echarts -->
    <script src="vendors/echarts/dist/echarts.min.js"></script>

    <script src="build/js/custom.js"></script>

    <!-- Custom Theme Scripts -->

    <script type="text/javascript">
        $(document).ready(function(){

        <?php if ($page == 'home'){?>
            if( typeof (echarts) === 'undefined'){ return; }
                console.log('init_echarts');

              var theme = {
              color: [
                  '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
                  '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
              ],

              title: {
                  itemGap: 8,
                  textStyle: {
                      fontWeight: 'normal',
                      color: '#408829'
                  }
              },

              dataRange: {
                  color: ['#1f610a', '#97b58d']
              },

              toolbox: {
                  color: ['#408829', '#408829', '#408829', '#408829']
              },

              tooltip: {
                  backgroundColor: 'rgba(0,0,0,0.5)',
                  axisPointer: {
                      type: 'line',
                      lineStyle: {
                          color: '#408829',
                          type: 'dashed'
                      },
                      crossStyle: {
                          color: '#408829'
                      },
                      shadowStyle: {
                          color: 'rgba(200,200,200,0.3)'
                      }
                  }
              },

              dataZoom: {
                  dataBackgroundColor: '#eee',
                  fillerColor: 'rgba(64,136,41,0.2)',
                  handleColor: '#408829'
              },
              grid: {
                  borderWidth: 0
              },

              categoryAxis: {
                  axisLine: {
                      lineStyle: {
                          color: '#408829'
                      }
                  },
                  splitLine: {
                      lineStyle: {
                          color: ['#eee']
                      }
                  }
              },

              valueAxis: {
                  axisLine: {
                      lineStyle: {
                          color: '#408829'
                      }
                  },
                  splitArea: {
                      show: true,
                      areaStyle: {
                          color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                      }
                  },
                  splitLine: {
                      lineStyle: {
                          color: ['#eee']
                      }
                  }
              },
            };

             
            if ($('#echart_line').length ){ 
              
              
              var echartLine = echarts.init(document.getElementById('echart_line'), theme);

              echartLine.setOption({
                title: {
                  text: 'Statistiques générales',
                  subtext: 'Client | Produits | Achat '
                },
                tooltip: {
                  trigger: 'axis'
                },
                legend: {
                  x: 200,
                  y: 10,
                  data: ['Clients', 'Produits', 'Achats']
                },
                toolbox: {
                  show: true,
                  feature: {
                    magicType: {
                      show: true,
                      title: {
                        line: 'Ligne',
                        bar: 'Barre',
                        stack: 'Petit',
                        tiled: 'Large'
                      },
                      type: ['line', 'bar', 'stack', 'tiled']
                    },
                    restore: {
                      show: true,
                      title: "Rétablir"
                    },
                    saveAsImage: {
                      show: true,
                      title: "Enregister l'image"
                    }
                  }
                },
                calculable: true,
                xAxis: [{
                  type: 'category',
                  boundaryGap: false,
                  data: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']
                }],
                yAxis: [{
                  type: 'value'
                }],
                series: [{
                  name: 'Achats',
                  type: 'line',
                  stack: 'stack',
                  smooth: true,
                  itemStyle: {
                    normal: {
                      areaStyle: {
                        type: 'default'
                      }
                    }
                  },
                  data: [12,13,15,18,25,50,72]
                }, {
                  name: 'Produits',
                  type: 'line',
                  stack: 'stack',
                  smooth: true,
                  itemStyle: {
                    normal: {
                      areaStyle: {
                        type: 'default'
                      }
                    }
                  },
                  data: [12,13,15,18,25,50,72]
                }, {
                  name: 'Clients',
                  type: 'line',
                  stack: 'stack',
                  smooth: true,
                  itemStyle: {
                    normal: {
                      areaStyle: {
                        type: 'default'
                      }
                    }
                  },
                  data: [12,13,15,18,25,50,72]
                }                
                ]
              });

            } 
        })
        <?php } ?>
    </script>
  </body>
</html>
