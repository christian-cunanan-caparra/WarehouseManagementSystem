<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <h1>Register</h1>

    <!-- Display Validation Errors -->
    <?php if (session()->get('errors')): ?>
        <div class="errors">
            <?php foreach (session()->get('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form action="/register/save" method="POST">
        <?= csrf_field() ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= old('name') ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>

        <button type="submit">Register</button>
    </form>

</body>
</html>
