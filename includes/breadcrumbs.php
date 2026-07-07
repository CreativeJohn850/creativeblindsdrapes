<?php
/**
 * Visible breadcrumb trail. Expects $crumbs in scope:
 *   [['name' => 'Home', 'path' => '/'], ..., ['name' => 'Current Page']]
 * The last crumb is the current page and should omit 'path'. Internal paths
 * are run through url(); the matching schema is built in spoke-schema.php.
 */
if (!empty($crumbs)):
    $last = count($crumbs) - 1;
?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <div class="container">
        <ol>
            <?php foreach ($crumbs as $i => $c): ?>
                <li<?php echo $i === $last ? ' aria-current="page"' : ''; ?>>
                    <?php if ($i !== $last && !empty($c['path'])): ?>
                        <a href="<?php echo url($c['path']); ?>"><?php echo htmlspecialchars($c['name']); ?></a>
                    <?php else: ?>
                        <span><?php echo htmlspecialchars($c['name']); ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
<?php endif; ?>
