
<header class="header">
	<h1 class="main-header">Account Settings</h1>
</header>
<section class="secondary-tabs">
	<div class="row collapse">
		<div class="small-12 columns">
			<ul class="tabs" data-tab>
				<li class="tab-title active"><a href="#panel-1">Profile</a></li>
				<li class="tab-title"><a href="#panel-2"></i>Account</a></li>
			</ul>
			<div class="tabs-content">
				<div class="content active" id="panel-1">
					<div class="row">
						<h4 class="title">Thông tin cá nhân</h4>
						<div class="small-6 columns">
							<section>
								<div class="column">
									<?= $this->Form->create('User',array('type' => 'file'))?>
									<?= $this->Form->input('username')?>
								</div>
							</section>
						</div>
						<div class="small-6 columns">
							<section>
								<div class="column">
									<?php
									if (strpos($user['User']['picture'],"graph.facebook.com") !== false)
										echo $this->Html->image('https://'.$user['User']['picture']);
									else
										echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture'])
									?>
									<?= $this->Form->input('picture',array('type' => 'file'))?>
									<?= $this->Form->input('picture_dir',array('type' => 'hidden'))?>
									<?= $this->Form->end('Save')?>
								</div>
							</section>
						</div>
					</div>
				</div>
				<div class="content" id="panel-2">
					<div class="row">
						<h4 class="title">Thông tin đăng nhập</h4>
						<div class="small-8 columns">
							<section>
								<div class="column">
									<?= $this->Form->create('User')?>
									<?= $this->Form->input('email')?>
									<?= $this->Form->input('password')?>
									<?= $this->Form->end('Save')?>
								</div>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
