<?php if(sw_count($agent_estates) > 0): ?>

<div class="widget widget-other-location widget_edit_enabled"> 
    <div class="widget-header">
        <h2 class="title"><?php echo lang_check('More Jobs'); ?></h2>
    </div>
    <div class="decription">
        <div class="results-listings-mixed results-list middle m0">
            <div id="ajax_results">
                <?php if(!empty($agent_estates)):?>
                <div class="result-container">
                    <?php foreach($agent_estates as $key=>$item): ?>
                    <div class="item">
                        <div class="flex-row">
                            <div class="grid-content">
                                <h3 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h3>
                                <div class="options">
                                    <span class="opt">Bankable Payments</span>
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
                <?php else: ?>
                    <div class="widget-content">
                        <div class="col-xs-12 pt35">
                            <div class="alert alert-success">
                                <?php echo lang_check('Properties not available');?>
                            </div>
                        </div>
                    </div> <!-- /. recent properties -->
                <?php endif;?>
            </div>
        </div>
    </div>
 </div>
<?php endif;?>