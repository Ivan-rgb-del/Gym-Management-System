<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
  Dropzone.options.dropzoneUpload = {
    url: 'upload_photo.php', // novi fajl koji mi treba da kreiramo za nas projekat
    paramName: 'photo',
    maxFilesize: 20, // max 20MB da se uploaduje
    acceptedFiles: "image/*", // slika je u pitanju da lije jpg, jpeg itd...
    init: function() {
      this.on("success", function(file, response) { // ako je uspesno sta ce nam se odraditi
        const jsonResponse = JSON.parse(response);
        // ako se aplovdovalo uspesno
        if (jsonResponse.success) {
          // postavljamo nevidljivu vrednost iz inputa do uplovdovane putanje fajla
          document.getElementById('photoPathInput').value = jsonResponse.photo_path;
        } else {
          // ako nije uspesno vraca nam error
          console.error(jsonResponse.error);
        }
      });
    }
  };
</script>