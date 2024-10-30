<?php
/*
Plugin Name: LBB
Plugin URI: http://geraldsfuller.com/little-black-book-wordpress-plugin/
Description: An address book (Little Black Book) system.
Version: 1.1.5
Author: Gerald S. Fuller
Author URI: http://GeraldSFuller.com/

Little Black Book is based on Addressbook 0.7 by Sam Wilson
----------------------------------------
    Copyright (C) 2007-2014  Gerald S. Fuller

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

	http://www.gnu.org/licenses/
----------------------------------------
*/

$LBB_version = '1.1.5';
add_action('admin_head', 'LBB_adminhead');
function LBB_adminhead() {
    ?><style type="text/css">
    .wrap h2 {margin:1em 0 0 0}
    form div.line {width:95%; margin:auto}
    form div.input {float:left}
    form div.input label {font-size:smaller; margin:0}
    form div.input input, form div.input textarea {width:100%; margin:0}
    form p.submit {clear:both}
    div#contact-info {border:10px solid #E5F3FF; margin:0 0 0 1em; padding:5px;
        width:50%; height:10em; float:right; clear:left; border-bottom:0; position:relative;
        background-color:#f8f8f8}
    div#contact-info a {color:#2583AD}
    div#contact-info a:hover {color:#D54E21}
    table#LBB-table {border-collapse:collapse}
    table#LBB-table th {text-align:left}
    table#LBB-table tr td {border:2px solid #e5f3ff; margin:0}
    table#LBB-table tr:hover td {cursor:pointer}
    </style>
    <?php
}


