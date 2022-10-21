$(function(){
    "use strict";    

    // notification popup
    // toastr.options.closeButton = true;
    // toastr.options.positionClass = 'toast-top-right';
    // toastr.options.showDuration = 10;
    // toastr['info']('Hello, welcome to Mooli.'); 
    

    // Total Revenue
    var plot = $.plot('#flotChart', [{
        data: flotSampleData1,
        color: '#0392cf',
        lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
        }},
        {
            data: flotSampleData2,
            color: '#82b440',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
            }
        }],{
        series: {
            shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 1,
                fill: true
            }
        },
        grid: {
            borderWidth: 0,
            labelMargin: 8
        },
        yaxis: {
            show: true,
                min: 0,
                max: 100,
            ticks: [[0,''],[20,'500'],[40,'1000'],[60,'1500'],[80,'2000'],[90,'2500'],[100,'3000']],        
        },
        xaxis: {
            show: true,
            ticks: [[5,'JAN 21'],[10,'JAN 22'],[15,'JAN 23'],[20,'JAN 24'],[25,'JAN 25'],[30,'JAN 26'],[35,'JAN 27'],[40,'JAN 28'],[45,'JAN 29']],
        }
    });

    
    // Death & Recovery rate
    var chart = c3.generate({
        bindto: '#chart-bar-stacked', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 110, 81, 158, 108, 149, 217],
                ['data2', 70, 192, 75, 97, 219, 152]
            ],
            type: 'bar', // default type of chart
            groups: [
                [ 'data1', 'data2']
            ],
            colors: {
                'data1': '#9367B4',
                'data2': '#0392cf',
            },
            names: {
                // name of each serie
                'data1': 'Recovery',
                'data2': 'Death'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
        },
        bar: {
            width: 10
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0,
            left: 6,
        },
    });

    //multiple comparison series
    var chart = c3.generate({
        bindto: '#chart-donut-d', // id of chart wrapper
        data: {
            type: 'donut', // default type of chart

            columns: [
                // each columns data
                ['data1', 20],
                ['data2', 30],
                ['data3', 50]
            ],            
            colors: {
                'data1': '#82b440',
                'data2': '#0392cf',
                'data3': '#9367b4',
            },
            names: {
                // name of each serie
                'data1': 'Cancelled',
                'data2': 'Completed',
                'data3': 'Pending',
            }
        },
        axis: {
        },
        legend: {
            show: false, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });
    var chart = c3.generate({
        bindto: '#chart-bar-rotated', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 11, 8, 15, 18, 19, 17],
                ['data2', 7, 7, 5, 7, 9, 12]
            ],
            type: 'bar', // default type of chart
            colors: {
                'data1': '#82b440',
                'data2': '#0392cf',
            },
            names: {
                // name of each serie
                'data1': 'New Patients',
                'data2': 'Old Patients'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['USA', 'UK', 'India', 'UAE', 'Canada', 'Other']
            },
            rotated: true,
        },
        bar: {
            width: 10
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });
    

    
    
    // world map
    if( $('#world-map-markers').length > 0 ){

        $('#world-map-markers').vectorMap( {
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            borderColor: '#fff',
            borderOpacity: 0.25,
            borderWidth: 0,
            color: '#e6e6e6',
            regionStyle : {
                initial : {
                fill : '#e2e4e7'
                }
            },
            markerStyle: {
                initial: {
                    r: 5,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 1,
                    'stroke-opacity': 0.4
                },
            },
        
            markers : [{
                latLng : [21.00, 78.00],
                name : 'INDIA : 350'            
            },
                {
                latLng : [36.77, -119.41],
                name : 'USA : 250'                
            },              
                {
                latLng : [-35.473469, 149.012375],
                name : 'AU : 39'            
            }],

            series: {
                regions: [{
                    values: {
                        "US": '#82b440',
                        "IN": '#61bda1',
                        "AU": '#0392cf',                        
                    },
                    attribute: 'fill'
                }]
            },

            hoverOpacity: null,
            normalizeFunction: 'linear',
            zoomOnScroll: false,
            scaleColors: ['#000000', '#000000'],
            selectedColor: '#000000',
            selectedRegions: [],
            enableZoom: false,
            hoverColor: '#fff',
        });
    }
});


