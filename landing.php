<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="jquery.fullPage.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<style type="text/css">
	body{
		  font-family: 'Ubuntu Mono';
	}
		.section{
			text-align: center;
			
		}
		.section #logo{
			width:400px;
		}
		.section header .text{
			float: left;
			color:#fff;
			width: 489px;
		}
		h1, h3{
			font-weight: lighter;
		}
		.section header .text a#demo{
			display: inline-block;
			color:#fff;
			background:#27A841;
			text-decoration: none;
			padding: 20px;
			border-radius: 25px;
			font-size: 20px;
			margin: 25px 0;
		}
		.section header .text a.auth{
			display: inline-block;
			color:#fff;
			font-size: 20px;
			border:2px solid #F59E17;
			text-decoration: none;
			padding: 20px;
			transition: all 0.5s ease;
			margin-top: 15px;
			margin-right: 35px;
		}
		.section header .text a.auth:hover{
			display: inline-block;
			color:#fff;
			background:#F59E17;
			border:2px solid #F59E17;
			text-decoration: none;
			transition: all 0.5s ease;
		}
		.section header img{
			float: right;
			width: 600px;
			margin-right: 50px;
		}
		section.main{
  clear:both;
  margin:25px auto;
	width:1140px;
}
 section.main article{
  float: left;
  width: 380px;
  margin-top: 25px;
  text-align: center;
  padding-bottom: 30px;
}
 section.main article h3{
  color:#333333;
}
section.main article p{
  color:#746F6F;
  font-size: 16px;
}
 section.main article .fa{
  font-size: 30px;
  border-radius: 50%;
  color:#fff;
  
}
 section.main article .fa-code{
  background:#3B3C3B;
  padding: 25px;
}
 section.main article .fa-share-alt{
  background:#EC5959;
  padding: 25px 28px;
}
 section.main article .fa-users{
  background:cornflowerblue;
  padding: 25px ;
}
 footer{

  margin-top:65px;
  color:#d3d3d3;
  overflow: hidden;
}
 footer  section{
  width:33%;
  float: left;
  padding-top: 40px;
  height: 200px;
  text-align: left;
}
 footer  .first-footer{
  height: 400px;
  background:#333639;
}
 footer .first-footer p{
  display: inline-block;
  font-size: 16px;

}
 footer .first-footer p.more{
  display: inline-block;
  font-size: 24px;
margin-top: 10px;
}
 footer .first-footer a i{
  float: right;
  font-size: 50px;
  font-weight: lighter;
  color:#d3d3d3;
  padding: 2px 22px;
  border:1px solid #d3d3d3;
  border-radius: 50%;
  width:60px;
  height: 60px;
}
 footer  .second-footer{
  height: 100px;
  background:#1d1f20;
  padding: 45px;
}
 footer .container section ul{
  margin: 0;
  padding: 0;
}
 footer .container section img{
  width:250px;
}
 footer .container section .input-group{
  display: table;
}
 footer .container section .input-group input{
  height: 50px;
  width: 360px;
  margin-top: 25px;
}
 footer .container section .input-group input[type=email]{
  background:#4b4d4f;
  color:#a9a9a9;
}
 footer .container section .input-group input[type=submit]{
  border:0;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
  outline: none;
  background:#ff5c16;
  color:#fff;
  font-size: 18px;
}
 footer  .second-footer #left{
  float: left;
} footer  .second-footer #left a{
  color:#fa5e22;
}
 footer  .second-footer .socials{
  float: right;
}
 footer  .second-footer .socials i{
  font-size: 18px;
  color:#fff;
  display: inline-block;
  margin-right: 10px;
  padding: 10px 12px;
}
 footer  .second-footer .container .socials .fa-google-plus{
  background:#e74a3e;
  border-radius: 0;

}
 footer  .second-footer .container .socials .fa-twitter{
  background:#56a3d9;
   border-radius: 0;
}
 footer  .second-footer .container .socials .fa-facebook{
  background:#3b5998;
  padding: 10px 15px;
   border-radius: 0;
}
 footer  .second-footer .container .socials .fa-instagram{
  background:#125688;
}
 footer  .second-footer .container .socials .fa-rss{
  background:#fa5e22;
}

	</style>


	
