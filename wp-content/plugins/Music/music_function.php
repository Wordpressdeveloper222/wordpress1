<?php
error_reporting(0);
function createdatabase()
			{
				 require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				 $query="CREATE TABLE IF NOT EXISTS  wp_music(
						wp_music_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
						song_title TEXT NOT NULL,
						song_link TEXT NOT NULL,
						artist_title TEXT NOT NULL,
						artist_link TEXT NOT NULL
						)ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
				 dbDelta($query);    
			}
		?>
		
		<?php
	//	Add Menu Page To Admin Site	
function addmenu()
			{
				 add_menu_page("wp_music list", "wp_music list", "delete_pages", "chkcode_wp_music_list_slug","fun_operations");	 
				 $role = get_role( 'administrator' );       //	Get Role
				 $role->add_cap('wp_music_cap');      	//	Page Capabilities Here
			}
	

	  function fun_operations()
    { 
	
        if(isset($_POST["submit"]))
        {
            $id = (isset($_POST['wp_music_id'])) ? $_POST['wp_music_id'] : 0;
            do_action("save_wp_music_hook",$id);
        }
		
        $id = (isset($_GET['wp_music_id'])) ? $_GET['wp_music_id'] : 0;
        do_action("add_wp_music_hook",$id);
		
        if($_GET["action"] == "delete")
            do_action("delete_wp_music_hook",$id);
		
            do_action("view_wp_music_hook");
      
	}
			
			function head_script()
			{
				ob_start();
				?>
				<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>css/style.css">
				<!--script src="<?php echo plugin_dir_url(__FILE__); ?>js/marketing.js"></script-->
				<?php
			}
			add_action('admin_head','head_script');
			
			add_action("add_wp_music_hook", "add_wp_music_form");
			add_action("save_wp_music_hook","save_wp_music");
			add_action("delete_wp_music_hook","delete_wp_music_detail");
	        add_action('view_wp_music_hook','view_wp_music');
			
			function add_wp_music_form($wp_music_id)
			{
				 global $wpdb;
                 if( (isset($_GET['action']) && $_GET['action']=='update'))
                 $sel_wp_music=$wpdb->get_results("SELECT * FROM wp_music WHERE wp_music_id=".$wp_music_id);    //	Select Query Fire
				?>
       <form name="form" method="post" id="form" action="" onsubmit="return(validate());">
	          <?php if($wp_music_id!=0) ?>
      <?php   echo "<input type=hidden name='wp_music_id' id='wp_music_id' value='".$wp_music_id."'>";   ?>
		
                <table> 
                  
                    <tr>
                        <td style="width:30%">SONG TITLE:</td>

                        <td style="width:15%;float:left;"><input type="text" name="txt-fname"  value="<?php echo $sel_wp_music[0]->song_title ;?>"></td><td>Song Link:</td>
                     <td style="width:15%;float:left;"><input type="text" name="txt-song"  value="<?php echo $sel_wp_music[0]->song_link ;?>"></td>
                    </tr>
					 <tr>
                        <td>ARTIST:</td>
                        <td style="width:15%;float:left;"><input type="text" name="txt-lname" value="<?php echo $sel_wp_music[0]->artist_title ;?>"></td>&nbsp;<td>Artist Link:</td>
                         <td style="width:15%;float:left;"><input type="text" name="txt-artist"  value="<?php echo $sel_wp_music[0]->artist_link ;?>"></td>
                    </tr>
					
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <input type="submit" name="submit" value="<?php if($wp_music_id!=0) echo "Update"; else echo "ADD"; ?>" />
							 <?php if($wp_music_id!=0) echo "<a href='admin.php?page=chkcode_wp_music_list_slug' class='button2'>Add New</a>"; ?>
                        </td>
                    </tr>
                </table>
        </form>
	<?php
			}
	?>
	<?php
	function save_wp_music($wp_music_id)
    {
        global $wpdb;
        $insert=array(
            'song_title'=>$_POST['txt-fname'],
			 'song_link'=>$_POST['txt-song'],
            'artist_title'=>$_POST['txt-lname'],
			 'artist_link'=>$_POST['txt-artist'],
        );
        if($wp_music_id==0)
        {
            $wpdb->insert("wp_music",$insert);
			echo "record inserted successfully";
        }
		 else
        {
             $wpdb->update("wp_music",$insert, array('wp_music_id'=>$wp_music_id));
			 echo "updated successfully";
        }
	}
	
	function delete_wp_music_detail($wp_music_id)
    {
        global $wpdb;
        $wpdb->query("DELETE FROM wp_music WHERE wp_music_id=".$wp_music_id);
    }
	
	
	
	function view_wp_music()
    {
        global $wpdb;
        ?>
        <br>
        <div style="width:97%;margin-left:17px;">
        <table id="example" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" >
            <?php
            $rec = $wpdb->get_results("SELECT * FROM wp_music");
            if ($rec[0]->wp_music_id != "") 
            {
            ?>
                <thead>
                <tr>
                    <th align="center" scope="col" width="20%">SONG TITLE</th>
                   <th align="center" scope="col" width="20%">SONG Link</th>
                  <th align="center" scope="col" width="20%">ARTIST</th>
                    <th align="center" scope="col" width="20%">ARTIST Link</th>
					<th align="center" scope="col" width="8%">Action</th>
					
                </tr>
                
					<?php 
					$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
					$limit = 1; // number of rows in page
					$offset = ( $pagenum - 1 ) * $limit;
					$total = $wpdb->get_var( "SELECT COUNT(`wp_music_id`) FROM wp_music" );
					$num_of_pages = ceil( $total / $limit );
					echo "SELECT * FROM wp_music LIMIT $offset, $limit";
					$entries = $wpdb->get_results( "SELECT * FROM wp_music LIMIT $offset, $limit" );
					$page_links = paginate_links( array(
					'base' => add_query_arg( 'pagenum', '%#%' ),
					'format' => '',
					'prev_text' => __( '&laquo;', 'text-domain' ),
					'next_text' => __( '&raquo;', 'text-domain' ),
					'total' => $num_of_pages,
					'current' => $pagenum
				) );

						if ( $page_links ) {
							echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
						} ?>
						</thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($entries as $event) 
                    {
                        ?>
                        <tr>
                            <td align="center" scope="col"><?php echo $event->song_title; ?></td>
                            <td align="center" scope="col"><?php echo $event->song_link; ?></td>
							 <td align="center" scope="col"><?php echo $event->artist_title; ?></td>
                            <td align="center" scope="col"><?php echo $event->artist_link; ?></td>
							
                            <td align="center" scope="col">
                                <a href="admin.php?page=chkcode_wp_music_list_slug&wp_music_id=<?php echo $event->wp_music_id ?>&action=update" style="text-decoration: none"><img src="<?php echo plugin_dir_url(__FILE__)."images/edit.png" ?>"> </a>
                                <a href="admin.php?page=chkcode_wp_music_list_slug&wp_music_id=<?php echo $event->wp_music_id ?>&action=delete" style="text-decoration: none" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo plugin_dir_url(__FILE__)."images/delete.png" ?>"> </a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
        </table>
        </div>
        <?php
    }
	?>
	
	
