<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
 
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


  <script>
  $(function(){
      $('.tab-panels .tabs li').on('click', function(){


        var $panel = $(this).closest('.tab-panels');
        $panel.find('.tabs li.active').removeClass('active');
        $(this).addClass('active');
         var panelToShow = $(this).attr('rel');
         $panel.find('.panel.active').show(300, showNextPanel);
         function showNextPanel(){
          $(this).removeClass('active');
          $('#' + panelToShow).hide(300, function(){
              $(this).addClass('active');
          });
         }
       });
  });
      
  </script>
  <style type="text/css">
    .tab-panels ul{
      margin:0;
      padding: 0;
    }
    .tab-panels ul li{
      list-style: none;
      display: inline-block;
      background:#999;
      margin:0;
      padding:3px 10px;
      border-radius: 10px 10px 0 0;
      color:#fff;
      font-weight: 200;
      cursor: pointer;
    }
    .tab-panels ul li.active{
      color:#fff;
      background:#666;

    }
    .tab-panels .panel{
      display: none;
      background:#ccc;
      padding: 30px;

    }
    .tab-panels .panel.active{
      display: block;
    }
  </style>
</head>
<body>
  <div class="tab-panels">
    <ul class="tabs">
      <li rel="panel1" class="active">panel1</li>
       <li rel="panel2" >panel1</li>
        <li rel="panel3" >panel1</li>


    </ul>
    <div id="panel1" class="panel active">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation
    </div>
    <div id="panel2" class="panel ">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur
    </div>
    <div id="panel3" class="panel ">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
  </div>

 
 
</body>
</html