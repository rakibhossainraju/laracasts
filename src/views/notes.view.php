<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
<!--      <h1 class="text-3xl font-bold">Jones Notes</h1>-->
        <ul class="list-disc">
            <?php foreach ($notes as $note) : ?>
                <li class="text-blue-500 hover:underline">
                    <a href="/note?id=<?= $note['id'] ?>" >
                        <?= $note["note"]; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>