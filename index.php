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
        <div class="col-12">
          <canvas id="myChart" width="400" height="200"></canvas>
        </div>
      <div class="row">
        <div class="col-12">
          <canvas id="Chart" width="400" height="200"></canvas>
        </div>
        <div class="row">
            <div class="col-12">
              <canvas id="Chartlight" width="400" height="200"></canvas>
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
            <b>Light</b>  
          </div>
           <div class="col-8">
          <b><span id="lastlight"></span></b> 
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
        
    function showChart(data){
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx,{
            type:'line',
            data:{
                labels:data.xlabel,
                datasets:[{
                    label:data.label,
                    data:data.data,
                    backgroundColor: 'rgb(255, 99, 71)',
                    borderColor: 'rgb(75, 192, 192)',
                }]
            }
        });
    }

    function TempChart(data_2){
        var ctxy = document.getElementById("Chart").getContext("2d");
        var myChart = new Chart(ctxy,{
            type:'line',
            data:{
                labels:data_2.xlabel,
                datasets:[{
                    label:data_2.label,
                    data:data_2.data,
                    backgroundColor: 'rgb(255, 99, 71)',
                    borderColor: 'rgb(75, 192, 192)',
                }]
            }
        });
    }

    function LightChart(data_3){
        var ctxy = document.getElementById("Chartlight").getContext("2d");
        var myChart = new Chart(ctxy,{
            type:'line',
            data:{
                labels:data_3.xlabel,
                datasets:[{
                    label:data_3.label,
                    data:data_3.data,
                    backgroundColor: 'rgb(255, 99, 71)',
                    borderColor: 'rgb(75, 192, 192)',
                }]
            }
        });
    }

    $(()=>{
        let url = "https://api.thingspeak.com/channels/1458419/feeds.json?results=240";
        $.getJSON(url)
            .done(function(data){
                let feed = data.feeds;
                let ch = data.channel;


                const d = new Date(feed[239].created_at);
                    const monthNames = ["January","February","March","April","May","July","August","September","October","November","December"];
                    let dateStr = d.getDate()+" "+monthNames[d.getMonth()]+" "+d.getFullYear();
                    dateStr += " "+d.getHours()+":"+d.getMinutes();


            $("#lastTempearature").text(feed[239].field2+ " C");
                $("#lastHumadity").text(feed[239].field1+ " %");
                $("#lastlight").text(feed[239].field3 );
                $("#lastUpdate").text(dateStr);

                var plot_data = Object();
                var xlabel = [];
                var T = [];
                var H = [];
                var L =[];

                $.each(feed,(k,v)=>{
                    xlabel.push(v.field4 +":"+ v.field5);
                    H.push(v.field1);
                    T.push(v.field2);
                    L.push(v.field3)
                });
                var data = new Object();
                data.xlabel = xlabel;
                data.data = T;
                data.label = ch.field2;
              

                var data_2 = new Object();
                data_2.xlabel = xlabel;
                data_2.data = H;
                data_2.label = ch.field1;
               

                var data_3 = new Object();
                data_3.xlabel = xlabel;
                data_3.data = L;
                data_3.label = ch.field3;
               

                showChart(data);
                TempChart(data_2);
                LightChart(data_3);



            });
    });
</script>
</html>
