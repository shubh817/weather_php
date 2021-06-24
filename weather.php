<?php
$status="";
$msg="";
$city="";
if(isset($_POST['submit'])){
    $city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=a45b20cefe427582ad3c61013481a08f";

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css"rel="stylesheet"/>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>

    <title>Weather Website</title>
  </head>
  <style>
         @import url(https://fonts.googleapis.com/css?family=Poiret+One);
         @import url(https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css);
  </style>
   
  <body style="background-color:#E4E4E4;">
    
    <!--header-->
    <nav class="navbar navbar-light" style="background-color: #717679 ;">
        <span class="navbar-brand mb-0 h1" style="margin-left: 40%;color:white;">Welcome To Weather App</span>
    </nav>
    <!-- header end-->
    <div class="container-xs" style="margin-top:50px;overflow: hidden;">
        <!--input field-->
        <form method="post">
            <div class="row">
                <div class="col-5" style="margin-left:24%;">
                <input class="form-control mr-sm-2" type="search" placeholder="Enter City Name" name="city" aria-label="Search" style="">
                </div>
                <div class="col-3">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"name="submit" value="submit" style="margin-left:-5px;">Search</button>
                </div>
            </div>
        </form>

        <!-- cards-->
        <?php if($status=="yes"){?>
        <article class="widget">
        
        <div class="card mb-3" style="max-width: 730px;margin-top: 30px;margin-left: 24.5%;">
            <div class="row">
                <div class="col-md-4 weatherIcon" >
                    
                    <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png"/>

                </div>
                <div class="col-md-8"  style="background-color: #19568A;color:white;">
                    <div class="card-body">
                        <div class="weatherInfo">
                            <div class="temperature">
                                <span style="font-size:60px;font-family: Poiret One;font-weight:bold;"><?php echo round($result['main']['temp']-273.15)?>°C</span>
                                <span style="font-size:30px;margin-left: 120px;font-family: Poiret One;"><?php echo date('d M, Y',$result['dt'])?> </span>
                            </div>
                            <div class="description row">
                                <div class="col">
                                    <div class="weatherCondition" style="font-family: Poiret One;font-size: 30px;"><?php echo $result['weather'][0]['main']?></div>
                                    <div class="place" style="font-family: Poiret One;"><?php echo $result['name']?></div>
                                </div>
                                <div class="col" style="margin-left: 50px;">
                                    <div class="weatherCondition" style="font-family: Poiret One;font-size: 30px;">Wind</div>
                                    <div class="place" style="font-family: Poiret One;"><?php echo $result['wind']['speed']?> M/H</div> 
                                </div>
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- card end-->
        </article>
        <?php } ?>
        
    </div>
     <!-- Footer Work-->
     <div class="container-xs" style="background-color:#620F27;">
        
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>