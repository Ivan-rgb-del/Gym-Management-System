<div class="assign-list">
  <h2>Assign Trainer to Member</h2>
  <form action="assign_trainer.php" method="POST">

    <label for="member">Select Member</label>
      <select name="member" class="form-select">
        <?php
          foreach($select_members as $member) : ?>
            <option
              value="<?php echo $member['members_id'] ?>"
            >
              <?php echo $member['first_name'] . " " . $member['last_name'] ?>
            </option>
        <?php endforeach; ?>
      </select>

    <label for="trainer">Select Trainer</label>
      <select name="trainer" class="form-select">
        <?php
          foreach($select_trainers as $trainer) : ?>
            <option
              value="<?php echo $trainer['trainer_id'] ?>"
            >
              <?php echo $trainer['first_name'] . " " . $trainer['last_name'] ?>
            </option>

        <?php endforeach; ?>
      </select>

      <button type="submit" class="assign_btn">Assign Trainer</button>
  </form>
</div>