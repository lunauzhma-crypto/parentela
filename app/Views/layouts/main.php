<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Parentela' ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Local CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= filemtime(FCPATH . 'css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/scrapbook.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= $this->include('partials/header') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/footer') ?>

    <!-- Local JS -->
    <script src="<?= base_url('js/main.js') ?>?v=<?= file_exists(FCPATH . 'js/main.js') ? filemtime(FCPATH . 'js/main.js') : time() ?>"></script>

</body>

</html>