<style>
    .form-check > *:hover {
        cursor: pointer;
    }
</style>

<form method="POST" class="w-25" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="mb-3">
        <label for="name" class="form-label">Name of movie</label>
        <input type="text" class="form-control" id="name" aria-describedby="actorName" name="name" value="<?= $movie["movie_name"] ?>" required>
    </div>
    <div class="mb-3">
        <label for="releaseDate" class="form-label">Release date</label>
        <input type="date" class="form-control" id="releaseDate" name="release_date" value="<?= $movie["movie_release_date"] ?>" required>
    </div>
    <h5 class="mb-3">Featured actors...</h5>
    <div class="mb-3">
        <?php foreach ($actors as $actor): ?>
            <div class="form-check">
                <input
                        class="form-check-input" type="checkbox" name="credits[]"
                        value="<?= $actor["actor_id"] ?>"
                        id="<?= $actor["actor_id"] ?>"
                    <?= in_array($actor, $movie["actors"]) ? "checked" : "" ?>>
                <label class="form-check-label"
                       for="<?= $actor["actor_id"] ?>">
                    <?= $actor["actor_name"] ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>