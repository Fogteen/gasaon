<header class="header">
	<h1 class="main-header">Cài đặt tài khoản</h1>
</header>
<section class="secondary-tabs">
	<div class="row collapse">
		<div class="small-12 columns">
			<ul class="tabs" data-tab>
				<li class="tab-title active"><a href="#panel-1">Thông tin cá nhân</a></li>
				<li class="tab-title"><a href="#panel-2"></i>Thông tin đăng nhập</a></li>
			</ul>
			<div class="tabs-content">
				<div class="content active" id="panel-1">
					<div class="row">
						<div class="small-6 columns">
							<section>
								<div class="column">
									<?= $this->Form->create('User',array('type' => 'file'))?>
									<?= $this->Form->input('username',array('label'=>'Tên tài khoản'))?>
									<?= $this->Form->input('email')?>
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
									<?= $this->Form->input('picture',array('type' => 'file', 'label'=>'Hình đại diện'))?>
									<?= $this->Form->input('picture_dir',array('type' => 'hidden'))?>
								</div>
							</section>
						</div>
					</div>
					<div class="columns">
						<?php
						$options = array(
							'label' => 'Lưu',
							'div' => false,
							'class' => 'button tiny success'
						);
						echo $this->Form->end($options);
						?>
					</div>
				</div>
				<div class="content" id="panel-2">
					<div class="row">
						<div class="small-8 columns">
							<section>
								<div class="column">
									<?= $this->Form->create('User')?>
									<?= $this->Form->input('password', array('label'=>'Mật khẩu'))?>
									<?= $this->Form->input('repassword', array('type'=>'password', 'label'=>'Nhập lại mật khẩu'))?>
									<?php
									$options = array(
										'label' => 'Lưu',
										'div' => false,
										'class' => 'button tiny success'
									);
									echo $this->Form->end($options);
									?>
								</div>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
