(function($) {
	$(document).ready(function(e) {
		var modID = 0;
		$('.proses').live("click", function(){
			var url = "modul/system/permission.php";
			// ambil nilai id dari tombol ubah
			modID = this.id;
				$("#myModalLabel").html("Edit Permission");
			$.post(url, {id: modID} ,function(data) {
				$(".modal-body").html(data).show();
			});
		});
		
		$("#simpan-permission").bind("click", function(event) {
			var url = "modul/system/permission.php?act=update";
			var c = $('input:text[name=c]').val();
			var e = $('input:text[name=e]').val();
			var d = $('input:text[name=d]').val();
			
			var level = $('input:hidden[name=lvl]').val();
			var idLvl = $('input:hidden[name=idlvl]').val();

			$.post(url, {c : c, e : e, d : d, id: modID} ,function() {
				location.href="modul=system&sub=modul-akses&op=ed&id="+idLvl+"&level="+level;
			});
		});
	});
}) (jQuery);