function getRandomData(totalPoints = 250, start = 50) {
    var data = [];

    // Do a random walk
    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : start;
        var y = prev + Math.random() * 10 - 5;

        if(y < 0) { y = Math.random() * 10; }
        else if(y > 100) { y = 80; }

        data.push(y);
    }

    // Zip the generated y values with the x values
    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}

//hide link control

$(document).on('click', '.hide_link', function() {

      $('.loadingDiv').show();

      // CSRF Hash

      var csrfName = $('.txt_csrfname').attr('name');

      var csrfHash = $('.txt_csrfname').val();

      var link_id = $(this).attr('id');
     
      $.ajax({

          url: BASE_URL + '/AjaxController/hide_link',

          type: 'post',

          data: { link_id: link_id, [csrfName]: csrfHash },

          dataType: 'json',

          success: function(result) {

              if (result.response == true) {

                  $(".status-updated").text(result.message);

                  $(".alert2-success").show();

                  $('.loadingDiv').hide();

                  window.location.reload();


              } else {

                  $(".status-error").text(result.message);

                  $(".alert2-danger").show();

                  $('.loadingDiv').hide();
              }

              $('input[name="csrf_test_name"]').val(result.token);

              $('.txt_csrfname').val(result.token);

          }

      });

    });
$(document).on('click', '.show_link', function() {

      $('.loadingDiv').show();

      // CSRF Hash

      var csrfName = $('.txt_csrfname').attr('name');

      var csrfHash = $('.txt_csrfname').val();

      var link_id = $(this).attr('id');
     
      $.ajax({

          url: BASE_URL + '/AjaxController/show_link',

          type: 'post',

          data: { link_id: link_id, [csrfName]: csrfHash },

          dataType: 'json',

          success: function(result) {

              if (result.response == true) {

                  $(".status-updated").text(result.message);

                  $(".alert2-success").show();

                  $('.loadingDiv').hide();

                  window.location.reload();


              } else {

                  $(".status-error").text(result.message);

                  $(".alert2-danger").show();

                  $('.loadingDiv').hide();
              }

              $('input[name="csrf_test_name"]').val(result.token);

              $('.txt_csrfname').val(result.token);

          }

      });

    });
$(document).on('change', '#countryname', function(){  
         

          var countryname = $('#countryname').children("option:selected").val();
          
        
           //$('.loadingDiv').show();

      // CSRF Hash

      var csrfName = $('.txt_csrfname').attr('name');

      var csrfHash = $('.txt_csrfname').val();
            
                $.ajax({  
                     url: BASE_URL + '/AjaxController/country_ajax',  

                     type: 'post',

                     data: {countryname: countryname, [csrfName]: csrfHash },

                     dataType: 'json', 

                     success:function(result)  
                     {  
                      if (result.response == true) {
                        if(result.states != ''){

                            $("#states").html(result.states);

                        }else{

                        }

                      } else {

                        $(".states").text();

                        $(".states").show();
                      }

                      $('input[name="csrf_test_name"]').val(result.token);

                      $('.txt_csrfname').val(result.token);
                          
                     }  
                });  
          
      }); 
$(document).on('change', '.month-selector', function(){  
         

          var month = $('.month-selector').children("option:selected").val();
          
        
           //$('.loadingDiv').show();

      // CSRF Hash

      var csrfName = $('.txt_csrfname').attr('name');

      var csrfHash = $('.txt_csrfname').val();
            
                $.ajax({  
                     url: BASE_URL + '/AjaxController/monthwisedataajax',  

                     type: 'post',

                     data: {month: month, [csrfName]: csrfHash },

                     dataType: 'json', 

                     success:function(result)  
                     {  
                      if (result.response == true) {
                        if(result.monthwisearray != ''){

                            $(".monthwisedata").html(result.monthwisearray);

                        }else{

                        }

                      } else {

                        $(".monthwisedata").text();

                        $(".monthwisedata").show();
                      }

                      $('input[name="csrf_test_name"]').val(result.token);

                      $('.txt_csrfname').val(result.token);
                          
                     }  
                });  
          
      }); 
