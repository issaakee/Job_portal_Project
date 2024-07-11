<?php
/*
Widget-title: Agencies
Widget-preview-image: /assets/img/widgets_preview/top_agencies.jpg
 */
?>
<?php if(!empty($all_agents)): ?>
<div class="section-slim section-employer container container-palette widget_edit_enabled">
    <div class="container">
        <h2 class="section-title left small">{lang_Agencies}</h2><!-- ./ section title --> 
        <div class="employer-results">
        <?php foreach($all_agents as $agent): ?>
          <?php if(isset($agent['image_sec_url'])): ?>
            <div class="employer-grid"><a href="<?php echo $agent['agent_url']; ?>" class="preview"><img src="<?php echo $agent['image_sec_url']; ?>" alt="" /></a></div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>
</div> <!-- ./ featured example  --> 
<?php endif; ?>