<?php require('partials/head.php') ?>
<?php require("partials/nav.php") ?>
<?php require('partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form method="POST">

            <div class="col-span-full">
                <label for="body" class="block text-sm/6 font-medium text-gray-900">Body</label>
                <div class="mt-2">
                    <textarea
                        id="body" name="body" rows="3" placeholder="Write your thoughts." class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    ><?= $_POST['body'] ?? '' ?></textarea>
                </div>
            </div>

            <?php if(isset($errors['body'])) : ?>
                <p class="text-red-500 text-xs mt-2"> <?= $errors['body'] ?></p>
            <?php endif; ?>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>

    </div>
</main>

<?php
require('partials/footer.php');
?>