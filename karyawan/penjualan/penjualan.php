<?php
if ( !isset( $_SESSION ) ) {
		session_start();
}
?>
<div id="container"></div>
<!-- container -->
<!-- /end container -->
<script type="text/javascript">
	runningPage('penjualan',{});
</script>
<!-- Javascript untuk popup modal Delete-->
<script type="text/javascript">
function confirm_modal(delete_url)
{
$('#modal_delete').modal('show', {backdrop: 'static'});
document.getElementById('delete_link').setAttribute('href' , delete_url);
}
</script>