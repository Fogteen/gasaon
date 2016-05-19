<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 col-sm-12">
                <h3 class="animated fadeInLeft">Quản lý danh mục</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>Thêm danh mục</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php
                    echo $this->Form->create('Category',array('id'=>'signupForm'));
                    ?>
                    <div class="col-md-10">
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('name',array('id'=>'validate_name','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                            ?>
                            <span class="bar"></span>
                            <label>Tên danh mục</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('des',array('id'=>'validate_des','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                            ?>
                            <span class="bar"></span>
                            <label>Mô tả</label>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <input class="submit btn btn-danger" type="submit" value="Submit">
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
</div>
