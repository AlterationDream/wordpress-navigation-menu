function custom_menu($menu_name) {
 
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {		// Get nav
        $menu = wp_get_nav_menu_object($locations[$menu_name]);		
        $menuitems = wp_get_nav_menu_items($menu->term_id);		
        global $wp;
        ?> 
 
			<ul class="yamm main-menu navbar-nav">
			    <?php
			    $count = 0;
			    $submenu = false;
 
			    foreach( $menuitems as $item ):
			        $link = $item->url;	// Item link
			        $title = $item->title;	// Item title
			        if ( !$item->menu_item_parent ):
				        $parent_id = $item->ID; // Top level item parent id
				        
				        // Top level item markup + dropdown class
				        ?>	
 
					    <li class="nav-item">
					        <a href="<?php echo $link; ?>" class="nav-link <?php if ( count($menuitems) > $count + 1 && $menuitems[ $count + 1 ]->menu_item_parent == $parent_id ): ?>dropdown-toggle<?php endif; ?>"><?php echo $title; ?></a> 
 
				    <?php endif; ?>
			        <?php if ( $parent_id == $item->menu_item_parent ): // If is submenu ?>
 
			            <?php if ( !$submenu ): $submenu = true; // Open sub menu ?>
		            		<div class="dropdown-menu">
			            <?php endif; // Submenu item?>
 
		                    <a href="<?php echo $link; ?>" class="dropdown-item"><?php echo $title; ?></a>
 
			            <?php if ( (count($menuitems) == $count + 1 || $menuitems[ $count + 1 ]->menu_item_parent != $parent_id) && $submenu ): ?>
			            	</div>
			            <?php $submenu = false; endif;  // Submenu closing ?>
 
			        <?php endif; ?>
 
				    <?php if ( count($menuitems) == $count + 1 || $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): // Submenu and toplevel item closing ?>
				    	</li>                           
				    <?php $submenu = false; endif; ?>
				<?php $count++; endforeach; ?>
 
			</ul>
				
        <?php
    }
 
}
