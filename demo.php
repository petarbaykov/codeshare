<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/editor.css">
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <script src="js/global.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
 
 </head>
 <body>
<nav id="navigation">
  
    <div class="logo" >
      <a href="index.php"><img id="logo" src="images/logo2_03.png"></a>
     
    </div>
    <div class="menus" id="menus">
      <ul>
        <a href="index.php"><li>Начало</li></a>
       
        <a href="" id=""><li>Запази</li></a>
        <a href="login.php"><li>Вход</li></a>
        <a href="register.php"><li>Регистрация</li></a>

      </ul>

    </div>
   
  </nav>
  <div class="editor-area">
    
<aside>
  <ul>
    <li><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
    <li><a href="#" class="run" ><span class="glyphicon glyphicon-play" aria-hidden="true"></a></li>
      <li><a href="#" ><span class="glyphicon glyphicon-save" aria-hidden="true"></a></li>
     <li><a href="#" ><span class="glyphicon glyphicon-share-alt"></span></a></li>
</aside>

 <div class="fields">
 <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#html" aria-controls="home" role="tab" data-toggle="tab">HTML</a></li>
    <li role="presentation"><a href="#css" aria-controls="profile" role="tab" data-toggle="tab">CSS</a></li>
    <li role="presentation"><a href="#js" aria-controls="messages" role="tab" data-toggle="tab">JavaScript</a></li>
    
  </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="html">
     <section id="editor" class="edit edit-active">
        <textarea class="editor html"><!-- HTML goes here--></textarea>
      </section>
    </div>
    <div role="tabpanel" class="tab-pane" id="css">
      <section id="editor" class="edit">
          <textarea class="editor css">/*CSS goes here */</textarea>
     </section>
    </div>
    <div role="tabpanel" class="tab-pane" id="js">
       <section id="editor" class="edit">
    <textarea class="editor js">//JS goes here</textarea>
  </section>
    </div>
 
</div>
 </div>



<div class="result">
   <iframe src="" id="preview">
      <!DOCTYPE html>
      <html>
      <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      </head>
      <body>
      
      </body>
      </html>
    </iframe>
</div>


       
         </div>
 </body>
</html>
