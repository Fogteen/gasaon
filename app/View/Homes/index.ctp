<?php if (empty($account)) { ?>
    <div class="row full">
        <section class="jumbo">
            <div class="row">
                <div class="large-12 columns">
                    <h1>THAM GIA VÀO THƯ VIỆN SÁCH TRỰC TUYẾN MIỄN PHÍ</h1>
                    <p class="text-center">
                        <a href="#" id="res" class="medium button">ĐĂNG KÝ NGAY</a>
                    </p>

                </div>
            </div>
        </section>
    </div>
<?php } else { ?>
    <div class="row">
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:false;
                  ">
            <li><img src="../img/bg1.jpg"> </li>
            <li><img src="../img/bg2.jpg"></li>
        </ul>
    </div>
<?php } ?>
<div class="row">
    <div class="large-12 columns">
        <div>
            <h4 style="float:left;margin-bottom: 20px;padding-top:20px;color:grey">XEM NHIỀU NHẤT</h4>
        </div>
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
            <?php foreach ($mostview as $key => $ebook) {
                if ($key % 4 == 0) { ?>
                    <li>
                    <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } elseif ($key % 4 != 3) { ?>
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } else { ?>
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                    </ul>
                <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="large-12 columns">
        <div>
            <h4 style="float:left;margin-bottom: 20px;padding-top:20px;color:grey">TẢI XUỐNG NHIỀU NHẤT</h4>
        </div>
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
            <?php foreach ($mostdown as $key => $ebook) {
                if ($key % 4 == 0) { ?>
                    <li>
                    <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } elseif ($key % 4 != 3) { ?>
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } else { ?>
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                    </ul>
                <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>