<form method="POST" class="w-25" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="mb-3">
        <label for="name" class="form-label">Name of movie</label>
        <input type="text" class="form-control" id="name" aria-describedby="actorName" name="name" required>
    </div>
    <div class="mb-3">
        <label for="releaseDate" class="form-label">Release date</label>
        <input type="date" class="form-control" id="releaseDate" name="release_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>