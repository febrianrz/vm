<?php $this->load->view('root/v_header')?>
<div class="row">
	<!--sidebar-->
	<div class="col-md-4" id="sidebar">	
  		<?php $this->load->view('root/sidebar')?>
  	</div><!--end sidebar-->
  	<!--main-->
  	<div class="col-md-8">
  		<?php $this->load->view($page);?>
  	</div><!--end main-->
</div><!--end row-->
<?php $this->load->view('root/v_footer')?>
