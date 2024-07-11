<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
             <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_pagetitle'); ?>
        <main class="container container-palette pt-75 m60">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-sidebar">
                        <div class="widget widget-search">
                            <form  class="form-search agents widget-content" action="<?php echo current_url().'#agent-search'; ?>" method="get">
                                <div class="input-group input-with-search color-primary clearfix">
                                    <input type="text" name="search-agent" value="<?php echo $this->input->get('search-agent'); ?>" class="form-control" placeholder="<?php _l('Search');?>">
                                    <button type="submit"  id="btn-search_showroom" class="input-group-addon"><i class="fa fa-search icon-white"></i></button>
                                </div>
                            </form>
                        </div>
                    </div><!-- ./ sidebar --> 
                    <div class="column-content m65">
                        <?php _widget('center_default_contenttitle'); ?>
                        <div class="results-listings-ext first-nopadding" id="agent-search">
                            <?php if(!empty($paginated_agents)):foreach($paginated_agents as $item):?>
                            <div class="item-listings-ext">
                                <div class="header">
                                    <div class="content">
                                        <div class="preview"><a href="<?php  _che($item['agent_url']);?>"><img src="<?php echo _simg($item['image_url'], '128x128'); ?>" alt="" /></a></div>
                                        <div class="caption">
                                            <h3 class="title"><a href="<?php  _che($item['agent_url']);?>"><?php  _che($item['name_surname']);?></a></h3>
                                            <div class="options">
                                                <?php if(profile_cf_single(4, FALSE, $item['agent_profile'])):?>
                                                    <span class="opt"><?php echo profile_cf_single(4, FALSE, $item['agent_profile']);?></span>
                                                <?php endif;?>
                                                <span class="opt-light"><i class="icon_pin_alt"></i><?php  _che($item['address']);?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-label"><a href="<?php  _che($item['agent_url']);?>" class="text-red" ><?php echo lang_check('Recently Updated');?></a></div>
                                </div>
                                <div class="body">
                                    <?php echo $item['agent_profile']['description']; ?>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php else:?>
                                <div class="alert alert-success">
                                    <?php echo lang_check('Not available');?>
                                </div>
                            <?php endif;?>
                            <nav class="text-center">
                                <ul class="pagination">
                                    <?php echo $agents_pagination; ?>
                                </ul>
                            </nav>
                        </div><!-- ./ results big --> 
                    </div>
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>