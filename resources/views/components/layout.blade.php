<!DOCTYPE html>
<html lang="ja">
<x-head />
<body>
<x-header />
<main>
  <div class="px-4">
    {{ $slot }}
  </div>
</main>
<x-toast />
</body>
</html>