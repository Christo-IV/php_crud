<style>
    tr:hover {
        cursor: pointer;
    }

    .row-btn {
        width: 1rem;
    }
</style>

<button class="btn btn-primary mt-4 mb-2" onClick="createMovie()">Create</button>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Release date</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td onClick="getMovie(<?= $movie["movie_id"] ?>)"><?= $movie["movie_id"] ?></td>
            <td onClick="getMovie(<?= $movie["movie_id"] ?>)"><?= $movie["movie_name"] ?></td>
            <td onClick="getMovie(<?= $movie["movie_id"] ?>)"><?= $movie["movie_release_date"] ?></td>
            <td class="row-btn">
                <button onClick="editMovie(<?= $movie["movie_id"] ?>)" class="btn btn-warning">Edit</button>
            </td>
            <td class="row-btn">
                <button onClick="deleteMovie(<?= $movie["movie_id"] ?>)" class="btn btn-danger">X</button>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<script>
    function createMovie() {
        location.href = "movies/new";
    }

    function getMovie(movieId) {
        location.href = "movies/" + movieId;
    }

    function editMovie(movieId) {
        location.href = "movies/edit/" + movieId;
    }

    function deleteMovie(movieId) {
        location.href = "movies/delete/" + movieId;
    }
</script>