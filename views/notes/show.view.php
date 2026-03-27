<?php require base_path("views/partials/header.php") ?>
<?php require base_path("views/partials/nav.php") ?>
<?php require base_path("views/partials/banner.php") ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-gray-300">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 hover:underline">go back...</a>
        </p>
        <p> <?= htmlspecialchars($note['body']) ?> </p>

        <footer class="mt-6">
            <a href="/note/edit?id=<?= $note['id'] ?>" class="rounded-md bg-gray-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Edit</a>
        </footer>
    </div>
</main>

<?php require base_path("views/partials/foot.php") ?>