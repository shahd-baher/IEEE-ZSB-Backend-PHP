<?php require('partials/head.php') ?>
<?php require("partials/nav.php") ?>
<?php require('partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <ul>
            <?php foreach ($notes as $note) :  ?>
                <li>
                    <a href='/note?id=<?= $note['id'] ?>' class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <br>
        <p class="mt-46">
            <a href='/note/create' class="text-black-1000 hover:underline">Create a new note</a>
        </p>
    </div>
</main>

<?php
require('partials/footer.php');
?>