add_action('admin_menu', 'LBB_menus');
function LBB_menus() {
    add_management_page('LBB', 'Little Black Book', 4, 'LBB/LBB.php', 'LBB_main');
}
function LBB_main() {
    global $wpdb, $LBB_version;
    if ($_POST['new']) {
        $sql = "INSERT INTO ".$wpdb->prefix."LBB SET
            first_name    = '".$wpdb->escape($_POST['first_name'])."',
            last_name     = '".$wpdb->escape($_POST['last_name'])."',
            email         = '".$wpdb->escape($_POST['email'])."',
            email2        = '".$wpdb->escape($_POST['email2'])."',
            website       = '".$wpdb->escape($_POST['website'])."',
            address_line1 = '".$wpdb->escape($_POST['address_line1'])."',
            address_line2 = '".$wpdb->escape($_POST['address_line2'])."',
            city          = '".$wpdb->escape($_POST['city'])."',
            state         = '".$wpdb->escape($_POST['state'])."',
            zipcode       = '".$wpdb->escape($_POST['zipcode'])."',
            homephone     = '".$wpdb->escape($_POST['homephone'])."',
            cellphone     = '".$wpdb->escape($_POST['cellphone'])."',
            notes         = '".$wpdb->escape($_POST['notes'])."'";
        $wpdb->query($sql); ?>
        <div id="message" class="updated fade">
            <p><strong>Address added.</strong> <a href="admin.php?page=LBB/LBB.php">Continue &raquo;</a></p>
        </div>
        <?php
    } else if ($_GET['action']=='delete') {
        $sql = "SELECT * FROM ".$wpdb->prefix."LBB WHERE id='".$wpdb->escape($_GET['id'])."'";
        $row = $wpdb->get_row($sql);
        if ($_GET['confirm']=='yes') {
            $wpdb->query("DELETE FROM ".$wpdb->prefix."LBB WHERE id='".$wpdb->escape($_GET['id'])."'");
            echo '<div id="message" class="updated fade">
                <p><strong>The address has been deleted.</strong>
                <a href="admin.php?page=LBB/LBB.php">Continue &raquo;<a/></p>
            </div>';
        } else {
            echo "<div class='wrap'>
                  <p style='text-align:center'>Are you sure you want to delete the following address?</p>
                  <p style='border:1px solid black; width:50%; margin:1em auto; padding:0.7em'>
                  ".$row->last_name.", ".$row->first_name."<br />
                  ".$row->email." ".$row->homephone."<br />
                  ".$row->address_line1."<br />
                  ".$row->address_line2."<br />
                  ".$row->city.", ".$row->state." ".$row->zipcode."<br />
                  <em>Notes:</em> ".$row->notes."
                  </p>
                  <p style='text-align:center; font-size:1.3em'>
                    <a href='admin.php?page=LBB/LBB.php&action=delete&id=".$row->id."&confirm=yes'>
                      <strong>[Yes]</strong>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='admin.php?page=LBB/LBB.php'>[No]</a>
                  </p>
                  </div>";
        }
    } else if ($_GET['action']=='edit') {
        $sql = "SELECT * FROM ".$wpdb->prefix."LBB WHERE id='".$wpdb->escape($_GET['id'])."'";
        $row = $wpdb->get_row($sql);
        if ($_POST['save']) {
            $wpdb->query("UPDATE ".$wpdb->prefix."LBB SET
                first_name    = '".$wpdb->escape($_POST['first_name'])."',
                last_name     = '".$wpdb->escape($_POST['last_name'])."',
                email         = '".$wpdb->escape($_POST['email'])."',
                email2        = '".$wpdb->escape($_POST['email2'])."',
                homephone     = '".$wpdb->escape($_POST['homephone'])."',
                cellphone     = '".$wpdb->escape($_POST['cellphone'])."',
                address_line1 = '".$wpdb->escape($_POST['address_line1'])."',
                address_line2 = '".$wpdb->escape($_POST['address_line2'])."',
                city          = '".$wpdb->escape($_POST['city'])."',
                state         = '".$wpdb->escape($_POST['state'])."',
                zipcode       = '".$wpdb->escape($_POST['zipcode'])."',
                notes         = '".$wpdb->escape($_POST['notes'])."',
                website       = '".$wpdb->escape($_POST['website'])."'
                WHERE id ='".$wpdb->escape($_GET['id'])."'");
            echo '<div id="message" class="updated fade">
                <p><strong>The address has been updated.</strong>
                <a href="admin.php?page=LBB/LBB.php">Continue &raquo;<a/></p>
            </div>';
        } else { ?>
            <div class="wrap">
            <h2><a name="new"></a>Edit Address</h2>
            <form action="admin.php?page=LBB/LBB.php&action=edit&id=<?php echo $row->id; ?>" method="post">
            <?php echo _LBB_getaddressform($row); ?>
            <p class="submit">
                <input type="submit" name="save" value="Save &raquo;" />
            </p>
            </form>
            </div>
        <?php }
    } else {
    
        $table_name = $wpdb->prefix."LBB";
        If ($wpdb->get_var("SHOW TABLES LIKE '$table_name'")!=$table_name
            || get_option("LBB_version")!=$LBB_version ) {
            // Call the install function here rather than through the more usual
            // activate_blah.php action hook so the user doesn't have to worry about
            // deactivating then reactivating the plugin.  Should happen seamlessly.
            _LBB_install();
            echo '<div id="message" class="updated fade">
                <p><strong>The LBB plugin (version
                '.get_option("LBB_version").') has been installed or upgraded.</strong></p>
            </div>';
        } ?>
                
        <div class="wrap">

        <div id="contact-info"><em>Select an address from below to see its details displayed here.</em></div>
        
        <p style='font-size:smaller; text-align:center'>This is version <?php echo get_option("LBB_version"); ?>
        of the <strong>LBB</strong> plugin by Gerald S. Fuller.
        </p>
        <p style="font-size:110%;text-align:center"><strong><a href="#new">Add new address &darr;</a></strong></p>
        <script type="text/javascript">
        function click_contact(row, id) {
            document.getElementById('contact-info').innerHTML=document.getElementById('contact-'+id+'-info').innerHTML;
        }
        </script>
        <table style="width:100%; margin:auto" id="LBB-table">
            <tr style="background-color:#E5F3FF">
                <th>Name</th><th>Email address</th><th>Home phone</th><th>Cell phone</th><th>Last update</th>
            </tr>
            <?php $sql = "SELECT * FROM ".$wpdb->prefix."LBB ORDER BY last_name, first_name";
            $results = $wpdb->get_results($sql);
            foreach ($results as $row) {
                echo "<tr onClick='click_contact(this, ".$row->id.")'>
                    <td>".$row->last_name.", ".$row->first_name."</td>
                    <td>".$row->email."</td>
                    <td>".$row->homephone."</td>
                    <td>".$row->cellphone."</td>
                    <td>".$row->ts."</td>
                </tr>";
            } ?>
        </table>
        <?php foreach ($results as $row) {
            echo "<div id='contact-".$row->id."-info' style='display:none'>
            <p class='submit' style='float:right; margin:0'>
            <a href='admin.php?page=LBB/LBB.php&action=edit&id=".$row->id."'>[Edit]</a>
            <a href='admin.php?page=LBB/LBB.php&action=delete&id=".$row->id."'>[Delete]</a>
            </p>
            <p style='margin:0'><strong>".$row->last_name.", ".$row->first_name."</strong><br />
            <a href='mailto:".$row->email."'>".$row->email."</a> ".$row->homephone."</p>";
            if ($row->notes) {
            	echo "<p style='float:right; width: 60%; font-size:smaller'>
           	          <em>Notes:</em> ".$row->notes."</p>";
            }
            echo "<p style='font-size:smaller'>".$row->address_line1."<br />";
            if ($row->address_line2) echo $row->address_line2."<br />";
            echo $row->city.", ".$row->state." ".$row->zipcode."<br />
            </p>
            </div>";
        } ?>
        
        <h2><a name="new"></a>Add Address</h2>
        <form action="admin.php?page=LBB/LBB.php" method="post">
        <?php echo _LBB_getaddressform(); ?>
        <p class="submit">
            <input type="submit" name="new" value="Add Address &raquo;" />
        </p>
        </form>
        </div><?php
    }
}

function _LBB_getaddressform($data='null') {
    if (!$data) $website = 'http://'; else $website = $data->website;
    $out = 
	'<div style="width:50%; float:left">
		<div class="line">
			<div class="input" style="width:50%">
				<label for="first_name">First name:</label>
				<input type="text" name="first_name" value="'.$data->first_name.'" />
			</div>
			<div class="input" style="width:49%">
				<label for="last_name">Last name:</label>
				<input type="text" name="last_name" value="'.$data->last_name.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:99%">
				<label for="email">Email Address:</label>
				<input type="text" name="email" value="'.$data->email.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:99%">
				<label for="email2">Email Address 2:</label>
				<input type="text" name="email2" value="'.$data->email2.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:50%">
				<label for="homephone">Home phone:</label>
				<input type="text" name="homephone" value="'.$data->homephone.'" />
			</div>
			<div class="input" style="width:49%">
				<label for="cellphone">Cell phone:</label>
				<input type="text" name="cellphone" value="'.$data->cellphone.'" />
			</div>
		</div>
	</div>
	<div style="width:50%; float:right">
		<div class="line">
			<div class="input" style="width:100%">
				<label for="address_line1">Address Line 1:</label>
				<input type="text" name="address_line1" value="'.$data->address_line1.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:100%">
				<label for="address_line2">Address Line 2:</label>
				<input type="text" name="address_line2" value="'.$data->address_line2.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:70%">
				<label for="city">City:</label>
				<input type="text" name="city" value="'.$data->city.'" />
			</div>
			<div class="input" style="width:9%">
				<label for="state">State:</label>
				<input type="text" name="state" value="'.$data->state.'" />
			</div>
			<div class="input" style="width:20%">
				<label for="zipcode">Zipcode:</label>
				<input type="text" name="zipcode" value="'.$data->zipcode.'" />
			</div>
		</div>
		<div class="line">
			<div class="input" style="width:100%">
				<label for="website">Website:</label>
				<input type="text" name="website" value="'.$website.'" />
			</div>
		</div>
	</div>
	<div class="line" style="width:98%">
		<div class="input" style="width:100%">
			<label for="notes">Notes:</label>
			<textarea name="notes" rows="3">'.$data->notes.'</textarea>
		</div>
	</div>';
	return $out;
}

function _LBB_install() {
    global $wpdb, $LBB_version;
    $table_name = $wpdb->prefix."LBB";
    $sql = "CREATE TABLE " . $table_name . " (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        ts TIMESTAMP DEFAULT '2013-11-01 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email tinytext NOT NULL,
        email2 tinytext NOT NULL,
        homephone tinytext NOT NULL,
        cellphone tinytext NOT NULL,
        address_line1 tinytext NOT NULL,
        address_line2 tinytext NOT NULL,
        city tinytext NOT NULL,
        zipcode tinytext NOT NULL,
        state tinytext NOT NULL,
        website VARCHAR(55) NOT NULL,
        notes tinytext NOT NULL,
        PRIMARY KEY  (id)
    );";
    require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
    dbDelta($sql);
    update_option('LBB_version', $LBB_version);
}