$(document).on('change', '.payment_method', function(){  
         

    var payment_method = $('.payment_method').children("option:selected").val();
    
    if(payment_method == 'upi'){
        $('.upi_form').show();
        $('.paypal_form').hide();
        $('.paytm_form').hide();
        $('.bank_form').hide();
    }else if(payment_method == 'paypal'){
        $('.upi_form').hide();
        $('.paypal_form').show();
        $('.paytm_form').hide();
        $('.bank_form').hide();
    }else if(payment_method == 'paytm'){
        $('.upi_form').hide();
        $('.paypal_form').hide();
        $('.paytm_form').show();
        $('.bank_form').hide();
    }else if(payment_method == 'bank'){
        $('.upi_form').hide();
        $('.paypal_form').hide();
        $('.paytm_form').hide();
        $('.bank_form').show();
    }     
        
          
}); 

// Validate phone
    $("#phoneno").on("keyup", function(){
        $('.notphoneno').hide();   
        var mob = $('#phoneno').val();
        var filtermob = /^\d*(?:\.\d{1,2})?$/;

          if (filtermob.test(mob)) {
            if(mob.length==10){
              $('.notphoneno').hide();
              $("#phoneno").removeClass("hidden");
              $("#phoneno").addClass("hidden");
             } else {
              $('.notphoneno').show();
               $('.notphoneno').text('Please put 10  digit mobile number');
               $("#phoneno").removeClass("hidden");
               $("#phoneno").addClass("hidden");
              }
            }
            else {
              $('.notphoneno').show();
              $('.notphoneno').text('Not a valid number');
              $("#phoneno").removeClass("hidden");
              $("#phoneno").addClass("hidden");
           }
    
  });
    // Validate zipcode
    $("#zipcode").on("keyup", function(){
        $('.notzipcode').hide();   
        var mob = $('#zipcode').val();
        var filtermob = /^\d*(?:\.\d{1,2})?$/;

          if (filtermob.test(mob)) {
            if(mob.length==10){
              $('.notzipcode').hide();
              $("#zipcode").removeClass("hidden");
              $("#zipcode").addClass("hidden");
             } else {
              $('.notzipcode').show();
               $('.notzipcode').text('Please put 6 digit Zipcode');
               $("#zipcode").removeClass("hidden");
               $("#zipcode").addClass("hidden");
              }
            }
            else {
              $('.notzipcode').show();
              $('.notzipcode').text('Not a valid number');
              $("#zipcode").removeClass("hidden");
              $("#zipcode").addClass("hidden");
           }
    
  });

