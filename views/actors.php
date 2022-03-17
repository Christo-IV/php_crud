<style>
    tr:hover {
        cursor: pointer;
    }
</style>

<table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Dob</th>
        </tr>
    <?php foreach ($actors as $actor): ?>
        <tr onClick="getActor(<?= $actor["actor_id"] ?>)">
            <td><?= $actor["actor_id"] ?></td>
            <td><?= $actor["actor_name"] ?></td>
            <td><?= $actor["actor_dob"] ?></td>
        </tr>
    <?php endforeach ?>
</table>
<script>
    function getActor(actorId) {
        location.href = "actors/" + actorId;
    }
</script>