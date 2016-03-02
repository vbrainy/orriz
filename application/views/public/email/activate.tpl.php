<html>
<body>
	<h1><?php echo sprintf(lang('email_activate_heading'), $identity);?></h1>
    <p>Please copy and paste this link in browser <?php echo base_url('members/activate').'/'. $id .'/'. $activation; ?> or click below link.</p>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor(base_url('members/activate').'/'. $id .'/'. $activation, lang('email_activate_link')));?></p>
</body>
</html>