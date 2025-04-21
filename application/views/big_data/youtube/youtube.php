<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">YouTube Comments</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Published At</th>
                    <th>Likes</th>
                    <th>Comment</th>
                    <th>Video ID</th>
                    <th>Public</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($comments)): ?>
                    <?php foreach($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['authorDisplayName']); ?></td>
                            <td><?= htmlspecialchars($comment['publishedAt']); ?></td>
                            <td><?= htmlspecialchars($comment['likeCount']); ?></td>
                            <td><?= htmlspecialchars($comment['textOriginal']); ?></td>
                            <td><?= htmlspecialchars($comment['videoId']); ?></td>
                            <td><?= htmlspecialchars($comment['public']) ? 'Yes' : 'No'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No comments available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
