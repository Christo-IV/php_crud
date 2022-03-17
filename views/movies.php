<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Release date</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?= $movie["movie_id"] ?></td>
            <td><?= $movie["movie_name"] ?></td>
            <td><?= $movie["movie_release_date"] ?></td>
        </tr>
    <?php endforeach ?>
</table>