<?php
/**
 * FAQ accordion. Expects $faqs in scope: [['q' => ..., 'a' => ...], ...].
 * Dependency-free <details>/<summary> - no JS. The matching FAQPage schema is
 * built in spoke-schema.php from the same array. Answers are plain text.
 */
if (!empty($faqs)):
?>
<section class="faq-section">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <?php foreach ($faqs as $f): ?>
                <details class="faq-item">
                    <summary><?php echo htmlspecialchars($f['q']); ?></summary>
                    <div class="faq-answer"><?php echo htmlspecialchars($f['a']); ?></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
