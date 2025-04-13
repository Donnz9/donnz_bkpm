<html>
<head>
    <title>Dropzone PDF Upload in Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dropzone PDF Upload in Laravel</h1><br>
                <form action="{{ route('dropzone_pdf.store') }}" 
                    method="post" 
                    enctype="multipart/form-data" 
                    class="dropzone" 
                    id="pdf-upload">
                    @csrf
                </form>
                <button type="button" id="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#pdf-upload', {
            paramName: "file",
            maxFilesize: 10,
            maxFiles: 5,
            acceptedFiles: ".pdf",
            uploadMultiple: true,
            addRemoveLinks: true,
            autoProcessQueue: false,
            parallelUploads: 5,
            init: function () {
                let dropzoneInstance = this;

                document.getElementById("button").addEventListener("click", function (e) {
                    e.preventDefault();
                    dropzoneInstance.processQueue();
                });

                this.on("error", function(file, response) {
                    console.error("Upload gagal:", response);
                    alert("Upload gagal untuk file: " + file.name);
                });

                this.on("successmultiple", function(files, response) {
                    console.log("Upload sukses:", response);
                    alert("Semua file berhasil diupload!");
                    dropzoneInstance.removeAllFiles();
                });
            }
        });
    </script>    
</body>
</html>
