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
									<?= $this->Form->input('id', array('type'=>'hidden'))?>
									<?= $this->Form->input('username',array('label'=>'Tên tài khoản'))?>
									<?= $this->Form->input('email')?>
								</div>
							</section>
						</div>
						<div class="small-6 columns">
							<section>
								<div class="column">
									<?php
									if (strpos($this->request->data['User']['picture'],"graph.facebook.com") !== false)
										echo $this->Html->image('https://'.$this->request->data['User']['picture']);
									else
										echo $this->Html->image('../files/user/picture/' . $this->request->data['User']['picture_dir'] . '/thumb_' . $this->request->data['User']['picture'])
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
									<?= $this->Form->create('User', array('id'=>'PassForm'))?>
									<?= $this->Form->input('password', array('label'=>'Mật khẩu', 'id'=>'validate_password'))?>
									<?= $this->Form->input('confirm_password', array('type'=>'password', 'label'=>'Nhập lại mật khẩu'))?>
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

<script>
	$(document).ready(function () {

		$("#UserEditForm").validate({
			errorElement: "em",
			errorPlacement: function (error, element) {
				$(element.parent("div").addClass("form-animate-error"));
				error.appendTo(element.parent("div"));
			},
			success: function (label) {
				$(label.parent("div").removeClass("form-animate-error"));
			},
			rules: {
				'data[User][username]': {
					required: true,
					minlength: 6
				},
				'data[User][password]': {
					required: true,
					minlength: 6
				},
				'data[User][confirm_password]': {
					required: true,
					minlength: 6,
					equalTo: "#validate_password"
				},
				'data[User][email]': {
					required: true,
					email: true
				}
			},
			messages: {
				'data[User][username]': {
					required: "Hãy nhập tên tài khoản",
					minlength: "Tên tài khoản phải có ít nhất 6 kí tự"
				},
				'data[User][password]': {
					required: "Hãy nhập vào mật khẩu",
					minlength: "Mật khẩu phải có ít nhất 6 kí tự"
				},
				'data[User][confirm_password]': {
					required: "Hãy nhập lại mật khẩu",
					minlength: "Mật khẩu phải có ít nhất 6 kí tự",
					equalTo: "Hãy nhập mật khẩu giống ở trên"
				},
				'data[User][email]':{
					required: "Hãy nhập địa chỉ email",
					email: "Địa chỉ email không hợp lệ"
				}
			}
		});

		$("#PassForm").validate({
			errorElement: "em",
			errorPlacement: function (error, element) {
				$(element.parent("div").addClass("form-animate-error"));
				error.appendTo(element.parent("div"));
			},
			success: function (label) {
				$(label.parent("div").removeClass("form-animate-error"));
			},
			rules: {
				'data[User][password]': {
					required: true,
					minlength: 6
				},
				'data[User][confirm_password]': {
					required: true,
					minlength: 6,
					equalTo: "#validate_password"
				}
			},
			messages: {
				'data[User][password]': {
					required: "Hãy nhập vào mật khẩu",
					minlength: "Mật khẩu phải có ít nhất 6 kí tự"
				},
				'data[User][confirm_password]': {
					required: "Hãy nhập lại mật khẩu",
					minlength: "Mật khẩu phải có ít nhất 6 kí tự",
					equalTo: "Hãy nhập mật khẩu giống ở trên"
				}
			}
		});

	});
</script>