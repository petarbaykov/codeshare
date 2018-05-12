<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12 news-content detail">
		<?php 
			if(isset($_GET['post_id'])){
				$post_id = $_GET['post_id'];
				$post = $DB_con->prepare("SELECT * from blog_posts where post_id=:post_id");
				$post->execute(array(":post_id"=>$post_id));
				$single_post = $post->fetch(PDO::FETCH_ASSOC);
				$title = $single_post['post_title'];
				$post_date = $single_post['post_date'];
				$post_user = $single_post['user_id'];
				$post_image = $single_post['post_image'];
				$post_content = $single_post['post_content'];
				$post_tags = $single_post['post_tags'];
				$tags = explode(',',$post_tags);
				$user = $DB_con->prepare("SELECT * from users where user_id=:user_id");
				$user->execute(array(":user_id"=>$post_user));
				$user_data = $user->fetch(PDO::FETCH_ASSOC);
				$user_image = $user_data['avatar'];
				$fname = $user_data['fname'];
				$lname = $user_data['lname'];
				$name = $fname . " ". $lname;
				?>
				<h2><?php echo $title ?></h2>
				 <div class="user-date-wrap">
	                <span class="date-wrap table-holder">
	                    <span class="icon-holder cell">
	                        <i class="fa fa-calendar"></i>
	                    </span>
	                    <span class="post-date cell"><?php echo $post_date?></span>
	                </span>
	                <span class="user-wrap">
	                    <span class="user-avatar">
	                        <a href="">
	                            <img src="../images/<?php echo $user_image?>" alt="avatar">
	                        </a>
	                    </span>
	                    <span class="cell">
	                        <a class="user-name" href=""><?php echo $name; ?></a>
	                    </span>
	                </span>
				 </div>
				 <div class="article-image">		
					<img src="../images/<?php echo $post_image?>">				
	 			</div>
	 			<span><?php echo $post_content ?></span>
	 			<div class="row">
				                    <div class="col-md-8 col-sm-12 col-xs-12 tags-wrapper">
				                        <h3 class="sidebar-title">Тагове</h3>
				                        <ul class="list-tags">
				                            <?php foreach ($tags as $tag ) {
				                            	?>
				                            	<li><a href=""><?php echo $tag?></a></li>
				                            	<?php
				                            } ?>
				   							
				                        </ul>
				                    </div>
				                </div>
				<?php
			}

		?> 
	</div>
	<aside class="col-md-offset-1 col-md-3 col-sm-12 col-xs-12 aside-content">
		<h3 class="sidebar-title">Архив новини</h3>
		<h3>Последни статии</h3>
	</aside>		
</div>
