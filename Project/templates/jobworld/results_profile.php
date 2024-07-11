<?php if(!empty($agent_estates)):?>
    <div class="result-container">
       <?php foreach($agent_estates as $key=>$item): ?>
       <div class="item">
           <div class="flex-row">
               <div class="grid-content">
                   <h3 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h3>
                   <div class="options">
                           <?php if(!empty($option_79)):?>
                               <span class="opt"><?php echo _ch($option_79, '-'); ?></span>
                           <?php endif;?>
                           <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                           <?php 
                               if(!empty($item['option_36']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</span>';
                               elseif(!empty($item['option_37']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</span>';
                           ?>
                           <?php endif; ?>
                       <span class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></span>
                   </div>
               </div>
               <div class="grid-side"><span class="item-label text-red"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></span></div>  
           </div>
       </div>
       <?php endforeach;?>   
   </div>

   <div class="row-fluid clearfix text-center">
       <div class="pagination-ajax-results pagination  wp-block default product-list-filters light-gray pagination" rel="ajax_results">
          <?php echo $pagination_links_agent; ?>
       </div>
   </div>
<?php endif;?>