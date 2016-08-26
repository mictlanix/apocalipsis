<?php

/*
Template Name: Redirect

 * @author		Luis Miguel Delgado
 * @email		luismi@tunegocioenlanube.net
 * @web			www.tunegocioenlanube.net
 
 * @name		Redirect
 * @type		PHP Page
 * @desc		Wordpress template that redirects the current page based on the content of the database entry it loads

 * @requires	Wordpress
 * @install		Copy this file to the directory of the theme you wish to use, i.e. wp-content/themes/theme_name/
 

* USAGE INSTRUCTIONS		
			1. Create a new Page in your Wordpress
			2. Add a title to the page (e.g. TuNegocioEnLaNube)
		   	3. Add a URL to the content of the page (e.g. http://www.tunegocioenlanube.net OR tunegocioenlanube.net OR www.tunegocioenlanube.net OR local patht like category/marketing/)
			4. Select "Redirect" as the page template
			5. Publish
 */
?>
<?php if (have_posts()) : the_post(); ?>
<?php $URL = get_the_excerpt(); 
	if (!preg_match('/^http:\/\//', $URL))
	{
		//$URL = 'http://' . $URL;
		$host	= $_SERVER['HTTP_HOST'];
		$dir	= dirname($_SERVER['PHP_SELF']);
		$URL	= "http://$host$dir/$URL";
		$URL	= "http://www.google.com";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Refresh" content="0; url=<?php echo $URL; ?>">
</head>
<body>
</body>
</html>

<?php endif; ?>
