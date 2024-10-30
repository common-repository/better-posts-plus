<div class="warp">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <form method="post" name="rp_aimweb_options" action="options.php">
       
        <?php
        //Grab all options
        $options = get_option('rp-aimweb');
    
        // Cleanup
        $orderby = $options['orderby'];
        $orderby_cat = $options['orderby_cat'];
        $orderby_arc = $options['orderby_arc'];
        
        $order = $options['order'];
        $order_cat = $options['order_cat'];
        $order_arc = $options['order_arc'];
        
        $cat_radio = $options['cat_radio'];
        $arc_radio = $options['arc_radio'];
        
        $pagin_select = $options['pagin_select'];
        $pagin_num = $options['pagin_num'];
        $pagin_select_arc = $options['pagin_select_arc'];
        $pagin_num_arc = $options['pagin_num_arc'];
        
        $sticky_ignore = (isset($options['sticky_ignore'])) ? $options['sticky_ignore'] : 'imsticky';
        
        
        
    
        settings_fields('rp-aimweb');
        do_settings_sections('rp-aimweb');
        ?>
       
        
        
        
        <h2><?=$this->words['p_sort'].' '.$this->words['on_home'];?></h2>
        
        <p><?=$this->words['your_posts'].' '.$this->words['on_home'].' '.$this->words['are_sorted']; ?>
        <?=(empty($orderby)) ? $this->words['orderby_def'] : $this->words[$orderby];?> 
        <?=(empty($orderby)) ? $this->words['order_def'] : $this->words[$order];?>
        </p>
        
        <!-- Post sorting -->
        <table class=form-table>
        <tr valing="top">
            <th scope="row"><?=$this->words['p_sort'].$this->words['on_home'];?>:</th>
            <td>
                <fieldset>
                    <label for="rp-aimweb-orderby">
                        <span><?=$this->words['on_home_u'].$this->words['lets_sort'] ?></span>
                
                <select name="rp-aimweb[orderby]" id="rp-aimweb-orderby">
                    <option <?php selected($orderby, 'ID');?> value="ID">
                        <?=$this->words['ID'];?>    
                    </option>
                    <option <?php selected($orderby, 'author');?> value="author">
                        <?=$this->words['author'];?>
                    </option>
                    <option <?php selected($orderby, 'title', true);?> value="title">
                        <?=$this->words['title'];?>
                    </option>
                    <option <?php selected($orderby, 'name');?> value="name">
                        <?=$this->words['name'];?>
                    </option>
                    <option <?php selected($orderby, 'type');?> value="type">
                        <?=$this->words['type'];?>
                    </option>
                    <option <?php selected($orderby, 'date');?> value="date">
                        <?=$this->words['date'];?>
                    </option>
                    <option <?php selected($orderby, 'modified');?>value="modified">
                        <?=$this->words['modified'];?>
                    </option>
                    <option <?php selected($orderby, 'comment_count');?> value="comment_count">
                        <?=$this->words['comment_count'];?>
                    </option>
                    <option <?php selected($orderby, 'rand');?> value="rand">
                        <?=$this->words['rand'];?>
                    </option>
                    
                </select>
                
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-order">
                <span><?=$this->words['on_home_u'].' '.$this->words['lets_place']; ?></span>
                
                <select name="rp-aimweb[order]" id="rp-aimweb-order">
                    <option <?php selected($order, 'DESC');?> value="DESC">
                        <?=$this->words['DESC']; ?>
                    </option>
                    <option <?php selected($order, 'ASC');?> value="ASC">
                        <?=$this->words['ASC'];?>
                    </option>
                </select>
            </label>
        </fieldset>
            </td>

        </tr>
        </table>
        
        
        
        
        <h2><?=$this->words['p_sort'].' '.$this->words['on_cat'];?></h2>
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
       <!-- post sorting cat -->
        <table class=form-table>
        <tr valing="top">
            <th scope="row">
            <?=$this->words['p_sort'].$this->words['on_cat'];?>:
            </th>
            <td>
                <fieldset>
                <label for="rp-aimweb-cat-radio">
                <input type="radio"  id="rp-aimweb-cat-radio" name="rp-aimweb[cat_radio]" value="as_main" <?php if($cat_radio=='as_main') echo 'checked';?>/>
                <span><?=$this->words['use_same'].' '.$this->words['on_home'];?></span>
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-cat-radio-2">
                <input type="radio"  id="rp-aimweb-cat-radio-2" name="rp-aimweb[cat_radio]" value="as_none" <?php if($cat_radio=='as_none' OR empty($cat_radio)) echo 'checked="checked"';?> />
                <span><?=$this->words['leave_def_sort'];?></span>
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-cat-radio-3">
                <input type="radio"  id="rp-aimweb-cat-radio-3" name="rp-aimweb[cat_radio]" value="as_own" <?php if($cat_radio=='as_own') echo 'checked';?>/>
                <span><?=$this->words['use_this']; ?></span>
            </label>
        </fieldset>
            </td>
            <td>
                <fieldset>
            <label for="rp-aimweb-orderby-cat">
                
                <span><?=$this->words['on_cat_u'].$this->words['lets_sort'] ?></span>
                
                <select name="rp-aimweb[orderby_cat]" id="rp-aimweb-orderby-cat">
                    <option <?php selected($orderby_cat, 'ID');?> value="ID"><?=$this->words['ID'];?></option>
                    <option <?php selected($orderby_cat, 'author');?> value="author"><?=$this->words['author'];?></option>
                    <option <?php selected($orderby_cat, 'title');?> value="title"><?=$this->words['title'];?></option>
                    <option <?php selected($orderby_cat, 'name');?> value="name"><?=$this->words['name'];?></option>
                    <option <?php selected($orderby_cat, 'type');?> value="type"><?=$this->words['type'];?></option>
                    <option <?php if($orderby_cat=='date') echo 'selected="selected"';?> value="date"><?=$this->words['date'];?></option>
                    <option <?php selected($orderby_cat, 'modified');?> value="modified"><?=$this->words['modified'];?></option>
                    <option <?php selected($orderby_cat, 'comment_count');?> value="comment_count"><?=$this->words['comment_count'];?></option>
                    <option <?php selected($orderby_cat, 'rand');?> value="rand"><?=$this->words['rand'];?></option>
                    
                </select>
                
            </label>
        </fieldset>

        <fieldset>
            <label for="rp-aimweb-order-cat">
                <span><?=$this->words['on_cat_u'].' '.$this->words['lets_place'];?></span>
                
                <select name="rp-aimweb[order_cat]" id="rp-aimweb-order-cat">
                    <option <?php selected($order_cat, 'DESC');?> value="DESC"><?=$this->words['DESC'];?></option>
                    <option <?php selected($order_cat, 'ASC');?> value="ASC"><?=$this->words['ASC'];?></option>
                </select>
            </label>
        </fieldset>
            </td>
            </tr>
        </table>
        
        <h2><?=$this->words['p_sort'].' '.$this->words['on_arc'];?></h2>
        <p> <?=$this->words['your_posts'].' '.$this->words['on_arc'].' '.$this->words['are_sorted'];?>
        
        <?php
            if ($arc_radio=='as_own') {
                echo (empty($orderby_arc)) ? $this->words['orderby_def'] : $this->words[$orderby_arc]; 
                echo (empty($order_arc)) ? $this->words['order_def'] : $this->words[$order_arc];
            }  
            else if ($arc_radio=='as_main' OR $arc_radio=='as_cat' OR $arc_radio=='as_none'){
                echo $this->words[$arc_radio];
            }
        ?>
        <!-- post sorting arc -->
        <table class=form-table>
        <tr valing="top">
            <th scope="row">
                <?=$this->words['p_sort'].$this->words['on_arc'];?>:
            </th>
            <td>
                <fieldset>
            <label for="rp-aimweb-arc-radio">
                <input type="radio"  id="rp-aimweb-arc-radio" name="rp-aimweb[arc_radio]" value="as_main" <?php if($arc_radio=='as_main' ) echo 'checked';?> />
                <span><?=$this->words['use_same'].' '.$this->words['on_home'];?></span>
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-arc-radio-2">
                <input type="radio"  id="rp-aimweb-arc-radio-2" name="rp-aimweb[arc_radio]" value="as_cat" <?php if($arc_radio=='as_cat') echo 'checked';?> />
                <span><?=$this->words['use_same'].' '.$this->words['on_cat'];?></span>
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-arc-radio-3">
                <input type="radio"  id="rp-aimweb-arc-radio-3" name="rp-aimweb[arc_radio]" value="as_none" <?php if($arc_radio=='as_none' OR empty($arc_radio)) echo 'checked';?>/>
                <span><?=$this->words['leave_def_sort'];?></span>
            </label>
        </fieldset>
        <fieldset>
            <label for="rp-aimweb-arc-radio-4">
                <input type="radio"  id="rp-aimweb-arc-radio-4" name="rp-aimweb[arc_radio]" value="as_own" <?php if($arc_radio=='as_own') echo 'checked';?>/>
                <span><?=$this->words['use_this'];?></span>
            </label>
        </fieldset>
            </td>
            <td>
                <fieldset>
            <label for="rp-aimweb-orderby-arc">
                
                <span><?=$this->words['on_arc_u'].$this->words['lets_sort'] ?></span>
                
                <select name="rp-aimweb[orderby_arc]" id="rp-aimweb-orderby-arc">
                    <option <?php if($orderby_arc=='ID') echo 'selected="selected"';?> value="ID"><?=$this->words['ID'];?></option>
                    <option <?php if($orderby_arc=='author') echo 'selected="selected"';?> value="author"><?=$this->words['author'];?></option>
                    <option <?php if($orderby_arc=='title') echo 'selected="selected"';?> value="title"><?=$this->words['title'];?></option>
                    <option <?php if($orderby_arc=='name') echo 'selected="selected"';?> value="name"><?=$this->words['name'];?></option>
                    <option <?php if($orderby_arc=='type') echo 'selected="selected"';?> value="type"><?=$this->words['type'];?></option>
                    <option <?php if($orderby_arc=='date') echo 'selected="selected"';?> value="date"><?=$this->words['date'];?></option>
                    <option <?php if($orderby_arc=='modified') echo 'selected="selected"';?> value="modified"><?=$this->words['modified'];?></option>
                    <option <?php if($orderby_arc=='comment_count') echo 'selected="selected"'; ?>value="comment_count"><?=$this->words['comment_count'];?></option>
                    <option <?php if($orderby_arc=='rand') echo 'selected="selected"'; ?> value="rand"><?=$this->words['rand'];?></option>
                    
                </select>
                
            </label>
        </fieldset>

        <fieldset>
            <label for="rp-aimweb-order-cat">
                <span><?=$this->words['on_arc_u'].' '.$this->words['lets_place']; ?></span>
                
                <select name="rp-aimweb[order_arc]" id="rp-aimweb-order-arc">
                    <option <?php selected($order_arc, 'DESC', true);?> value="DESC"><?=$this->words['DESC'];?></option>
                    <option <?php selected($order_arc, 'ASC'); ?> value="ASC"><?=$this->words['ASC'];?></option>
                </select>
            </label>
        </fieldset>
            </td>
            </tr>
        </table>
        
        
        
        
        
        <h3><?=$this->words['pagin_set'];?></h3>
        <table class=form-table>
            <tr valign="top">
                <th scope="row"><?=$this->words['post_beh_u'].$this->words['on_home'];?></th>
                <td>
                   
                    <input id="rp-aimweb-pagin-radio" type="radio" name="rp-aimweb[pagin_select]" <?php checked($pagin_select, 'allinone', true);?> value='allinone' />
                    <label for="rp=aimweb-pagin-radio"><?=$this->words['without_pag'];?></label>
                    <br>
                    <input id="rp-aimweb-pagin-radio-2" type="radio" name="rp-aimweb[pagin_select]" <?php checked($pagin_select, 'selfset', true);?> value="selfset" />
                     <?php $inp_var='<input type="text" name="rp-aimweb[pagin_num]" size="3" value="'.$pagin_num.'" />'; ?>
                     <label for="rp-aimweb-pagin-radio-2"><?php printf($this->words['show_s'], $inp_var);?></label>
                     <br>
                     <input id="rp-aimweb-radio-3" type="radio" name="rp-aimweb[pagin_select]" <?php checked($pagin_select, 'default', true); checked($pagin_select, null, true);?>  value="default" />
                     <label for="rp-aimweb-radio-3"><?=$this->words['leave_def'];?></label>
                    
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?=$this->words['post_beh_u'].$this->words['on_cat'].'/'.$this->words['on_arc'];?></th>
                <td>
                   
                    <input id="rp-aimweb-pagin-arc-radio" type="radio" name="rp-aimweb[pagin_select_arc]" <?php checked($pagin_select_arc, 'allinone', true);?> value='allinone' />
                    <label for="rp=aimweb-pagin-arc-radio"><?=$this->words['without_pag'];?></label>
                    <br>
                    <?php $inp_var2='<input type="text" name="rp-aimweb[pagin_num_arc]" size="3" value="'.$pagin_num_arc.'" />'; ?>
                    <input id="rp-aimweb-pagin-arc-radio-2" type="radio" name="rp-aimweb[pagin_select_arc]" <?php checked($pagin_select_arc, 'selfset', true);?> value="selfset" />
                     <label for="rp-aimweb-pagin-arc-radio-2"><?php printf($this->words['show_s'], $inp_var2);?></label>
                     <br>
                     <input id="rp-aimweb-arc-radio-3" type="radio" name="rp-aimweb[pagin_select_arc]" <?php checked($pagin_select_arc, 'default', true); checked($pagin_select_arc, null, true);?>  value="default" />
                     <label for="rp-aimweb-arc-radio-3"><?=$this->words['leave_def'];?></label>
                    
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?=$this->words['sticky_u'];?></th>
                <td>
                   
                    <input id="rp-aimweb-sticky" type="checkbox" name="rp-aimweb[sticky_ignore]" <?php checked($sticky_ignore, 'ignore');?> value='ignore' />
                    <label for="rp-aimweb-sticky"><?=$this->words['ignore_u'].' '.$this->words['sticky'];?></label>
                                    
                </td>
            </tr>
            
        </table>
        
        <br><br>       
        
        <?php submit_button($this->words['save'], 'primary','submit', false); ?>
        <?='<a href="'.admin_url('admin.php?page=rp_aimweb_reset').'">'.$this->words['reset'].'</a>';?>
    

    </form>

</div>