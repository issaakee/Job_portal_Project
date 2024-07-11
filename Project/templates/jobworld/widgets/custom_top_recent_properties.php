<div class="section-m m105 pt-15 section-listings-wide container container-palette">
    <div class="container">
        <h2 class="section-title"><?php echo lang_check('Recent Jobs');?></h2><!-- ./ section title --> 
        
        <div class="header hidden">
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
        
        <div class="column-content">
            <div class="results-list middle result_preload_box" id="results_conteiner">
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
    </div>
</div><!-- ./ jobs listigns --> 