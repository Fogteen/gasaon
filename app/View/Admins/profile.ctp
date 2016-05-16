<div id="content" class="profile-v1">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Thông tin cá nhân</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 profile-v1-wrapper">
        <div class="col-md-12  profile-v1-cover-wrap" style="padding-right:0px;">
            <div class="profile-v1-pp">
                <?php
                if (strpos($profile['User']['picture'], "graph.facebook.com") !== false)
                    echo $this->Html->image('https://' . $profile['User']['picture'], array('alt'=>'user name', 'data-toggle'=>'dropdown'));
                else
                    echo $this->Html->image('../files/user/picture/' . $profile['User']['picture_dir'] . '/thumb_' . $profile['User']['picture'],array('alt'=>'user name', 'data-toggle'=>'dropdown'))
                ?>
                <h2><?php echo $profile['User']['username'] ?></h2>
                <?php echo $this->Html->link('Chỉnh sửa tải khoản', array('action'=>'edit',$profile['User']['id']), array('class'=>'btn btn-danger')) ?>
            </div>
            <div class="col-md-12 profile-v1-cover">
                <img src="/img/../img/bg1.jpg" class="img-responsive">
            </div>
        </div>
    </div>
</div>