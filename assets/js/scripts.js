$(document).ready(function () {
	const baseUrl = "http://localhost/crud-ajax-upload/"; // ganti kalo pas hosting

	jQuery.validator.addMethod(
		"fileSizeLimit",
		function (value, element, limit) {
			return !element.files[0] || element.files[0].size <= limit;
		},
		"Ukuran file terlalu besar, maksimal 8MB"
	);

	$("#form").validate({
		rules: {
			nama: {
				required: true,
			},
			file: {
				accept: "image/*, application/pdf",
				fileSizeLimit: 8000000, // 8mb
			},
		},
		messages: {
			nama: {
				required: "isi dulu bro!",
			},
			file: {
				accept: "Format tidak sesuai, hanya boleh mengupload foto dan pdf",
			},
		},
		submitHandler: function (form) {
			let id = $("#id").val();
			let nama = $("#nama").val();
			let file = $("#file").prop("files")[0];
			let formData = new FormData();

			formData.append("id", id);
			formData.append("nama", nama);
			formData.append("file", file);

			let url = $(location).attr("href");
			let pisah = url.split("/");
			let segment = pisah[5];

			if (segment == "tambah") {
				tambah(formData);
			} else {
				edit(formData);
			}
		},
	});

	// proses tambah data
	function tambah(formData) {
		$.ajax({
			type: "post",
			url: baseUrl + "siswa/prosesTambah",
			data: formData,
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$("#loading").removeClass("d-none");
			},
			complete: function (data) {
				$("#loading").addClass("d-none");
			},
			success: function (data) {
				window.location.href = baseUrl + "siswa";
			},
		});
	}
	// ./proses tambah data

	// proses edit data
	function edit(formData) {
		$.ajax({
			type: "post",
			url: baseUrl + "siswa/prosesEdit",
			data: formData,
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$("#loading").removeClass("d-none");
			},
			complete: function (data) {
				$("#loading").addClass("d-none");
			},
			success: function (data) {
				window.location.href = baseUrl + "siswa";
			},
		});
	}
	// ./proses edit data

	// progress bar;

	const fileUploader = document.getElementById("file");
	const progress = document.getElementById("progress");

	const reader = new FileReader();

	if (fileUploader) {
		fileUploader.addEventListener("change", (event) => {
			$("#progressLoading").removeClass("d-none");
			const files = event.target.files;
			const file = files[0];
			reader.readAsDataURL(file);

			reader.addEventListener("progress", (event) => {
				if (event.loaded && event.total) {
					const percent = (event.loaded / event.total) * 100;
					progress.value = percent;
					document.getElementById("progress").style.width =
						Math.round(percent) + "%";
				}
			});
		});
	}
	// ./progress bar
});
