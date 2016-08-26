<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
get_header('sistema'); 
$this->load->view( 'sitio/agendas/fotorevise/header' ); ?>



<span style="display:none">
<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >

<input type="text" id="id_diseno" name="id_diseno" value="<?php echo $id_diseno; ?>" >
<input type="text" id="variation_id" name="variation_id" value="<?php echo $variation_id; ?>" >
<input type="text" id="consecutivo" name="consecutivo" value="<?php echo $consecutivo; ?>" >

<input type="text" id="ano" name="ano" value="<?php echo $ano; ?>" >

</span> 


  <!-- Content -->
   
  <div class="container">

  	<div id="foo"></div>


    	<div class="alert" id="messages"></div>

      <?php $this->load->view( 'sitio/agendas/fotorevise/navbar' ); ?>
      <?php $this->load->view( 'sitio/agendas/fotorevise/acordion' ); ?>


      
  </div>



<?php $this->load->view( 'sitio/agendas/fotorevise/footer' ); 
get_footer('sistema'); 
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.navbar-nav li:nth-child(5)').addClass('current-menu-item')
	});
</script>
