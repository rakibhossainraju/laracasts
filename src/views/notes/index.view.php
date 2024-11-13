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
                <a href="/note/create" class="px-6 py-3 rounded bg-blue-500 mt-5 text-500 inline-block text-white">Create Note</a>
        </ul>
    </div>
</main>