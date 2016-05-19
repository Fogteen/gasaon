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
    <div class="row" style="margin-top: 40px">
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:false;
                  bullets:true;
                  timer:true">
            <li>
                <img src="/img/../img/slide1.jpg" alt="slide 1"/>
                <div class="orbit-caption">
                    Kho sách miễn phí.
                </div>
            </li>
            <li>
                <img src="/img/../img/slide2.jpg" alt="slide 2"/>
                <div class="orbit-caption">
                    Online mọi lúc.
                </div>
            </li>
            <li>
                <img src="/img/../img/slide3.jpg" alt="slide 3"/>
                <div class="orbit-caption">
                    Thế giới sách trong tầm tay.
                </div>
            </li>
        </ul>
    </div>
<?php } ?>
<div class="row home">
    <div class="large-12 columns">
        <div>
            <h4 style="text-align:left;margin-bottom: 30px;color:grey">XEM NHIỀU NHẤT</h4>
        </div>
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
            <?php foreach ($mostview as $key => $ebook) {
                if ($key % 5 == 0) { ?>
                    <li>
                    <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-5">
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } elseif ($key % 5 != 4) { ?>
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
            <h4 style="text-align:left;margin-bottom: 30px;color:grey">TẢI XUỐNG NHIỀU NHẤT</h4>
        </div>
        <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
            <?php foreach ($mostdown as $key => $ebook) {
                if ($key % 5 == 0) { ?>
                    <li>
                    <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-5">
                    <li>
                        <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                        echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                        <br>
                        <?php echo $ebook['Ebook']['title'] ?>
                    </li>
                <?php } elseif ($key % 5 != 4) { ?>
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
    <?php foreach ($cate as $key => $cat) { ?>
        <div class="large-12 columns">
            <div>
                <h4 style="text-align:left;text-transform: uppercase;margin-bottom: 30px;color:grey"><?php echo $cat['Category']['name'] ?>
                    |
                    <small
                        style="text-transform: none"><?php echo $this->Html->link('Xem tất cả', array('action' => 'view', $cat['Category']['id'])) ?></small>
                </h4>

            </div>
            <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
                <?php foreach ($cat['Ebook'] as $key1 => $ebook) {
                    if ($key1 % 5 == 0) { ?>
                        <li>
                        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-5">
                        <li>
                            <?php $image = $this->Html->image('../files/' . $ebook['user_id'] . '/' . $ebook['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $ebook['title'] ?>
                        </li>
                    <?php } elseif ($key1 % 5 != 4) { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $ebook['user_id'] . '/' . $ebook['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $ebook['title'] ?>
                        </li>
                    <?php } else { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $ebook['user_id'] . '/' . $ebook['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $ebook['title'] ?>
                        </li>
                        </ul>
                    <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>