<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            Create A note
        </h1>
        <br />
        <div class="w-full max-w-xs">
            <form method="POST" class="w-full max-w-sm">
                <div class="flex items-center border-b border-teal-500 py-2">
                    <input value="<?= $note ?? '' ?>" name="note" id="note" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Note.." aria-label="Full name">
                    <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Submit
                    </button>
                </div>
            </form>
            <?php if (isset($errors['message'])) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                    <span class="block sm:inline"><?php echo $errors['message']; ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>