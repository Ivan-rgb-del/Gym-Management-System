<?php

  $photo = $_FILES['photo']; // ovaj naziv photo je ono sto pise u JS-u pod paramName
  $photo_name = basename($photo['name']); // basename = dace nam samo ime slike a ne putanju slike

  $photo_path = 'member_photos/' . $photo_name; // sacuvamo sliku u nas folder

  $allowed_ext = ['jpg', 'jpeg', 'png', 'gif']; // dozvoljenje ekstenzije slike

  $ext = pathinfo($photo_name, PATHINFO_EXTENSION); // proveravamo ekstenziju slike koju smo sacuvali
  if (in_array($ext, $allowed_ext) && $photo['size'] < 2000000) {
    move_uploaded_file($photo['tmp_name'], $photo_path);
    echo json_encode(['success' => true, 'photo_path' => $photo_path]);
  } else {
    echo json_encode(['success' => false, 'error' => "Invalid file!"]);
  }

?>