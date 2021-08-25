<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> 
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
  <body>
    <div class="container p-3 my-3 bg-dark text-white">
        <center><h1>62111687 APAPORN THIPSAVAK</h1></center> 
    </div>>
 <center> <div class="container">
      <center><div class="row">
        <div class="col-8">
          <canvas id="myChart" width="400" height="200"></canvas>
        </div>
      <div class="row">
        <div class="col-8">
          <canvas id="Chart" width="400" height="200"></canvas>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-4">
          <div class="row">
              <div class="col-4">
                <b>Temperature</b>
              </div>
               <div class="col-8">
                  <b><span id="lastTempearature"></span></b>
               </div> 
          </div>
          <div class="row">
            <div class="col-4">
              <b>Humadity</b>
            </div>
             <div class="col-8">
                <b><span id="lastHumadity"></span></b>
             </div> 
        </div>
        <div class="row">
          <div class="col-4">
            <b>Update</b>  
          </div>
           <div class="col-8">
          <b><span id="lastUpdate"></span></b> 
           </div> 
      </div>

      </div>
  </div></center>
    
  </body>
  <script>
     function showChart(data,xlabel,id,label){      
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart (ctx, {
            type: 'line',
            data: {
                labels: xlabel,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: 'rgb(255, 99, 71)',
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false,
                    tension: 0.1,
                }]
            }
    
        });
      }
      
      function loaData(xlabel,data_1,data_2,url){
        $.getJSON(url,function( data) {
             let feeds = data.feeds;
              $("#lastTempearature").text(feeds[0].field2+" C");
              $("#lastHumadity").text(feeds[0].field1+" %");
              $("#lastUpdate").text(feeds[0].created_at);
        $.each(feeds, (k, v)=>{
              xlabel.push(v.entry_id);
              data_1.push(v.field1);
              data_2.push(v.field2);
        });
        });  
      }

$(
    ()=>{
          var plot_data = Object();
          var xlabel=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
          var data_1=[];
          var data_2=[];
          var id_1 = 'myChart';  
          var id_2 = 'Chart';
          var label_1 = 'Humadity';
          var label_2 = 'Tempearature';
          let url = "https://api.thingspeak.com/channels/1458419/feeds.json?results=20";
       
      loaData(xlabel,data_1,data_2,url);
      showChart(data_1,xlabel,id_1,label_1);
      showChart(data_2,xlabel,id_2,label_2); 
      })     
  </script>
  </script>
</html>
