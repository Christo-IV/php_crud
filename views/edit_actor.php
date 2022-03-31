<style>
    .form-check > *:hover {
        cursor: pointer;
    }
</style>

<form method="POST" class="w-25" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="mb-3">
        <label for="name" class="form-label">Name of actor</label>
        <input type="text" class="form-control" id="name" aria-describedby="actorName" name="name"
               value="<?= $actor["actor_name"] ?>" required>
    </div>
    <div class="mb-3">
        <label for="dateOfBirth" class="form-label">Date of birth</label>
        <input type="date" class="form-control" id="dateOfBirth" name="dob" value="<?= $actor["actor_dob"] ?>" required>
    </div>
    <h5 class="mb-3">Credited in...</h5>
    <div class="mb-3">
        <?php foreach ($movies as $movie): ?>
            <div class="form-check">
                <input
                        class="form-check-input" type="checkbox" name="credits[]"
                        value="<?= $movie["movie_id"] ?>"
                        id="<?= $movie["movie_id"] ?>"
                    <?= in_array($movie, $actor["movies"]) ? "checked" : "" ?>>
                <label class="form-check-label"
                       for="<?= $movie["movie_id"] ?>">
                    <?= $movie["movie_name"] ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>