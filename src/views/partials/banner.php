<?php 
$heading = [
  "/" => "Home",
  "/home" => "Home",
  "/about" => "About",
  "/contact" => "Contact",
  "/notes" => "My Notes",
  "/note" => "My Note",
];
$path = parse_url($uri)['path'] ?? "/";
if (!isset($heading[$path])) {
  return; 
}
?>

<header class="bg-white shadow">
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= $heading[$path] ?></h1>
  </div>
</header>