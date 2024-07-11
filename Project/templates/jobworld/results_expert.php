<?php foreach($expert_module_all as $key=>$row):?>
<div class="card">
  <div class="card-header">
    <a class="card-link" data-toggle="collapse" href="#collapseOne<?php echo $key;?>">
        <i class="qmark">?</i>
        <?php echo $row->question; ?>             
    </a>
  </div>
  <div id="collapseOne<?php echo $key;?>" class="collapse  <?php echo ($key==0) ? 'show' : '' ;?>" data-parent="#accordion">
    <div class="card-body">
        <?php if(!empty($row->answer_user_id) && isset($all_experts[$row->answer_user_id])): ?>
            <a class="image_expert" href="<?php echo site_url('profile/'.$row->answer_user_id.'/'.$lang_code); ?>#content-position">
                <img src="<?php echo $all_experts[$row->answer_user_id]['image_url']?>" alt="" />
            </a>
        <?php endif;?>
        <?php echo $row->answer; ?>       
    </div>
  </div>
</div>
<?php endforeach; ?>