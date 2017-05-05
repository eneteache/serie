<?php 
include('../navegacion.php')
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    
    
    
    
    
    
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="photo-gallery.js"></script>
  </head>
  <style>
      ul {         
          padding:0 0 0 0;
          margin:0 0 0 0;
      }
      ul li {     
          list-style:none;
          margin-bottom:0px;           
      }
      ul li img {
          cursor: pointer;
      }
      .modal-body {
          padding:5px !important;
      }
      .modal-content {
          border-radius:0;
      }
      .modal-dialog img {
          text-align:center;
          margin:0 auto;
      }
    .controls{          
        width:50px;
        display:block;
        font-size:11px;
        padding-top:8px;
        font-weight:bold;          
    }
    .next {
        float:right;
        text-align:right;
    }
      /*override modal for demo only*/
      .modal-dialog {
          max-width:500px;
          padding-top: 30px;
      }
      @media screen and (min-width: 768px){
          .modal-dialog {
              width:500px;
              padding-top: 90px;
          }          
      }
      @media screen and (max-width:1500px){
          #ads {
              display:none;
          }
      }
  </style>
  <body>    
    <div class="container">    
        <div class="row" style="text-align:center; border-bottom:1px dashed #ccc;  padding:0 0 20px 0; margin-bottom:40px;">
            <h3 style="font-family:arial; font-weight:bold; font-size:30px;">
                Bootstrap Photo Gallery jQuery Plugin Example
        </h3>
        <div class="jquery-script-ads" align="center">
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
        </div>
        
        <ul class="row">
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="../imagenes/acer1.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="../imagenes/acer2.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-460760-colors-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-461673-retro-party-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-514834-touchscreen-technology-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-916206-legal-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-1062948-nature-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-1471528-insant-camera-kid-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2255072-relaxed-man-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2360379-colors-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2360571-jump-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2361384-culture-for-business-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2441670-spaghetti-with-tuna-fish-and-parsley-s.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-2943363-budget-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-3444921-street-art-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-3552322-insurance-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-3807845-food-s.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-3835655-down-office-worker-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-4619216-ui-control-knob-regulators-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-5771958-health-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-268693-businesswoman-using-laptop-outdoors-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-352207-search-of-code-s.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-247190-secret-email-xs.jpg">
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="images/photodune-682990-online-search-xs.jpg">
            </li>
          </ul>             
    </div> <!-- /container -->
    
     
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
  </body>


  
</html>
