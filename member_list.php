<div class="member-list">

<div class="row-div">
  <h2>Member List</h2>
  <!-- Stranica export za members -->
  <a href="export.php?what=members" class="btn-export">Export</a>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Trainer</th>
      <th>Photo</th>
      <th>Training Plan</th>
      <th>Access Card</th>
      <th>Created At</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php
      $sql = "
      SELECT
      members.*,
      training_plans.name AS training_plan_name,
      trainers.first_name AS trainer_first_name, trainers.last_name AS trainer_last_name
      FROM members
      LEFT JOIN training_plans
      ON members.training_plan_id = training_plans.plan_id
      LEFT JOIN trainers
      ON members.trainer_id = trainers.trainer_id;
      ";
      $run = $conn->query($sql);
      $results = $run->fetch_all(MYSQLI_ASSOC);

      // Za selektovanje membera cemo koristiti (kopirali query u prevodu)
      $select_members = $results;

      foreach($results as $result) : ?>

        <tr>
          <td><?php echo $result['first_name']; ?></td>
          <td><?php echo $result['last_name']; ?></td>
          <td><?php echo $result['email']; ?></td>
          <td><?php echo $result['phone_number']; ?></td>

          <td>
            <?php
              if ($result['trainer_first_name']) {
                $trainer_first_name = $result['trainer_first_name'];
                $trainer_last_name = $result['trainer_last_name'];
                echo "$trainer_first_name $trainer_last_name";
              } else {
                echo "Nema trenera";
              }
            ?>
          </td>

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

          <td>
            <?php
              if($result['training_plan_name']) {
                echo $result['training_plan_name'];
              } else {
                echo "Nema plana!";
              }
            ?>
          </td>

          <td><a target="_blank" href="<?php echo $result['access_card_pdf_path']; ?>">Access Card</a></td>
          <td><?php
              $created_at = strtotime($result['created_at']);
              $newDate = date("jS F Y", $created_at);
              echo $newDate;
            ?>
          </td>
          <td>
            <form action="delete_member.php" method="POST">
              <button
                class="deleteBtn"
                type="hidden"
                name="members_id"
                value="<?php echo $result['members_id']; ?>"
                  >Delete
              </button>
            </form>
          </td>
        </tr>

      <?php endforeach;  ?>
  </tbody>
</table>
</div>