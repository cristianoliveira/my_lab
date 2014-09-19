<?php
    include_once 'includes/home.php';
    $home = new home();
    session_start();
    $session = session_id();
    $home->form($session);
?>
<div class="tryit2">
<form id="letsfly" enctype="multipart/form-data" method="post" action="success.php">
    <ul>
	<li>
	    <textarea class="overview" name="overivew" onkeyup="ajax_form('c=s_overview&v='+this.value);"><?php echo stripslashes($_SESSION['s_overview']); ?></textarea> 
	</li>
	<li>
	    <textarea class="location" name="location" onkeyup="ajax_form('c=s_location&v='+this.value);"><?php echo stripslashes($_SESSION['s_location']); ?></textarea> 
	</li>
	<li>
	    <label class="description" for="involves">Check if the project involves any of these: </label><br />
	    <div class="checkbox">
		<input id="hotel" class="hotel" type="checkbox"  onchange="ajax_form_checkbox('i_hotel',this);" value="<?php echo $_SESSION['i_hotel']; ?>" <?php if(strpos($_SESSION['i_hotel'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="hotel" name="hotel" >&nbsp;&nbsp;Hotel</label><br />
		    
		<input id="student_housing" class="student_housing" name="student_housing" type="checkbox"  onchange="ajax_form_checkbox('i_student_housing',this);" value="<?php echo $_SESSION['i_student_housing']; ?>" <?php if(strpos($_SESSION['i_student_housing'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="student_housing" name="student_housing" >&nbsp;&nbsp;Student&nbsp;Housing</label><br />

		<input id="apt_bldg" class="apt_bldg" name="apt_bldg" type="checkbox" onchange="ajax_form_checkbox('i_apt_bldg',this);" <?php if(strpos($_SESSION['i_apt_bldg'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="apt_bldg" name="apt_bldg" >&nbsp;&nbsp;Apartment&nbspBuilding</label><br />
	    </div>
	    <div class="checkbox">
		<input id="com_ofc" class="com_ofc" name="com_ofc" type="checkbox" onchange="ajax_form_checkbox('i_com_ofc',this);" value="<?php echo $_SESSION['i_com_ofc']; ?>" <?php if(strpos($_SESSION['i_com_ofc'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="com_ofc" name="com_ofc" >&nbsp;&nbsp;Commercial&nbspOffice</label><br />

		<input id="outdoor" class="outdoor" name="outdoor" type="checkbox" onchange="ajax_form_checkbox('i_outdoor',this);" value="<?php echo $_SESSION['i_outdoor']; ?>" <?php if(strpos($_SESSION['i_outdoor'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="outdoor" name="outdoor" >&nbsp;&nbsp;Outdoor&nbspDeployment</label><br />
	    </div>
	    <div class="clear"></div>
	</li><br />
	<li>
	    <label class="description" for="need">Which of these do you need? </label><br />
	    <div class="checkbox">
		<input id="hardware" class="hardware" id="hardware" name="hardware" type="checkbox"  onchange="ajax_form_checkbox('i_sprt_hardware',this);" value="<?php echo $_SESSION['i_sprt_hardware']; ?>" <?php if(strpos($_SESSION['i_sprt_hardware'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="hardware" name="hardware">&nbsp;&nbsp;Hardware</label><br />

		<input id="installation" class="installation" name="installation" type="checkbox"  onchange="ajax_form_checkbox('i_sprt_install',this);" value="<?php echo $_SESSION['i_sprt_install']; ?>" <?php if(strpos($_SESSION['i_sprt_install'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="installation" name="installation">&nbsp;&nbsp;Installation</label><br />
	    </div>
	    <div class="checkbox">
		<input id="maint" class="maint" name="maint" type="checkbox"  onchange="ajax_form_checkbox('i_sprt_maint',this);" value="<?php echo $_SESSION['i_sprt_maint']; ?>" <?php if(strpos($_SESSION['i_sprt_maint'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="maint" name="maint">&nbsp;&nbsp;Maintenance&nbspongoing)</label><br />

		<input id="tech_sprt" class="tech_sprt" name="tech_sprt" type="checkbox"  onchange="ajax_form_checkbox('i_sprt_tech',this);" value="<?php echo $_SESSION['i_sprt_tech']; ?>" <?php if(strpos($_SESSION['i_sprt_tech'], 'true') !== false){echo 'checked=yes';}?>/>
		<label class="choice" for="tech_sprt" name="tech_sprt">&nbsp;&nbsp;Tech&nbspSupport&nbsp(ongoing)</label><br />
	    </div>
	    <div class="clear"></div>
	</li><br />
	<li>
	    <textarea class="timeframe" name="timeframe" onkeyup="ajax_form('c=s_timeframe&v='+this.value);"><?php echo stripslashes($_SESSION['s_timeframe']); ?></textarea> 
	</li>
	<li>
	    <textarea class="budget" name="budget" onkeyup="ajax_form('c=s_budget&v='+this.value);"><?php echo stripslashes($_SESSION['s_budget']); ?></textarea> 
	</li>
	<li>
	    <textarea class="hear" name="hear" onkeyup="ajax_form('c=s_hear&v='+this.value);"><?php echo stripslashes($_SESSION['s_hear']); ?></textarea> 
	</li>
	<li class="upload">
	    <label class="description" for="rfp">Upload RFP or other supporting documents (PDF Only)</label><br />
	    <div class="fakeupload">
		<input type="text" name="fakeupload" class="upload" /> <!-- browse button is here as background -->
	    </div>
	    <input class="rfp" name="rfp" type="file" accept="appliation/pdf" onchange="this.form.fakeupload.value = this.value;"/>
	</li>
	<li id="buttons">
	    <input type="hidden" name="form_id"/>   
	    <input id="saveForm2" class="button_text" type="submit" name="submit" value="Submit" size="25px" />
	</li>
    </ul>
</form>
</div>
<script type="text/javascript">		
function ajax_form(str) {
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.open("GET","includes/ajax_form.php?"+str,true);
    xmlhttp.send();
}

jQuery(function () {
	jQuery("textarea.overview").watermark("Please provide a general overview of your project");
	jQuery("textarea.location").watermark("Location of the project");
	jQuery("textarea.timeframe").watermark("Describe your timeframe requirements");
	jQuery("textarea.budget").watermark("Describe your budget requirements");
	jQuery("textarea.hear").watermark("How did you hear about us?");
	jQuery("input.upload").watermark("No file selected");
});

function ajax_form_checkbox(c,v) {
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.open("GET","includes/ajax_form.php?c="+c+"&v="+v.checked,true);
    xmlhttp.send();
}
</script>