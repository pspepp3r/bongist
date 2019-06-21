
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
	$(document).ready( function() {
		if (localStorage.page == null) {
			$('.inbox-content').load('include/mail/inbox.php');
			localStorage.setItem('mail_page', 'inbox');
			var page = localStorage.getItem('mail_page');
			$('#inbox-title').text(page);
		}else{
			var page = localStorage.getItem('mail_page');
			$('#inbox-title').text(page);
			$('.inbox-content').load('include/mail/'+page+'.php');
		}
	});
</script>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Company Mail</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">

			<div class="portlet light">
				<div class="portlet-body">
					<div class="row inbox">
						<div class="col-md-2">
							<ul class="inbox-nav margin-bottom-10">
								<li class="compose-btn mail-menu" id="compose" data-title="Compose Mail">
									<a href="javascript:;" data-title="Compose" class="btn green">
									<i class="fa fa-edit"></i> Compose </a>
								</li>
								<li class="inbox active mail-menu" id="inbox" data-title="Inbox">
									<a href="javascript:;" class="btn" data-title="Inbox">
									Inbox<span onload="$(this).load('include/mail/inbox-unread.php');"></span> </a>
									<b></b>
								</li>
							</ul>
						</div>
						<div class="col-md-10">
							<div class="inbox-header">
								<h1 class="pull-left" id="inbox-title"></h1>
							</div>
							<div class="inbox-loading" style="display: block;">
								 Loading...
							</div>
							<div class="inbox-content">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