function LBB_getselect($name) {
    global $wpdb;
    $out = "<select name='$name'>";
    $rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."LBB ORDER BY last_name, first_name");
    foreach($rows as $row) {
        $out .= "<option value='$row->id'>$row->last_name $row->first_name</option>";
    }
    $out .= "</select>";
    return $out;
}

add_filter('the_content', 'LBB_list');
function LBB_list($content) {
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->prefix."LBB ORDER BY last_name, first_name";
    $results = $wpdb->get_results($sql);
    $out = "<hr /><div class='LBB-list'>";
    foreach ($results as $row) {
    	  $age = (int) abs( time() - strtotime( $row->ts ) );
    	  if ( $age < 657000 )	// less than one week: red
    	  		$ageStyle = "color:red";
    	  elseif ( $age < 1314000 )	// one-two weeks: maroon
    	  		$ageStyle = "color:maroon";
    	  elseif ( $age < 2628000 )	// two weeks to one month: green
    	  		$ageStyle = "color:green";
    	  elseif ( $age < 7884000 )	// one - three months: blue
    	  		$ageStyle = "color:blue";
    	  elseif ( $age < 15768000 )	// three to six months: navy
    	  		$ageStyle = "color:navy";
    	  elseif ( $age < 31536000 )	// six months to a year: black
    	  		$ageStyle = "color:black";
    	  else								// more than one year: don't show the update age
    	  		$ageStyle = "display:none";
    	  if (strlen($row->cellphone) > 0 )
    	  		$cell = "Cell: ";
    	  else
    	  		$cell = "";
        $out .= "<div class='LBB-item'>".
        "  <div style='width:49%; float:left'>".
        "  <span class='name'>".$row->first_name." ".$row->last_name."</span>\n".
        "  <div class='address'>\n".
        "  <span class='address-line1'>".$row->address_line1."</span><br />\n";
        if ($row->address_line2) $out .= "    <span class='address-line2'>".$row->address_line2."</span><br />\n";
        $out .= "    <span class='city'>".$row->city.",</span>\n".
        "    <span class='state'>".$row->state."</span>\n".
        "    <span class='zipcode'>".$row->zipcode."</span>\n".
        "  </div>".
        "  </div>".
        "  <div align='right' ><a class='email' href='mailto:".$row->email."'>".$row->email."</a>\n".
        "  <a class='email' href='mailto:".$row->email2."'>".$row->email2."</a><br />\n".
		  "  <a target='_blank' href='".$row->website."'>".$row->website."</a><br />\n".
        "  <span class='homephone'>".$row->homephone."</span><br />\n".
        "  <span class='cellphone'>".$cell.$row->cellphone."</span><br />\n".
        "  </div>\n".
        "  <div class='notes'>".$row->notes."</div>\n".
        "  <span style='".$ageStyle."'>Updated ".human_time_diff( strtotime( $row->ts ) )." ago</span><br />\n".
        "  </div>\n\n<br /><hr />";
    }
    $out .= "</div>\n";
    return preg_replace( "/\~LBB\~/", $out, $content);
}

?>
