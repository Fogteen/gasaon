<?php $this->layout = false?>
<head>
	<style type="text/css">
		body{
			font-family: 'Love Ya Like A Sister', cursive;
		}
		body{
			background:#eaeaea;
		}
		.wrap{
			margin:0 auto;
			width:1000px;
		}
		.logo{
			text-align:center;
			margin-top:200px;
		}
		.logo img{
			width:350px;
		}
		.logo p{
			color:#272727;
			font-size:40px;
			margin-top:1px;
		}
		.logo p span{
			color:lightgreen;
		}
		.sub {
			margin: 20px;
		}
		.sub a{
			color:#fff;
			background:#272727;
			text-decoration:none;
			padding:10px 20px;
			font-size:13px;
			font-family: arial, serif;
			font-weight:bold;
			-webkit-border-radius:.5em;
			-moz-border-radius:.5em;
			-border-radius:.5em;
		}
	</style>
</head>


<body>
<div class="wrap">
	<div class="logo">
		<p>LỖI KẾT NỐI</p>
<!--		<img src="/img/../img/500.png"/>-->
		<div class="sub">
			<?php if ($this->params['controller'] != 'admins') {?>
				<a href="<?php echo $this->Html->url(array('controller'=>'homes', 'action'=>'index'))?>">Trang chủ </a>
			<?php } else ?>
			<a href="<?php echo $this->Html->url(array('controller'=>'admins', 'action'=>'home'))?>">Trang chủ </a>
		</div>
	</div>
</div>

</body>