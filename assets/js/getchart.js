income = {

    initChartist: function(num, inc0, inc1, inc2, inc3, inc4, inc5, inc6, inc7, inc8, inc9, inc10,
                                inc11, inc12, inc13, inc14, inc15, inc16, inc17, inc18, inc19, inc20, 
                                inc21, inc22, inc23, inc24, inc25, inc26, inc27, inc28, inc29, inc30){
                
        if(num == 28){
            var data = {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
                     '11', '12', '13', '14', '15', '16', '17', '18', '19', '10',
                     '21', '22', '23', '24', '25', '26', '27', '28'
                    ],
            series: [
              [inc0, inc1, inc2, inc3, inc4, inc5, inc6, inc7, inc8, inc9, inc10,
               inc11, inc12, inc13, inc14, inc15, inc16, inc17, inc18, inc19, inc20, 
               inc21, inc22, inc23, inc24, inc25, inc26, inc27]
            ]
          };
        }
        if(num == 30){
            var data = {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
                     '11', '12', '13', '14', '15', '16', '17', '18', '19', '10',
                     '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'
                    ],
            series: [
              [inc0, inc1, inc2, inc3, inc4, inc5, inc6, inc7, inc8, inc9, inc10,
               inc11, inc12, inc13, inc14, inc15, inc16, inc17, inc18, inc19, inc20, 
               inc21, inc22, inc23, inc24, inc25, inc26, inc27, inc28, inc29]
            ]
          };
        }
        if(num == 31){
            var data = {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
                     '11', '12', '13', '14', '15', '16', '17', '18', '19', '10',
                     '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', 
                     '31'
                    ],
            series: [
              [inc0, inc1, inc2, inc3, inc4, inc5, inc6, inc7, inc8, inc9, inc10,
               inc11, inc12, inc13, inc14, inc15, inc16, inc17, inc18, inc19, inc20, 
               inc21, inc22, inc23, inc24, inc25, inc26, inc27, inc28, inc29, inc30]
            ]
          };
        }

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Line('#chartIncome', data, options, responsiveOptions);
    }
}