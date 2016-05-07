<!-- start: content -->
<div id="content">
	<div class="panel">
		<div class="panel-body">
			<div class="col-md-12 col-sm-12">
				<h3 class="animated fadeInLeft">Quản lý thành viên</h3>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12 panel">
			<div class="col-md-12 panel-heading">
				<h4>Chỉnh sửa thông tin thành viên</h4>
			</div>
			<div class="col-md-12 panel-body" style="padding-bottom:30px;">
				<div class="col-md-12">
					<?php
					echo $this->Form->create('User',array('type'=>'file','id'=>'signupForm'));
					?>
					<div class="col-md-6">
						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							echo $this->Form->input('username',array('id'=>'validate_username','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
							?>
							<span class="bar"></span>
							<label>Tên tài khoản</label>
						</div>

						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							echo $this->Form->input('email',array('id'=>'validate_email','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
							?>
							<span class="bar"></span>
							<label>Email</label>
						</div>

						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							echo $this->Form->input('role', array('id'=>'validate_type','type' => 'select','label'=>false,'div'=>false, 'options' => array(0=>'Thành viên',1=>'Quản trị viên'),'empty'=>'Chọn loại tài khoản'));
							?>
							<span class="bar"></span>
						</div>


					</div>

					<div class="col-md-6">

						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							echo $this->Form->input('password',array('id'=>'validate_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
							?>
							<span class="bar"></span>
							<label>Mật khẩu</label>
						</div>

						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
							?>
							<span class="bar"></span>
							<label>Xác nhận mật khẩu</label>
						</div>

						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<?php
							if (strpos($user['User']['picture'], "graph.facebook.com") !== false)
								echo $this->Html->image('https://' . $user['User']['picture']);
							else
								echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture']);
							echo $this->Form->input('picture',array('type' => 'file','label'=>false,'div'=>false));
							echo $this->Form->input('picture_dir',array('type' => 'hidden'));
							?>
						</div>


					</div>
					<div class="col-md-12">
						<input class="submit btn btn-success" type="submit" value="Submit">
						<?php echo $this->Html->link('Hủy', array('action'=>'listuser'), array('class'=>'btn btn-danger')) ?>
					</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: content -->
<!-- start: right menu -->
<div id="right-menu">
	<ul class="nav nav-tabs">
		<li class="active">
			<a data-toggle="tab" href="#right-menu-user">
				<span class="fa fa-comment-o fa-2x"></span>
			</a>
		</li>
		<li>
			<a data-toggle="tab" href="#right-menu-notif">
				<span class="fa fa-bell-o fa-2x"></span>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="right-menu-user" class="tab-pane fade in active">
			<div class="search col-md-12">
				<input type="text" placeholder="search.."/>
			</div>
			<div class="user col-md-12">
				<ul class="nav nav-list">
					<li class="online">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-mobile-phone fa-2x"></span>
						</div>
						<div class="dot"></div>
					</li>
					<li class="away">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-desktop"></span>
						</div>
						<div class="dot"></div>
					</li>
					<li class="offline">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="dot"></div>
					</li>
					<li class="offline">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="dot"></div>
					</li>
					<li class="online">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-mobile-phone fa-2x"></span>
						</div>
						<div class="dot"></div>
					</li>
					<li class="offline">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="dot"></div>
					</li>
					<li class="online">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-mobile-phone fa-2x"></span>
						</div>
						<div class="dot"></div>
					</li>
					<li class="offline">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="dot"></div>
					</li>
					<li class="offline">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="dot"></div>
					</li>
					<li class="online">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-mobile-phone fa-2x"></span>
						</div>
						<div class="dot"></div>
					</li>
					<li class="online">
						<img src="../img/avatar.jpg" alt="user name">
						<div class="name">
							<h5><b>Bill Gates</b></h5>
							<p>Hi there.?</p>
						</div>
						<div class="gadget">
							<span class="fa  fa-mobile-phone fa-2x"></span>
						</div>
						<div class="dot"></div>
					</li>

				</ul>
			</div>
			<!-- Chatbox -->
			<div class="col-md-12 chatbox">
				<div class="col-md-12">
					<a href="#" class="close-chat">X</a><h4>Akihiko Avaron</h4>
				</div>
				<div class="chat-area">
					<div class="chat-area-content">
						<div class="msg_container_base">
							<div class="row msg_container send">
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_sent">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
							</div>

							<div class="row msg_container receive">
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_receive">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
							</div>

							<div class="row msg_container send">
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_sent">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
							</div>

							<div class="row msg_container receive">
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_receive">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
							</div>

							<div class="row msg_container send">
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_sent">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
							</div>

							<div class="row msg_container receive">
								<div class="col-md-3 col-xs-3 avatar">
									<img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
								</div>
								<div class="col-md-9 col-xs-9 bubble">
									<div class="messages msg_receive">
										<p>that mongodb thing looks good, huh?
											tiny master db, and huge document store</p>
										<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="chat-input">
					<textarea placeholder="type your message here.."></textarea>
				</div>
				<div class="user-list">
					<ul>
						<li class="online">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<div class="user-avatar"><img src="../img/avatar.jpg" alt="user name"></div>
								<div class="dot"></div>
							</a>
						</li>
						<li class="offline">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="away">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="online">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="offline">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="away">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="offline">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="offline">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="away">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="online">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="away">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
						<li class="away">
							<a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
								<img src="../img/avatar.jpg" alt="user name">
								<div class="dot"></div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="right-menu-notif" class="tab-pane fade">

			<ul class="mini-timeline">
				<li class="mini-timeline-highlight">
					<div class="mini-timeline-panel">
						<h5 class="time">07:00</h5>
						<p>Coding!!</p>
					</div>
				</li>

				<li class="mini-timeline-highlight">
					<div class="mini-timeline-panel">
						<h5 class="time">09:00</h5>
						<p>Playing The Games</p>
					</div>
				</li>
				<li class="mini-timeline-highlight">
					<div class="mini-timeline-panel">
						<h5 class="time">12:00</h5>
						<p>Meeting with <a href="#">Clients</a></p>
					</div>
				</li>
				<li class="mini-timeline-highlight mini-timeline-warning">
					<div class="mini-timeline-panel">
						<h5 class="time">15:00</h5>
						<p>Breakdown the Personal PC</p>
					</div>
				</li>
				<li class="mini-timeline-highlight mini-timeline-info">
					<div class="mini-timeline-panel">
						<h5 class="time">15:00</h5>
						<p>Checking Server!</p>
					</div>
				</li>
				<li class="mini-timeline-highlight mini-timeline-success">
					<div class="mini-timeline-panel">
						<h5 class="time">16:01</h5>
						<p>Hacking The public wifi</p>
					</div>
				</li>
				<li class="mini-timeline-highlight mini-timeline-danger">
					<div class="mini-timeline-panel">
						<h5 class="time">21:00</h5>
						<p>Sleep!</p>
					</div>
				</li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>

		</div>
	</div>
</div>
<!-- end: right menu -->
</div>
