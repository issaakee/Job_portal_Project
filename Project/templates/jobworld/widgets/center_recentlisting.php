<?php
/*
Widget-title: Recent listings result
Widget-preview-image: /assets/img/widgets_preview/center_recentlisting.jpg
 */
?>
<div class="header hidden widget_edit_enabled">
     <div class="filters filters-box list-view-box">
         <div class="container">
             <div class="hidden-xs grid-type">
                 <a href="#" class="view-type grid" data-ref="grid"><i class="fa fa-th"></i></a>
                 <a href="#" class="view-type list active" data-ref="list"><i class="fa fa-list"></i></a>
             </div>
             <div class="sort-filter">
                 <label><?php _l('OrderBy'); ?></label>
                 <select class="selectpicker-small">
                     <option value="id ASC" <?php _che($order_dateASC_selected); ?>><?php _l('DateASC'); ?></option>
                     <option value="id DESC" <?php _che($order_dateDESC_selected); ?>><?php _l('DateDESC'); ?></option>
                     <option value="counter_views ASC" <?php _che($order_viewsASC_selected); ?>><?php _l('viewsASC'); ?></option>
                     <option value="counter_views DESC" <?php _che($order_viewsDESC_selected); ?>><?php _l('viewsDESC'); ?></option>
                 </select>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="title-location">
             <h2 class="location"><b><?php echo _l('Results');?></b></h2>
             <div class="count"><span class='total_rows'><?php echo $total_rows; ?></span> <?php echo lang_check('Results Found');?></div>
         </div>
     </div>
 </div>
<div class="results-listings-ext m25 widget_edit_enabled">                     
    <div class="results-list middle m95 result_preload_box" id="results_conteiner">
        {has_no_results}
        <div class="result-answer">
            <div class="alert alert-success">
                <?php _l('Noestates');?>
            </div>
        </div>
        {/has_no_results}
        <div class="result-container">
            <?php _widget('results_list');?>
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation" class="pagination properties">
                {pagination_links}
            </nav>
        </div>
        <div class="result_preload_indic"></div>
    </div><!-- ./ jobs list --> 
</div>
