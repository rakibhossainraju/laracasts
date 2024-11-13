<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            <?= $note["note"]; ?>
        </h1>
        <br />
        <div class="flex items-center gap-20 w-full">
            <a href="/notes" class="py-2 rounded bg-indigo-500 text-white block text-center w-full" >Back to notes</a>
            <form method="POST" class="w-full">
                <input type="hidden" class="none" name="_method" value="DELETE">
                <input type="hidden" class="none" name="id" value="<?= $_GET['id'] ?? 1; ?>">
                <button class="block px-10 py-2 rounded bg-red-500 text-white text-center w-full">Delete</button>
            </form>
        </div>
    </div>
</main>