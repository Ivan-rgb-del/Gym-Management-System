<div class="trainer-list">
  <div class="row-div">
  <h2>Trainers List</h2>
  <!-- Stranica export za trainers -->
  <a href="export.php?what=trainers" class="btn-export">Export</a>
  </div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Photo</th>
      <th>Phone Number</th>
      <th>Created At</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php
      $sql = "SELECT * FROM trainers";
      $run = $conn->query($sql);
      $results = $run->fetch_all(MYSQLI_ASSOC);

      // Za selektovanje trenera cemo koristiti (kopirali query u prevodu)
      $select_trainers = $results;

      foreach($results as $result) : ?>

      <tr>
        <td> <?php echo $result['first_name'] ?> </td>
        <td> <?php echo $result['last_name'] ?> </td>
        <td> <?php echo $result['email'] ?> </td>

        <td>
            <img
              style="width: 60px;"
                src="<?php
                  if(file_exists($result['photo_path'])) {
                    echo $result['photo_path'];
                  } else {
                    echo './member_photos/default.png';
                  }
              ?>">
        </td>

        <td> <?php echo $result['phone_number'] ?></td>
        <td> <?php echo date("jS F Y", strtotime($result['created_at'])) ?> </td>
        <td>
          <form action="delete_trainer.php" method="POST">
            <button
              class="deleteBtn"
              type="hidden"
              name="trainer_id"
              value="<?php echo $result['trainer_id']; ?>"
                >Delete
            </button>
          </form>
        </td>
      </tr>

      <?php endforeach; ?>
  </tbody>
</table>
</div>