<?php 
  $codes = $DB_con->prepare("SELECT code_id from codes");
  $codes->execute();
  $code_coun = $codes->fetchAll();
  $code_counter = count($code_coun);

   $users = $DB_con->prepare("SELECT user_id from users");
  $users->execute();
  $user_count = $users->fetchAll();
  $user_counter = count($user_count);
?>


<footer>
  			
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
	  	</footer>