var flotSampleData1 = [
    [0,53.08330533680049],
    [1,50.33339517545416],
    [2,49.4029746664779],
    [3,47.791939081203566],
    [4,49.09471219192674],
    [5,50.66529743518582],
    [6,48.749718825997206],
    [7,48.84333276982059],
    [8,53.51394720398375],
    [9,52.93467940905747],
    [10,49.083909652316756],
    [11,50.27480737843102],
    [12,48.37957308101624],
    [13,44.84022012471776],
    [14,40.71830916489318],
    [15,41.24962375997834],
    [16,45.63889630450356],
    [17,44.66117259629492],
    [18,41.393918522372914],
    [19,38.20495807999945],
    [20,39.68970488580452],
    [21,41.02366924388095],
    [22,39.41137193753915],
    [23,35.66049049363585],
    [24,38.5316402746093],
    [25,38.536952802123125],
    [26,40.69853423533536],
    [27,38.79970643855877],
    [28,42.98845795943349],
    [29,46.360136088412915],
    [30,43.5528691841886],
    [31,40.65605934650181],
    [32,36.5040222131244],
    [33,31.79517009935011],
    [34,28.913911507798105],
    [35,29.681580006957674],
    [36,29.57017024157237],
    [37,33.13695968240512],
    [38,37.084637076369454],
    [39,35.86922272605444],
    [40,37.60007436604805],
    [41,39.6599902960551],
    [42,39.01855935146662],
    [43,34.101066517369006],
    [44,37.486228204869676],
    [45,39.29733687111992],
    [46,38.46411897069526],
    [47,37.71927995665536],
    [48,40.15208911247334],
    [49,35.897096450476575],
    [50,31.505997358944384],
    [51,31.816999110802946],
    [52,30.50460962834996],
    [53,25.741310049337464],
    [54,28.23602445151448],
    [55,28.48317685385772],
    [56,30.001070495921475],
    [57,32.164958534602505],
    [58,32.99295659942683],
    [59,37.68193430054417],
    [60,35.24212764591677],
    [61,39.18772362995824],
    [62,41.376347845481895],
    [63,41.45950716612605],
    [64,43.78985456358012],
    [65,39.416694565047884],
    [66,39.32972776309515],
    [67,43.80480524720717],
    [68,42.434410137245514],
    [69,43.67300580223356],
    [70,38.79887604059381],
    [71,43.570128406921526],
    [72,41.81988828932836],
    [73,44.829528785933896],
    [74,46.19223595854988],
    [75,47.69550173883899],
    [76,49.010522215031536],
    [77,46.40480781018069],
    [78,51.28051836395483],
    [79,50.158430192052556],
    [80,53.60466613842059],
    [81,56.08734803007076],
    [82,52.72459300615355],
    [83,56.601951946760394],
    [84,60.26245067204903],
    [85,58.36945168202019],
    [86,56.59491823723127],
    [87,55.755294545253776],
    [88,54.74810139653445],
    [89,54.27203682664068],
    [90,58.659985887413185],
    [91,57.00658547275452],
    [92,60.52029839853601],
    [93,57.6015284629649],
    [94,56.48890586246457],
    [95,55.10455188969404],
    [96,54.357265081931686],
    [97,52.394359471010326],
    [98,54.52899302331695],
    [99,54.16762513026156],
    [100,51.95657669321307],
    [101,51.19677107897459],
    [102,46.35100350085707],
    [103,48.33623433000422],
    [104,45.84986413510889],
    [105,48.22054173701362],
    [106,43.30402458869659],
    [107,45.823705773087944],
    [108,43.48498341409474],
    [109,41.32116785138174],
    [110,40.99342590634263],
    [111,38.496913606221845],
    [112,40.10010461807938],
    [113,44.861885054292394],
    [114,44.03401133327108],
    [115,41.41251651321317],
    [116,37.800397369625514],
    [117,39.295001424962734],
    [118,35.24310363081255],
    [119,32.125154958611844],
    [120,35.68772234352005],
    [121,38.00169527592055],
    [122,37.960866448524754],
    [123,38.702527394097245],
    [124,37.457771477588224],
    [125,37.51129389195443],
    [126,33.108727543689724],
    [127,35.09710598798716],
    [128,33.11742126933996],
    [129,31.873922447406848],
    [130,29.18642792871095],
    [131,31.91579925678714],
    [132,34.370661166914054],
    [133,32.91433174216821],
    [134,33.17197835246117],
    [135,37.16446574836367],
    [136,32.60291809386715],
    [137,36.94627368938524],
    [138,35.9869296328639],
    [139,38.12898104938889],
    [140,42.55368007736426],
    [141,41.57493569939069],
    [142,45.54394197350075],
    [143,46.30674824728742],
    [144,45.73213644396193],
    [145,45.42768540578047],
    [146,42.52964420434585],
    [147,44.44398524408891],
    [148,39.74894644038498],
    [149,44.71669577260144]
];
var flotSampleData2 = [
    [0,36.57749563156254],
    [1,38.990117798360984],
    [2,42.33951429212372],
    [3,41.81299261981016],
    [4,37.43049180497279],
    [5,32.50742948537699],
    [6,28.15321230561721],
    [7,24.734038382708317],
    [8,23.48248771261796],
    [9,20.406002456692214],
    [10,16.59886277727973],
    [11,12.156859927914581],
    [12,9.229765251904174],
    [13,5.183401848384374],
    [14,9.605706708466142],
    [15,10.832074796645134],
    [16,13.268792742800557],
    [17,18.216203428328363],
    [18,13.963666987062208],
    [19,18.712081450016612],
    [20,13.72401606510321],
    [21,11.305095416130975],
    [22,13.773906992422056],
    [23,15.834031310396583],
    [24,12.926545228583812],
    [25,17.595569228566347],
    [26,21.90850212276817],
    [27,18.29990271583387],
    [28,14.340994854410802],
    [29,18.22389641710976],
    [30,14.883609800856053],
    [31,13.019139849150623],
    [32,14.553083951054631],
    [33,15.417025583778472],
    [34,16.640872368623782],
    [35,19.456813236353057],
    [36,14.595960349995135],
    [37,17.729784515799526],
    [38,13.86824197051369],
    [39,9.492952801660538],
    [40,11.912479814449945],
    [41,9.798782954230068],
    [42,6.117552232900492],
    [43,1.4130313413037507],
    [44,2.3640186232524685],
    [45,2.3620174492590778],
    [46,4.523611468529182],
    [47,3.7627065666017216],
    [48,5.7686167365911043],
    [49,5.08594242151745846],
    [50,1.905264426860338],
    [51,8.27642052341136036],
    [52,7.9183672429606382],
    [53,5.027341617316905],
    [54,2.8449308083068967],
    [55,6.827661569105635],
    [56,6.215632967625112],
    [57,9.831855054294463],
    [58,9.393752601741996],
    [59,11.962549642491954],
    [60,10.01016629019579],
    [61,9.03698508678906],
    [62,6.053332776990388],
    [63,4.56216961329746],
    [64,2.7601184969979364],
    [65,4.345620131013858],
    [66,3.6626759042117385],
    [67,4.27936456640813],
    [68,2.0166954203189142],
    [69,1.4881023513956224],
    [70,3.7196511214339196],
    [71,1.5333390837655454],
    [72,5.780072548768565],
    [73,4.904719814229008],
    [74,1.0799012554825165],
    [75,4.72338119051706],
    [76,6.314725021867233],
    [77,4.277597816664166],
    [78,5.1544567140954225],
    [79,5.239845249502064],
    [80,3.877879174711641],
    [81,8.225872226683242],
    [82,7.264487465012946],
    [83,6.504325850409032],
    [84,1.7088839316517497],
    [85,11.49433994707275364],
    [86,10.5002886069980867],
    [87,3.8186248032905223],
    [88,4.790166662214078],
    [89,8.584014466610698],
    [90,10.231484497623207],
    [91,11.085662593015236],
    [92,15.692957864072707],
    [93,19.729820239992353],
    [94,18.14728404932766],
    [95,13.557879905430191],
    [96,12.0222003194338],
    [97,7.527743748664358],
    [98,3.7125580070986235],
    [99,9.7561429229810717],
    [100,9.24510598794585],
    [101,13.491288627936356],
    [102,18.422574259759138],
    [103,22.48813237262491],
    [104,18.7617308169055],
    [105,15.200987690731651],
    [106,14.567673790440317],
    [107,14.493364129654488],
    [108,12.06862995100759],
    [109,13.792354597964184],
    [110,13.398123710429495],
    [111,15.43357006142243],
    [112,15.838711304223441],
    [113,17.717113116366015],
    [114,14.363451521168152],
    [115,10.632076034419065],
    [116,12.704986280918988],
    [117,14.730515775966076],
    [118,18.64339616589121],
    [119,22.966268490839116],
    [120,18.086847938929818],
    [121,22.85442941807395],
    [122,23.862425058129165],
    [123,27.15039006269054],
    [124,24.7853194960341],
    [125,20.05439683907793],
    [126,22.789014412927482],
    [127,20.999064905231663],
    [128,16.665833423656743],
    [129,15.119579474719686],
    [130,13.122059029397477],
    [131,10.758963293991616],
    [132,11.409391406435187],
    [133,13.187657409342435],
    [134,10.191416382864197],
    [135,9.299880450312266],
    [136,9.200558705463123],
    [137,10.3761519864489],
    [138,15.201427613560849],
    [139,12.563611410586677],
    [140,14.01025663372129],
    [141,18.218049208936158],
    [142,16.36071205382429],
    [143,17.780867922487836],
    [144,18.918372217382256],
    [145,15.30583162112299],
    [146,18.133034345626925],
    [147,16.378646720850767],
    [148,14.835942770608781],
    [149,10.041195447639177]
];