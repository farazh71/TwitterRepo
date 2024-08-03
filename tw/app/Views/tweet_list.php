<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweet List</title>

</head>

<body>
    <div id="tweet-post-list">
    </div>
    <button id="load-more">Load More</button>
    <script>
        const baseUrl = '<?= base_url() ?>';
    </script>
    <script src="<?= base_url('assets/js/tweet_list.js') ?>"></script>
</body>

</html>