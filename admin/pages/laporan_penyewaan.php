<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Laporan Penyewaan</h5>
				</div>
				<div class="widget-content nopadding">
					<form action="view_laporan_penyewaan.php" method="POST" class="form-horizontal">
						<input type="hidden" name="id_merk" value="">
						<div class="control-group">
							<label class="control-label">Dari :</label>
							<div class="controls">
								<input type="date" class="span4" name="dari" value="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Sampai :</label>
							<div class="controls">
								<input type="date" class="span4" name="sampai" value="" />
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" name="submit" class="btn btn-success">Kirim</button>
							<a href="kelola_merk.php"><button type="button" class="btn btn-danger">Batal</button></a>
						</div>
					</form>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
					<h5>Laporan Pengembalian</h5>
				</div>
				<div class="widget-content nopadding">
					<form action="view_laporan_pengembalian.php" method="POST" class="form-horizontal">
						<input type="hidden" name="id_merk" value="">
						<div class="control-group">
							<label class="control-label">Dari :</label>
							<div class="controls">
								<input type="date" class="span4" name="dari" value="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Sampai :</label>
							<div class="controls">
								<input type="date" class="span4" name="sampai" value="" />
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" name="submit" class="btn btn-success">Kirim</button>
							<a href="kelola_merk.php"><button type="button" class="btn btn-danger">Batal</button></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--Footer-part-->
<div class="row-fluid">
	<div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
</body>
</html>
