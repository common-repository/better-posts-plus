<div class="warp">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <h3><?=$this->words['thank_u'].' '.$this->plugin_name;?></h3>
    <h4><?=$this->words['actual_settings'];?></h4>
    
    <?php
        $options = get_option('rp-aimweb');
        // Cleanup
        $orderby = $options['orderby'];
        $orderby_cat = $options['orderby_cat'];
        $orderby_arc = $options['orderby_arc'];
        
        $order = $options['order'];
        $order_cat = $options['order_cat'];
        $order_arc = $options['order_arc'];
        
        $cat_radio = (empty($options['cat_radio'])) ? 'as_none' : $options['cat_radio'];
        $arc_radio = (empty($options['arc_radio'])) ? 'as_none' : $options['arc_radio'];
    
        $pagin_select = $options['pagin_select'];
        $pagin_select_arc = $options['pagin_select_arc'];
    
        $pagin_num = $options['pagin_num'];
        $pagin_num_arc = $options['pagin_num_arc'];
    
        $sticky_ignore = (isset($options['sticky_ignore'])) ? $options['sticky_ignore'] : 'imsticky';
    
        
    ?>
    <br>
    
    
    <table class="form-table">
        <tr valign="top">
            <td>
                <h3><?=$this->words['actual_posts_settings'];?></h3>
            </td>
            <td>
                <h3><?=$this->words['pagin_set'];?></h3>
            </td>
            
        </tr>
        <tr valign="top">
            <td>
                <p><?=$this->words['your_posts'].' '.$this->words['on_home'].' '.$this->words['are_sorted']; ?>
        <?=(empty($orderby)) ? $this->words['orderby_def'] : $this->words[$orderby];?> 
        <?=(empty($orderby)) ? $this->words['order_def'] : $this->words[$order];?>
        </p>
                 <p> <?=$this->words['your_posts'].' '.$this->words['on_cat'].' '.$this->words['are_sorted'];?>
        <?php if ($cat_radio=='as_own') {
            echo (empty($orderby_cat)) ? $this->words['orderby_def'] : $this->words[$orderby_cat]; 
            echo (empty($order_cat)) ? $this->words['order_def'] : $this->words[$order_cat];
        } 
        else if ($cat_radio=='as_main' OR $cat_radio=='as_none') {
            echo $this->words[$cat_radio];
        } 
         
    ?>
    </p>
               <p> <?=$this->words['your_posts'].' '.$this->words['on_arc'].' '.$this->words['are_sorted'];?>
        <?php if ($arc_radio=='as_own') {
            echo (empty($orderby_arc)) ? $this->words['orderby_def'] : $this->words[$orderby_arc]; 
            echo (empty($order_arc)) ? $this->words['order_def'] : $this->words[$order_arc];
        } 
        else if ($arc_radio=='as_main' OR $arc_radio=='as_cat' OR $arc_radio=='as_none') {
            echo $this->words[$arc_radio];
        }  
    ?>
    </p>
            </td>
            <td>
                <p><?=$this->words['your_posts'].$this->words['on_home'];?>:</p>
                <p>
                   <?php 
                    if ($pagin_select=='allinone') echo $this->words['without_pag'];
                    else if ($pagin_select=='selfset') printf($this->words['show_s'], $pagin_num);
                    else echo $this->words['leave_def'];
                    ?>
                .</p>
                <p>
                    <?=$this->words['your_posts'].$this->words['on_cat'].'/'.$this->words['on_arc'];?>:
                </p>
                <p>
                    <?php
                        if ($pagin_select_arc=='allinone') echo $this->words['without_pag'];
                        else if ($pagin_select_arc=='selfset') printf($this->words['show_s'], $pagin_num_arc);
                        else echo $this->words['leave_def'];
                    ?>
                .</p>
            </td>
            
            
        </tr>
        <tr valign="top">
            <td>
                <h3><?=$this->words['sticky_u'];?></h3>
            </td>
            <td>
                <!-- next option title here -->
            </td>
            
        </tr>
        <tr valign="top">
            <td><p>
                <?php if ($sticky_ignore=='ignore') echo $this->words['sticky_u'].' '.$this->words['are_ignored'];
                else echo $this->words['sticky_u'].' '.$this->words['arent_ignored'];?>
                </p>
            </td>
            <td>
                <!-- next option settings here -->
            </td>
            
        </tr>
        <tr valign="top">
            <td>
                <h3><?=$this->words['gotoset'];?></h3>
            </td>
        </tr>
        <tr valign="top">
            <td>
                <?php echo '<a href="' . admin_url( 'admin.php?page=rp_aimweb_menu_settings' ) . '">' . $this->words['settings'].' '.$this->plugin_name . '</a>';?>
            </td>
        </tr>
    </table>
    
</div>