<!-- This following line is only necessary in the case of using the plugin option `scrollOverflow:true` -->
	<script type="text/javascript" src="vendors/jquery.slimscroll.min.js"></script>

	<script type="text/javascript" src="jquery.fullPage.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['home', 'secondPage', '3rdPage'],
				sectionsColor: ['#537495', '#fff', '#333639'],
				navigation: true,
				navigationPosition: 'right',
				navigationTooltips: ['Начало', 'Second page', 'Third and last page']
			});

    		
	     
		});
	</script>
</head>
<body>

	<div id="fullpage">

		<div class="section " id="section0">
			<div class="container">
				<img src="images/logo2_03.png" id="logo">
			<header>
	  			<div class="text">
	  			<h1>Добре дошли в Code Share</h1>
				<h3>Пиши и виж визуализацията на своя HTML, CSS и JavaScript код веднага</h3>
				<a href="new_code.php" id="demo">Изпробвай сега!</a><br/>
				<a href="login.php" class="auth">Вход</a>
				<a href="login.php" class="auth">Регистрация</a>
	  			</div>
	  			
				<img src="images/code-share.png">
	  		</header>
			</div>
			
		</div>
		
		<div class="section" id="section1">
		<div class="container">
		    <section class="main">
	  			
	  			<article>
	  				<i class="fa fa-code"></i>
	  				<h3>Редактирайте на живо своя код</h3>
	  				<p>Чрез нашия редактор имате възможността да пишете HTML,CSS и JavaScript код,
	  				както и да добавате различни библиотеи и препроцесори към тях</p>
	  			</article>
	  			<article>
	  				<i class="fa fa-share-alt"></i>
	  				<h3>Споделяйте своя код с хората около вас</h3>
	  				<p>Споделяйте написаният от вас код като вградите в своята уеб страница или го споделите
	  				в социалните мрежи</p>
	  			</article>
	  			<article>
	  				<i class="fa fa-users"></i>
	  				<h3>Свържете с други хора които пишат код</h3>
	  				<p>Чрез потребителската ни система имат възможността да се свързвате с други хора,
	  				да обменяте код и да пишете лични съобщения</p>
	  			</article>
	  		</section>
	  		</div>
		</div>
		<div class="section" id="section2">
			<footer>
			<div class="container">
				
			
			<div class="container contact-area">
				<form>
  				<div class="input-group">

  				</div>
  			</form>
			</div>
  			
        <div class="first-footer">
          <div class="container">
          <section>
             <img src="images/logo2_03.png">
             <p>Чрез нашия редактор имате възможността да пишете HTML,CSS и JavaScript код,
              както и да добавате различни библиотеи и препроцесори към тях</p>
             <p class="more">ПОВЕЧЕ ЗА НАС</p><a href=""><i class="fa fa-angle-right"></i></a>
          </section>
          <section>
           <h3>Последни новини от <span>Туитър</span></h3>
          </section>
          <section>
            <h3>Абонирайте за наши бюлетин</h3>
            
            <form action="subscribe.php" method="post">
              <div class="input-group">
              
              <input type="email" class="form-control" placeholder="Електронна поща" aria-describedby="basic-addon1">
            
            </div>
            <div class="input-group">
               <input type="submit" value="Абониране">
            </div>
            </form>
          </section>
        </div>
  				
  				
  				
  			</div>
        <div class="second-footer">
          <div class="container">
            <div id="left">
                Copyright &copy; 2015.<a href=""> Code Share</a> Всички права запазени
            </div>
          
              <div class="socials">
               <a href=""><i class="fa fa-google-plus"></i></a> 
                 <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                   <a href=""><i class="fa fa-instagram"></i></a>
                     <a href=""><i class="fa fa-rss"></i></a>
              </div>
          </div>
            
         </div>
         </div>
	  	</footer>
		</div>
</div>
</body>
</html>