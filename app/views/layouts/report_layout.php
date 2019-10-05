<?php 
	$page_name=null;
	if(!empty($_POST['title'])){
		$page_name=$_POST['title'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php 
			Html ::  page_title(SITE_NAME. "-" . $page_name);
			Html ::  page_css('material-icons.css');
		?>
		<?php 
			Html ::  page_css('bootstrap.min.css');
		?>
		<?php 
			Html ::  page_js('jquery-2.1.4.min.js');
			Html ::  page_js('bootstrap.js');
			
			Html ::  page_js('export-plugin/FileSaver.min.js');
			Html ::  page_js('export-plugin/tableExport.js?id=15');
			Html ::  page_js('export-plugin/jquery.base64.js');
			Html ::  page_js('export-plugin/html2canvas.js');
			
		?>
		<style>
			body {
			  background: #f5f5f5; 
			  padding:0;
			  margin:0;
			
			  
			}
			a.brand{
				font-size:16px;
				font-weight:bold;
				padding:6px;
				margin-bottom:5px;
				display:block;
				text-decoration:none;
			}
			a.brand img{
				display:inline-block;
				max-height:28px;
			}
			
			
			.panel{
				border-radius:0;
				box-shadow: 0 0 20px rgba(0,0,0,0.1);
			}
			.btn{
				border-radius:0;
				box-shadow: 0 2px 2px rgba(0,0,0,0.1);
			}
			.report-header{
				overflow:hidden;
				padding:10px;
				border-bottom:1px solid #eee;
			}
			.report-section{
				background:#fff;
				position:relative;
			}
			
			#company-header{
				max-height:160px;
				padding:20px;
				background:#fafafa;
			}
			#company-header img{
				width:60px;
				height:60px;
				margin:10px auto;
			}
			
			#page-title{
				padding:10px 0;
				margin-bottom:20px;
				background:none;
				border:none;
				border-bottom:2px solid #eee;
				font-weight:bold;
				font-size:23px;
				width:100%;
			}
			
			#page-title:hover{
				background:#fcfcfc;
				border-bottom-color:#0066cc;
			}
			.report-body{
				padding:10px;
			}
			page{
				background:#fff;
				display: block;
				margin: 30px auto;
				margin-bottom: 0.5cm;
				box-shadow: 0 0 20px rgba(0,0,0,0.1);
			}
			page[size="A4"] {
				width: 21cm;
				min-height: 28.7cm;
			}
			
			page[size="A3"] {
				width: 29.7cm;
				min-height: 42.0cm;
				
			}
			
			page[size="Letter"] {
				width: 20cm;
				min-height: 28.7cm;
				
			}
			page[size="Legal"] {
				width: 19cm;
				min-height: 28.7cm;
				
			}
			
			page[size="None"] {
				
			}
			
			#page-actionbar{
				box-shadow: 0 0 20px rgba(0,0,0,0.1);
				background:#fff;
				padding:10px;
				margin:0 auto;
			}
			#page-actionbar img{
				height:24px;
				vertical-align:middle;
				color:#fff;
			}
			
			@media print {
				body, page{
					margin: 0;
					box-shadow: none;
				}
				#page-actionbar{
					display:none;
				}
			}
			
			.page .container,.page .container-fluid{
				width:auto;
			}
			.header-list label{
				display:block;
				padding:5px;
				border-bottom:1px solid #eee;
			}
			.include.false{
				background:rgba(249,20,20,0.2);
				color:red;
			}
			a:not([href]) {
				text-decoration:none;
				color:inherit;
			}
			table thead a.btn{
				border:none;
				background:none;
				color:inherit;
				text-decoration:none;
				box-shadow:none;
				display:inline;
				font-weight:inherit;
				font-size:inherit;
			}
			.material-icons{
				vertical-align:middle;
			}
		</style>
		
	</head>
	<body>
		<div id="page-actionbar">
			<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4">
					<a class="brand" href="<?php print_link('') ?>">
						<img src="<?php print_link(SITE_LOGO); ?>" />
						<?php echo SITE_NAME ?>
					</a>
				</div>
				<div class="col-sm-8">
					<button class="btn btn-default" onclick="printPage()"><img src="<?php print_link("assets/js/export-plugin/images/print.svg") ?>" /> Print | PDF <img src="<?php print_link("assets/js/export-plugin/images/pdf.svg") ?>" /></button>
					
					<button   class="btn btn-default" onclick="exportPng()"><img src="<?php print_link("assets/js/export-plugin/images/png.svg") ?>" /> Save as PNG</button>
					<button  class="btn btn-default" onclick="exportCsv()"><img src="<?php print_link("assets/js/export-plugin/images/csv.svg") ?>" /> Export CSV</button>
					<button  class="btn btn-default" onclick="exportExcel()"><img src="<?php print_link("assets/js/export-plugin/images/xls.svg") ?>" /> Export Excel</button>
					
					<button  class="btn btn-default" onclick="exportWord()"><img src="<?php print_link("assets/js/export-plugin/images/doc.svg") ?>" /> Export Word</button>
				</div>
			</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2 hidden-print">	
					<br />
					<div class="panel panel-default">
						<div class="panel-heading">Print Page Settings</div>
						<div class="panel-body">
							<div class="form-group">
								Select Paper Size
								<select onchange="changePageSize(this.value)" class="form-control">
									<option>A4</option>
									<option>A3</option>
									<option>Letter</option>
									<option>Legal</option>
									<option>None</option>
								</select>
							</div>
							<div class="form-group">
								<label class="btn btn-primary btn-block"><input onclick="toggleCompanyHeader()" checked="checked" type="checkbox" /> Hide Header</label>
							</div>
							<div class="form-group">
								<button onclick="removePageLinks()" class="btn btn-warning btn-block "> Remove Page Links</button>
							</div>
							
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Export Page Fields</div>
						<div class="panel-body">
							<div id="visible-columns">
								<div class="header-list" id="include_columns_container">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-10">
					<page size="A4">
						<div id="reportcontainer" class="report-section">
							<h3 id="company-header">
								<img src="<?php print_link(SITE_LOGO); ?>" />
								<?php echo SITE_NAME ?>
							</h3>
							<div id="reportbody" class="report-body">
								<input value="<?php echo $page_name; ?>" id="page-title" />
								<?php 
									if(!empty($_POST['data'])){
										echo $_POST['data'];
									}
								?>
							</div>
						</div>
					</page>	
				</div>
			</div>
		</div>
		<script>
			
			$(document).ready(function(){
				
				//Remove none reporting components
				$('.panel-footer,.page-footer,.jumbotron,.page-list-action,.td-checkbox,.td-btn,.export-container,.page-header').remove();
				
				//get all table header title
				$('.table thead th,.table thead td').each(function(index){
					var t=$(this).text();
					if(t){
						$('#include_columns_container').append('<label><input onclick="removeTableColumn(this,' + index + ')" checked="checked" type="checkbox" />' + t + '</label>');
					}
				});

			});

			
			function removeTableColumn(elem,index){
				var l=$(elem).is(":checked");
				var n=index+1;
				var col=$('td:nth-child('+n+'),th:nth-child('+n+')');
				col.toggle();
				$(elem).parent().toggleClass(l);
			}
			
			function removePageLinks(){
				//disable links and buttons on print page
				$('.report-body a, .report-body .btn, .report-body button').each(function(){
					$(this).removeAttr("href");
				});
			}
			
			function toggleCompanyHeader(){
				$('#company-header').toggle();
			}
			
			function changePageSize(value){
				if(value!=''){
					$('page').attr("size",value);
				}
			}
			
			function printPage(){
				window.print();
			}
			
			function exportPdf(){
				var tableTitle=$('#page-title').val();
				$('table').tableExport({
					type:'pdf',
					pdfFontSize:'10',
					escape:'false',
					htmlContent:'false'
				});
			}
			
			function exportWord(){
				var pageTitle=$('#page-title').val();
				
				$('table').tableExport(
					{
						type:'word',
						escape:'false',
						headerTitle:pageTitle,
						description:"",
						fileName:pageTitle + "-" +  formatDate(new Date()) + ".doc",
					}
				);
			}
			
			function exportCsv(){
				var pageTitle=$('#page-title').val();
				$('table').tableExport(
					{
						type:'csv',
						escape:'false',
						fileName:pageTitle + "-" + formatDate(new Date()) + ".csv",
					}
				);
			}
			
			function exportExcel(){
				var pageTitle=$('#page-title').val();
				$('table').tableExport(
					{
						type:'excel',
						escape:'false',
						headerTitle:pageTitle,
						description:"",
						formatTable:true,
						fileName:pageTitle + "-" + formatDate(new Date()) + ".xls",
					}
				);
			}
			
			
			function exportPng(){
				var pageTitle=$('#page-title').val();
				$('#reportcontainer').tableExport(
					{
						type:'image',
						fileName:pageTitle + "-" + formatDate(new Date()) + ".png"
					}
				);
			}
			
			
			
			function formatDate(date) {
				var d = new Date(date),
					month = '' + (d.getMonth() + 1),
					day = '' + d.getDate(),
					year = d.getFullYear();

				if (month.length < 2) month = '0' + month;
				if (day.length < 2) day = '0' + day;

				return [year, month, day].join('-');
			}
		</script>
	</body>
</html>