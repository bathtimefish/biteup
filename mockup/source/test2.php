<?php
	$userName = $_POST["rows"][0]["userName"];
	$userID = $_POST["rows"][0]["userID"];
	$message = $_POST["rows"][0]["message"];
	$li = '<li>
						<a href="#">
						<p class="commentAvatar"><img src="img/dummy/dummy_avatar.png"></p>
						<div class="detail">
							<h2>'.$userName.'</h2>
							<p class="text">'.$message.'</p>
							<p class="times">5分前</p>
						</div>
						</a>
					</li>';
	print( $li );

?>