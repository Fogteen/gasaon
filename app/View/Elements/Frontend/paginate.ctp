<ul class="pagination pagination-right">
    <?php
    echo $this->Paginator->prev('<span class="glyphicon fi-rewind"></span>', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    echo $this->Paginator->numbers(array(
        'currentClass' => 'active',
        'currentTag' => 'a',
        'tag' => 'li',
        'separator' => '',
    ));
    echo $this->Paginator->next('<span class="glyphicon fi-fast-forward"></span>', array('escape' => false, 'tag' => 'li', 'currentClass' => 'disabled'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    ?>
</ul>
<style>
    .pagination {margin: 0 0;float:right;left:-50%;text-align:left;}
</style>